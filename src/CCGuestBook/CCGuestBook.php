<?php
/**
* A guestbook controller as an example to show off some basic controller and model-stuff.
*
* @package StormFrame
*/
class CCGuestbook extends CObject implements IController, IHasSQL {

	private $pageTitle = 'StormFrame Guestbook Example';
  	
  	/**
   	* Constructor
   	*/
  	public function __construct() {
    	parent::__construct();
  	}
	
	/**
    * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
    *
    * @param string $key the string that is the key of the wanted SQL-entry in the array.
    */
  	public static function SQL($key=null) {
     	$queries = array(
        	'insert into guestbook'   => 'INSERT INTO Guestbook (content, submitted) VALUES (?, ?);',
        	'select * from guestbook' => 'SELECT * FROM Guestbook ORDER BY id DESC;',
        	'delete all from guestbook'   => 'DELETE FROM Guestbook;',
     	);
     	if(!isset($queries[$key])) {
        	throw new Exception("No such SQL query, key '$key' was not found.");
      	}
      	return $queries[$key];
   	}
 

  	/**
   	* Implementing interface IController. All controllers must have an index action.
   	*/
  	public function Index() {
  		$this->views->SetTitle($this->pageTitle);
  		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      		'entries'=>$this->ReadFromDatabase(),
      		'formAction'=>$this->request->CreateUrl('guestbook/handle')
    	));
  	}
  
  	/**
   	* Handle actions in the guestbook
   	*/
  	public function Handle() {
    	if(isset($_POST['doAdd'])) {
      		$this->SaveNewEntry(strip_tags($_POST['entry']));
    	}elseif(isset($_POST['doClear'])) {
      		$this->ClearGuestbook();
    	}           
    	header('Location: ' . $this->request->CreateUrl('guestbook'));
  	}
	
 	/**
   	* Adding new guestbook entry
   	*/
   	public function SaveNewEntry($text){
   		$this->dbh->ExecuteQuery(self::SQL('insert into guestbook'), array($text, date('y-m-d H:i:s')));
		if($this->dbh->rowCount() != 1){
			echo 'Failed to insert new entry into database';
		}
   	}
	
	/**
   	* Adding new guestbook entry
   	*/
   	public function ClearGuestbook(){
		$this->dbh->ExecuteQuery(self::SQL('delete all from guestbook'));
   	}
	
	/**
   	* Reading all database entrys
   	*/
   	public function ReadFromDatabase(){
   		try{
   			$this->dbh->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      		return $this->dbh->ExecuteSelectQueryAndFetchAll(self::SQL('select * from guestbook'));
   		}catch(Exception $e){
   			return array();
		}
   	}
}