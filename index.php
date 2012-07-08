<?php session_start();

/**
 * Bootstrap file.
 * 
 * @author Andreas Bourakis <bourakis@gmail.com>
 * @contributors
 * @copyright omicro.net
 * @link http://www.github.com/addboo/yaf
 * @license http://www.opensource.org/licenses/mit-license.php
 * @requires
 *
 * @version: 0.1
**/

/** 
 * DESCRIPTION:
 * Bootstrap file.
 *
 * 
**/


// Paths initialisation.
$_SESSION['BASE_PATH'] = dirname(__FILE__);
$_SESSION['CORE_PATH'] = dirname(__FILE__).'/core';
$_SESSION['CONFIG_PATH'] = dirname(__FILE__).'/protected/configs/';

// Get config contents.
$cfg = require_once($_SESSION['CONFIG_PATH'].'config.php');

// Set Application's path.
$_SESSION['APP_PATH'] = dirname(__FILE__)."/".$cfg['app_dir_name'];

require_once($_SESSION['CORE_PATH'].'/Timer.php');
$timeEx = new Timer();
$timeEx->reStart();

require_once($_SESSION['CORE_PATH'].'/Yaf.php');

Yaf::run($cfg);


echo "Requested time: ". $timeEx->theTime();
?>