<?php
/**
* A model for a guestbok, to show off some basic controller & model-stuff.
*
* @package StormFrame
*/
class CMGuestbook extends CObject implements IHasSQL {


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
   	* Add a new entry to the guestbook and save to database.
   	*/
  	public function Add($entry) {
  		$this->dbh->ExecuteQuery(self::SQL('insert into guestbook'), array($text, date('y-m-d H:i:s')));
		if($this->dbh->rowCount() != 1){
			echo 'Failed to insert new entry into database';
			$this->session->AddMessage('error', 'Your message could not be added.');
		}else{
			$this->session->AddMessage('success', 'Your message was successfully added.');
		}
  	}
 

  	/**
   	* Delete all entries from the guestbook and database.
   	*/
  	public function DeleteAll() {
  		$this->dbh->ExecuteQuery(self::SQL('delete all from guestbook'));
		$this->session->AddMessage('info', 'Removed all messages from the database table.');
  	}
 
 
  	/**
   	* Read all entries from the guestbook & database.
   	*/
  	public function ReadAll() {
  		try{
      		return $this->dbh->ExecuteSelectQueryAndFetchAll(self::SQL('select * from guestbook'));
   		}catch(Exception $e){
   			return array();
		}
  	}
} 