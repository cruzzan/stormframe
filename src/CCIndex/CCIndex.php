<?php
/**
* Standard controller layout.
*
* @package StormFrameCore
*/
class CCIndex implements IController {

   	/**
	* Implementing interface IController. All controllers must have an index action.
	*/
   	public function Index() {   
      	global $sf;
      	$sf->data['title'] = "The Index Controller";
		$sf->data['main'] = "<h1>The Index Controller</h1>"; 
   	}
} 