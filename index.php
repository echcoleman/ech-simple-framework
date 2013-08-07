<?php

// set directory paths
define('DS', DIRECTORY_SEPARATOR);
define('PATH', dirname(__FILE__) . DS);
define('PAGES_PATH', PATH . 'pages' . DS);
define('VIEWS_PATH', PATH . 'views' . DS);

// define site url
$siteurl = dirname(str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']));
$siteurl = rtrim($siteurl, '/') . '/';
define('SITEURL', $siteurl);

// include library
require_once('lib/EchSimpleFramework.php');
require_once('lib/Utilities.php');

// set site name
define('SITENAME', 'ECH Simple Framework');

// dispatch
$ech = new EchSimpleFramework();
$ech->page_handler();

?>