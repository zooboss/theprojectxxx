<?php
session_start();
require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
$user = new USER();

if(!$user->is_logged_in())
{
	if (isset($_SERVER['HTTP_REFERER'])){	
	$user->redirect($_SERVER['HTTP_REFERER']); 
    }
    else	
	$user->redirect($_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx");	//Пути сменить!//
}

if($user->is_logged_in()!="")
{
   if (isset($_SERVER['HTTP_REFERER'])){	   
	$user->redirect($_SERVER['HTTP_REFERER']); 
	$user->logout();
    }
    else	
	$user->redirect( "/theprojectxxx");	//Пути сменить!//
    $user->logout();
 
}
?>