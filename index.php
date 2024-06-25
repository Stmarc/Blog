<?php
declare(strict_types=1);
session_start();



$configuration=require_once('config/config.php');
require('Controllers/Controler.php');
require_once('Controllers/Request.php');

$request = new Request($_GET,$_POST);

$database = new Database($configuration);

$controler = new Controller($database,$request);

$controler->run();


?>