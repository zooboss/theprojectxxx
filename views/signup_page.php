<?php
    include(dirname(__FILE__) . "/../models/registration/signup.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup | Coding Cage</title>

    <link rel="stylesheet" href="/theprojectxxx/libs/css/pickmeup.css" type="text/css" />	
    <link type='text/css' rel='stylesheet' href='/theprojectxxx/css/style.css' />
    <script type="text/javascript" src="/theprojectxxx/libs/js/pickmeup.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type='text/javascript' src="/theprojectxxx/js/signup.js"></script>
    
</head>
 
<script type="text/javascript">

</script>

  <body >
	<?php if(isset($msg)) echo $msg;?>

      <form  method="post">
        <h2 class="form-signin-heading">Sign Up TEST</h2><hr />
		<label><font color='red'>*</font> Ваш Логин:<br></label>
        <input type="text" class="input-block-level" id='login' placeholder="Логин" name="txtuname" required /> <span></span> <br> 
		
		<label><font color='red'>*</font> Ваш E-mail:<br></label>
        <input type="text" class="input-block-level" id='email' placeholder="Адрес электронной почты" name="txtemail" required /> <span></span> <br>
        
		<label><font color='red'>*</font> Ваш пароль:<br></label>
		<input type="password" class="input-block-level" id='password' placeholder="Пароль" name="txtpass" required /> <span></span> <br>
		
		<label><font color='red'>*</font> Подтвердите пароль:<br></label>
		<input type="password" class="input-block-level" id='password2' placeholder="Проверка пароля" name="txtpass_check" required /> <span></span>  <br>
	    
		<input type="radio" name="gender" value="Мужской"/>мужской
        <input type="radio" name="gender" value="Женский"/> женский <br>
  	Дата рождения(гггг.мм.дд): <input type="datetime" name='birthdate' id='date' value='' /> 
		Номер телефона (полный с кодом страны)<input type="phone" name='phone_number'  value='' /> <br>
		<input type="text" class="input-block-level" placeholder="Имя" name="name" /> <br>
		<input type="text" class="input-block-level" placeholder="Фамилия" name="surname"  /> <br>
		<input type="text" class="input-block-level" placeholder="Отчество" name="patronymic"  /> 
  		
       	<hr />
       <input type="submit" name="btn-signup" value="Зарегистрироваться" id="submit" disabled>
        <!--<a href="index.php" style="float:right;" class="btn btn-large">Sign In</a>-->
      </form>
	  
<script type='text/javascript'>
addEventListener('DOMContentLoaded', function () {
	pickmeup('#date', {
		position       : 'right',
		hide_on_select : true
	});
});
</script>


<!--Проверка пароля, логина и всего остального -->

	  


	

  </body>
</html>