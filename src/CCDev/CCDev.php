<?php
/**
* Standard controller layout.
*
* @package StormFrameCore
*/
class CCDev implements IController {

   	/**
	* Implementing interface IController. All controllers must have an index action.
	*/
   	public function Index() {   
      	$this->Menu();
   	}
	public function Links() {  
      	$this->Menu();
    
    	$sf = CStormFrame::Instance();
    
    	$url = 'dev/links';
    	$current      = $sf->request->CreateUrl($url);

    	$sf->request->cleanUrl = false;
    	$sf->request->querystringUrl = false;    
    	$default      = $sf->request->CreateUrl($url);
    
   		$sf->request->cleanUrl = true;
    	$clean        = $sf->request->CreateUrl($url);    
    
    	$sf->request->cleanUrl = false;
    	$sf->request->querystringUrl = true;    
    	$querystring  = $sf->request->CreateUrl($url);
    
    	$sf->data['main'] .= <<<EOD
    	<h2>CRequest::CreateUrl()</h2>
    	<p>Here is a list of urls created using above method with various settings. All links should lead to this same page.</p>
    	<ul>
    	<li><a href='$current'>This is the current setting</a>
    	<li><a href='$default'>This would be the default url</a>
    	<li><a href='$clean'>This should be a clean url</a>
    	<li><a href='$querystring'>This should be a querystring like url</a>
    	</ul>
    	<p>Enables various and flexible url-strategy.</p>
EOD;
}


  	/**
    * Create a method that shows the menu, same for all methods
   	*/
  	private function Menu() {  
    	$sf = CStormFrame::Instance();
    	$menu = array('dev', 'dev/index', 'dev/links');
    
    	$html = null;
    	foreach($menu as $val) {
      		$html .= "<li><a href='" . $sf->request->CreateUrl($val) . "'>$val</a>";  
    	}
    
    	$sf->data['title'] = "The Developer Controller";
    	$sf->data['main'] = <<<EOD
		<h1>The Developer Controller</h1>
		<p>This is what you can do for now:</p>
		<ul>
		$html
	</ul>
EOD;
	}
}