<?php
/**
* A guestbook controller as an example to show off some basic controller and model-stuff.
*
* @package StormFrame
*/
class CCGuestbook extends CObject implements IController {

	private $pageTitle = 'StormFrame Guestbook Example';
  	private $pageHeader = '<h1>Guestbook Example</h1><p>Showing off how to implement a guestbook in StormFrame.</p>';
	private $pageMessages = '<h2>Current messages</h2>';
  	
 

  	/**
   	* Constructor
   	*/
  	public function __construct() {
    	parent::__construct();
  	}
 

  	/**
   	* Implementing interface IController. All controllers must have an index action.
   	*/
  	public function Index() {
  		$formAction = $this->request->CreateUrl("guestbook/handle");
		$pageForm = "
    	<form name='guestbook' action='".$formAction."' method='POST'>
      		<p>
        		<label>Comment: <br/>
        		<textarea name='entry'></textarea></label>
      		</p>
      		<p>
        		<input type='submit' name='doAdd' value='Add comment' />
        		<input type='submit' name='doClear' value='Rensa gästboken' />
      		</p>
    	</form>
  		";
  		foreach($this->ReadFromDatabase() as $val) {
    		$this->pageMessages .= "<div style='background-color:#f6f6f6;border:1px solid #ccc;margin-bottom:1em;padding:1em;'><p>At: ".$val['submitted']."</p><p>".$val['content']."</p></div>\n";
		}
    	$this->data['title'] = $this->pageTitle;
    	$this->data['main'] = $this->pageHeader.$pageForm.$this->pageMessages;		
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
   		$this->dbh->ExecuteQuery('INSERT INTO Guestbook (content, submitted) VALUES (?, ?)', array($text, date('y-m-d H:i:s')));
		if($this->dbh->rowCount() != 1){
			echo 'Failed to insert new entry into database';
		}
   	}
	
	/**
   	* Adding new guestbook entry
   	*/
   	public function ClearGuestbook(){
		$this->dbh->ExecuteQuery('DELETE FROM Guestbook;');
   	}
	
	/**
   	* Reading all database entrys
   	*/
   	public function ReadFromDatabase(){
   		try{
   			$this->dbh->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      		return $this->dbh->ExecuteSelectQueryAndFetchAll('SELECT * FROM Guestbook ORDER BY id DESC;');
   		}catch(Exception $e){
   			return array();
		}
   	}
}