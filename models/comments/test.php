<?php

session_start();
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");

$user_login = new USER();

$logged = $user_login->is_logged_in();

echo $logged;


?>