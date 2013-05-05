<?php
//
// PHASE: BOOTSTRAP
//
define('STORMFRAME_INSTALL_PATH', dirname(__FILE__));
define('STORMFRAME_APP_PATH', STORMFRAME_INSTALL_PATH . '/application');

require(STORMFRAME_INSTALL_PATH.'/src/CStormFrame/bootstrap.php');

$sf = CStormFrame::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//
$sf->FrontControllerRoute();

//
// PHASE: THEME ENGINE RENDER
//
$sf->ThemeEngineRender();