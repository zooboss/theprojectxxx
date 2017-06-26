<?php
session_start();
require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
$user = new USER();

if(!$user->is_logged_in())
{
	$user->redirect('http://localhost/theprojectxxx');   //Пути сменить!//
}

if($user->is_logged_in()!="")
{
	$user->logout();	
	$user->redirect('http://localhost/theprojectxxx');    //Пути сменить!//
}
?>