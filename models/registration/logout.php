<?php
session_start();
require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect($_SERVER['HTTP_REFERER']);   //Пути сменить!//
}

if($user->is_logged_in()!="")
{
	$user->logout();
    setcookie('username', $uname, time()-3600, '/'); //Логин Пути!
    setcookie('key', $key, time()-3600,  '/');	//Кука Пути!
	$user->redirect($_SERVER['HTTP_REFERER']);    //Пути сменить!//
}
?>