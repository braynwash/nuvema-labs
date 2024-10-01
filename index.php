<?php
/**
 * Author: Sarah Wood, Jeremy Black
 * Date: 4/2/24
 * File: index.php
 * Description: Loads the autoloader and Dispatcher for RESTful routing.
 */

//load config
require_once ("application/config.php");

//load autoloader
require_once ("vendor/autoload.php");

//session_start();
if (!isset($_SESSION['trainer'])) {
    // start the session
    session_start();
}

//create a new instance of the dispatcher that dissects a request URL
new Dispatcher();