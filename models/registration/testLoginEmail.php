<?php
if(isset($_GET['email'])){
	$email = $_GET['email'];
	try {
    $handler = new PDO('mysql:host=localhost;dbname=blog','root', '');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    exit($e->getMessage());
}
$sthandler = $handler->prepare("SELECT userEmail FROM users WHERE userEmail = :email");
$sthandler->bindParam(':email', $email);
$sthandler->execute();
if($sthandler->rowCount() > 0){
    echo "no";
} 
else{
echo "yes";
}
}


if(isset($_GET['login'])){
$username = $_GET['login'];
try {
    $handler = new PDO('mysql:host=localhost;dbname=blog;charset=utf8','root', '');
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    exit($e->getMessage());
}

$sthandler = $handler->prepare("SELECT userName FROM users WHERE userName = :name");
$sthandler->bindParam(':name', $username);
$sthandler->execute();
if($sthandler->rowCount() > 0){
    echo "no";
} 
else{
echo "yes";
}
}
?>