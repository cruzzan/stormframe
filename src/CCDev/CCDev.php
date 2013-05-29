<?php
/**
* Standard controller layout.
*
* @package StormFrameCore
*/
class CCDev extends CObject implements IController {
	private $pageTitle = "The Developer Controller";
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
   		$this->views->SetTitle($this->pageTitle);   
		$this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      		'menu'=>$this->Menu())
    	);
   	}
	public function Links() {
		$url = 'dev/links';
    	$current      = $this->request->CreateUrl($url);

    	$this->request->cleanUrl = false;
    	$this->request->querystringUrl = false;    
    	$default      = $this->request->CreateUrl($url);
    
   		$this->request->cleanUrl = true;
    	$clean        = $this->request->CreateUrl($url);    
    
    	$this->request->cleanUrl = false;
    	$this->request->querystringUrl = true;    
    	$querystring  = $this->request->CreateUrl($url);
		
		$urls = array(
    		'This is the current setting' => $current, 
    		'This would be the default url' => $default, 
    		'This should be a clean url' => $clean,
    		'This should be a querystring like url' => $querystring
		);
		
		$this->views->SetTitle($this->pageTitle);   
		$this->views->AddInclude(__DIR__ . '/links.tpl.php', array(
      		'menu'	=>$this->Menu(),
			'urls' 	=>$urls)
    	);
	}


  	/**
    * Create a method that shows the menu, same for all methods
   	*/
  	private function Menu() {
    	$menu = array(
    		'dev' => $this->request->CreateUrl('dev'), 
    		'dev/index' => $this->request->CreateUrl('dev/index'), 
    		'dev/links' => $this->request->CreateUrl('dev/links')
		);
    	return $menu;
	}
	/**
    * Display all items of the CObject.
    */
   	public function DisplayObject() {
		$this->views->SetTitle($this->pageTitle);   
		$this->views->AddInclude(__DIR__ . '/displayObject.tpl.php', array(
      		'menu'		=>$this->Menu(),
			'dumpVar'	=>'<pre>' . htmlentities(print_r($this, true)) . '</pre>')
    	);
   	}
}