<?php
session_start();
require_once("/models/registration.php"); 
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
	$user_login->redirect('views/main_page.php');
}
 
if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass)) 
	{
		$user_login->redirect('views/main_page.php');
	}
}
require_once(dirname(__FILE__)."/models/database.php");
$link = db_connect();

require_once(dirname(__FILE__) . "/models/functions.php");
$articles = articles_all($link);



?>
  <div id="login">
    <div class="container">
		<?php 
		if(isset($_GET['inactive']))
		{
			?>
            <div class='alert alert-error'>
				<button class='close' data-dismiss='alert'>&times;</button>
				Не активирован
			</div>
            <?php
		}
		?>
        <form class="form-signin" method="post">
        <?php
        if(isset($_GET['error']))
		{
			?>
            <div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				<strong>Неправильный логин или пароль</strong> 
			</div>
            <?php
		}
		?>
        <h2 class="form-signin-heading">Войти.</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>
        <a href="models/registration/signup.php" style="float:right;" class="btn btn-large">Регистрация</a><hr />
        <a href="models/registration/fpass.php">Забыли пароль ? </a>
      </form>

    </div> <!-- /container -->
    <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </div>
