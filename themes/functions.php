<?php
/**
* Helpers for theming, available for all themes in their template files and functions.php.
* This file is included right before the themes own functions.php
*/

/**
* Create a url by prepending the base_url.
*/
function base_url($url) {
	return CStormFrame::Instance()->request->base_url . trim($url, '/');
}

/**
* Return the current url.
*/
function current_url() {
 	return CStormFrame::Instance()->request->current_url;
}
/**
* Print debuginformation from the framework.
*/
function get_debug() {
	$sf = CStormFrame::Instance();
	$html = "";
  	if(isset($sf->config['debug']['showDebug']) && $sf->config['debug']['showDebug']){
  		$html .= "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($sf->config, true)) . "</pre>";
  		$html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($sf->data, true)) . "</pre>";
  		$html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($sf->request, true)) . "</pre>";
  	}
  	if(isset($sf->config['debug']['showDBNumQuerys']) && $sf->config['debug']['showDBNumQuerys']){
  		$flash = $sf->session->GetFlash('showDBNumQuerys');
    	$flash = $flash ? "$flash + " : null;
  		$html .= "<p>Database made $flash" . $sf->dbh->GetNumQueries() . " queries.</p>";
  	}
	if(isset($sf->config['debug']['showDBQuerys']) && $sf->config['debug']['showDBQuerys']){
		$flash = $sf->session->GetFlash('showDBQuerys');
    	$queries = $sf->dbh->GetQueries();
    	if($flash) {
      		$queries = array_merge($flash, $queries);
    	}
  		$html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $queries) . "</pre>";
  	}
	if(isset($sf->config['debug']['timer']) && $sf->config['debug']['timer']) {
   		$html .= "<p>Page was loaded in " . round(microtime(true) - $sf->timer['first'], 5)*1000 . " msecs.</p>";
  	} 
	if(isset($sf->config['debug']['session']) && $sf->config['debug']['session']) {
   		$html .= "<hr><h3>SESSION</h3><p>The content of CStormFrame->session:</p><pre>" . htmlent(print_r($sf->session, true)) . "</pre>";
    	$html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
  	}
  
  	return $html;
}

/**
* Render all views.
*/
function render_views() {
  return CStormFrame::Instance()->views->Render();
}

/**
* Get messages stored in flash-session.
*/
function get_messages_from_session() {
  $messages = CStormFrame::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}

/**
* Create a url to an internal resource.
*
* @param string the whole url or the controller. Leave empty for current controller.
* @param string the method when specifying controller as first argument, else leave empty.
* @param string the extra arguments to the method, leave empty if not using method.
*/
function create_url($urlOrController=null, $method=null, $arguments=null) {
  return CStormFrame::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}