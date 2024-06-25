<?php
echo('test');
session_start();

$_SESSION = array();


session_destroy();


header('Location: localhost');

?>
