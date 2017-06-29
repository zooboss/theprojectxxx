<?php
 require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
 require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration/fpass.php"); 
 
 ?>

<!DOCTYPE html>
<html>
  <head>
    
    <!-- Bootstrap 
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
    -->
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/theprojectxxx/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/theprojectxxx/css/signup.css"> <!-- Resource style -->
	<link type='text/css' rel='stylesheet' href='/theprojectxxx/libs/css/bootstrap.css' />  <!-- локальное подключение для запуска на апаче -->
    <link type='text/css' rel='stylesheet' href='/theprojectxxx/css/style.css' />
    <link type='text/css' rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link type='text/css' rel='stylesheet' href='/theprojectxxx/libs/css/font-awesome.css' />
	<script src="/theprojectxxx/libs/js/modernizr.js"></script> <!-- Modernizr -->
    <script src="/theprojectxxx/libs/js/jquery-2.1.1.js"></script> <!-- JQuery -->
    <script src="/theprojectxxx/js/signup.js"></script>
  	
	<title>Forgot Password Form</title>
  </head>
  <body id="login">
    <div class="container">

      <form class="cd-form floating-labels" method="post">
		<fieldset>
            <h2 class="form-signin-heading">Восстановление пароля</h2><hr />

                <?php
                if(isset($msg))
                {
                    echo $msg;
                }
                else
                {
                    ?>
                    <div class='alert alert-info'>
                    Введите адрес Вашей электронной почты. Вы получите ссылку для создания нового пароля на ваш email.				</div>  
                    <?php
                }
                ?>
            <div class="icon">
                <label class="cd-label" for="email_restore">Адрес email</label>
                <input type="email" id="email_restore" class="email"  name="txtemail" required />
            </div>
        </fieldset>
        <button class="btn btn-danger btn-primary pull-right" type="submit" name="btn-submit">Создать новый пароль</button>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>