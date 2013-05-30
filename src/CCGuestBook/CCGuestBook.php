<?php
/**
* A guestbook controller as an example to show off some basic controller and model-stuff.
*
* @package StormFrame
*/
class CCGuestbook extends CObject implements IController {

  	private $guestbookModel;
 	private $pageTitle = 'StormFrame Guestbook Example';

  	/**
  	* Constructor
   	*/
  	public function __construct() {
    	parent::__construct();
    	$this->guestbookModel = new CMGuestbook();
  	}


  	/**
   	* Implementing interface IController. All controllers must have an index action.
   	* Show a standard frontpage for the guestbook.
   	*/
  	public function Index() {
  		$this->views->SetTitle($this->pageTitle);
  		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      		'entries'=>$this->guestbookModel->ReadAll(),
      		'formAction'=>$this->request->CreateUrl('guestbook/handle')
    	));
  	}
 

  	/**
   	* Handle posts from the form and take appropriate action.
   	*/
  	public function Handle() {
  		if(isset($_POST['doAdd'])) {
      		$this->guestbookModel->Add(strip_tags($_POST['entry']));
    	}elseif(isset($_POST['doClear'])) {
      		$this->guestbookModel->DeleteAll();
    	}  
		$this->RedirectTo($this->request->controller);
  	}
}