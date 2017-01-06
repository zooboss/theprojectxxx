<?php


if(isset($_GET['email'])){
	$email = $_GET['email'];
	if($email == 'test@test.ru'){
		echo "no";
	}else{
		echo "yes";
	}
}

if(isset($_GET['login'])){
	$login = $_GET['login'];
	if($login == 'user'){
		echo "no";
	}else{
		echo "yes";
	}
}
?>