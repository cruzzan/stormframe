<?php
/**
* Site configuration, this file is changed by user per site.
*
*///////////////////////////////////////////////////////////

/*
* Set level of error reporting
*/
error_reporting(-1);
ini_set('display_errors', 1);

/*
* Define session name
*/
$sf->config['session_name'] = preg_replace('/[:\.\/-_]/', '', $_SERVER["SERVER_NAME"]);
$sf->config['session_key']  = 'stormframe';

/*
* Define server timezone
*/
$sf->config['timezone'] = 'Europe/Stockholm';

/*
* Define internal character encoding
*/
$sf->config['character_encoding'] = 'ISO-8859-1';

/*
* Define language
*/
$sf->config['language'] = 'en';

/**
* Define the controllers, their classname and enable/disable them.
*
* The array-key is matched against the url, for example:
* the url 'developer/dump' would instantiate the controller with the key "developer", that is
* CCDeveloper and call the method "dump" in that class. This process is managed in:
* $sf->FrontControllerRoute();
* which is called in the frontcontroller phase from index.php.
*/
$sf->config['controllers'] = array(
	'index' 		=> array('enabled' => true,'class' 	=> 'CCIndex'),
	'dev' 			=> array('enabled' => true, 'class' => 'CCDev' ),
	'guestbook' 	=> array('enabled' => true, 'class' => 'CCGuestBook' ),
	'user' 			=> array('enabled' => true, 'class' => 'CCUser' ),
);

/**
* Settings for the theme.
*/
$sf->config['theme'] = array(
  // The name of the theme in the theme directory
  'name'    => 'default',
);

/**
 * Google analytics: change UA-XXXXX-X to be your site's ID
 */
$sf->config['googleAnalyticsID'] = "UA-XXXXX-X";

/**
* Set a base_url to use another than the default calculated
*/
$sf->config['base_url'] = null;

/**
* What type of urls should be used?
*
* default      = 0      => index.php/controller/method/arg1/arg2/arg3
* clean        = 1      => controller/method/arg1/arg2/arg3
* querystring  = 2      => index.php?q=controller/method/arg1/arg2/arg3
*/
$sf->config['url_type'] = 1;

/**
* Set what to show during print of get_debug().
*/
$sf->config['debug']['showDebug'] 		= false;
$sf->config['debug']['showDBNumQuerys'] = true;
$sf->config['debug']['showDBQuerys'] 	= true;
$sf->config['debug']['timer'] 			= true;
$sf->config['debug']['session'] 		= true;

/**
 * Set database(s).
 */
$sf->config['database'][0]['dsn'] = 'mysql:host=localhost;dbname=StormFrameTest';

/**
 * Set username and password for database(s).
 */
$sf->config['database'][0]['uname'] = 'stormframe';
$sf->config['database'][0]['pass'] 	= 'defaultpass';
