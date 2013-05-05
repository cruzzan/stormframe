<?php
/**
* Bootstrapping, setting up and loading the core.
*
* @package StormFrameCore
*/

/**
* Enable auto-load of class declarations.
*/
function autoload($aClassName) {
	$classFile = $aClassName . "/" . $aClassName . ".php";
	$file1 = STORMFRAME_INSTALL_PATH . "/src/" . $classFile;
	$file2 = STORMFRAME_APP_PATH . "/" . $classFile;
	if(is_file($file1)) {
    	require_once($file1);
	}elseif(is_file($file2)) {
  		require_once($file2);
	}
}
spl_autoload_register('autoload');