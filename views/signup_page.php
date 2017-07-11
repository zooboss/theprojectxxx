<?php
 require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php"); 
 require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration/signup.php"); 
 define ("No_login_form", false);
 ?>
<!DOCTYPE html>

<html>

<head>
	<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
</head>
    
<body>   

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<?php //вывод сообщения об отправке почты. 
if ( isset($_GET['email'])) 
{
$email = ($_GET['email']);
?>
<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Регистрация почти завершена!</strong>  Для активации учетной записи Вам необходимо перейти по ссылке, отправленный на <?php	echo $email ?>
			  		</div>
<?php					
} //вывод сообщения об отправке почты. 
?>


<?php if(isset($msg)) echo $msg;  ?>					
	<form class="cd-form floating-labels" method="post">
		<fieldset>
			<legend>Регистрация</legend>

			<!--<div class="error-message">
				<p>Пожалуйста, введите правильный email адрес</p>
			--></div>
	
			<div class="icon">
				<label class="cd-label" for="signup_login">Логин</label>
				<input class="user" type="text"  id="signup_login" name="txtuname" required>
                <div class="warning warning_disabled" id="login_warning">Логин занят или используются недопустимые символы</div>
		    </div> 
			
				<div class="icon">
				<label class="cd-label" for="login_public">Публичный никнейм</label>
				<input class="user" type="text"  id="login_public" name="txtunamepublic" required>
                <div class="warning warning_disabled" id="login_public_warning">Логин занят или используются недопустимые символы</div>
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="email">Адрес email</label>
				<input class="email" type="email" id='email' name="txtemail" required>
                <div class="warning warning_disabled" id="email_warning">Адрес почты занят или введен некорректно</div>
		    </div>
		    
		    <div class="icon">
		    	<label class="cd-label" for="password">Пароль</label>
				<input class="company" type="password" id='password' name="txtpass" required> <!-- type="text" -->
                <div class="warning warning_disabled" id="password_warning">Слишком короткий пароль</div>
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="password2">Подтвердите пароль</label>
				<input class="company" type="password" id='password2' name="txtpass_check" required> <!-- type="text" -->
                <div class="warning warning_disabled" id="password2_warning">Пароли не совпадают</div>
		    </div> 
		    
		</fieldset>

		<fieldset>
			<legend>Личные данные</legend>

			<!--<div>
				<h4>Ваш пол</h4>

				<p class="cd-select icon">
					<select class="budget">
						<option value="0">Select Budget</option>
						<option value="1">&lt; $5000</option>
						<option value="2">$5000 - $10000</option>
						<option value="3">&gt; $10000</option>
					</select>
				</p>
			--></div> 

			<div>
				<h4>Ваш пол</h4>

				<ul class="cd-form-list">
					<li>
						<input type="radio" name="gender" value="Мужской" id="gender_male" checked>
						<label for="gender_male">Мужской</label>
					</li>
						
					<li>
						<input type="radio" name="gender" value="Женский" id="gender_female">
						<label for="gender_female">Женский</label>
					</li>
					
				</ul>
			</div>
			
            <div class="icon">
				<label class="cd-label" for="date">Дата рождения</label>
				<input class="user" type="text" name='birthdate' id='date' value='' >  <!-- type="datetime" -->
		    </div> 
            
            <div class="icon">
		    	<label class="cd-label" for="phone_number_id">Номер телефона</label>
				<input class="company" type="text" name='phone_number'  value='' id="phone_number_id"> <!-- type="phone" -->
		    </div> 
		    
		    <div class="icon">
				<label class="cd-label" for="name_id">Имя</label>
				<input class="user" type="text" name="name" id="name_id" >
		    </div> 
		    <div class="icon">
				<label class="cd-label" for="surname_id">Фамилия</label>
				<input class="user" type="text" name="surname" id="surname_id" >
		    </div> 
		    <div class="icon">
				<label class="cd-label" for="patronymic_id">Отчество</label>
				<input class="user" type="text" name="patronymic" id="patronymic_id" >
		    </div> 

			<!--<div>
				<h4>Features</h4>

				<ul class="cd-form-list">
					<li>
						<input type="checkbox" id="cd-checkbox-1">
						<label for="cd-checkbox-1">Option 1</label>
					</li>

					<li>
						<input type="checkbox" id="cd-checkbox-2">
						<label for="cd-checkbox-2">Option 2</label>
					</li>

					<li>
						<input type="checkbox" id="cd-checkbox-3">
						<label for="cd-checkbox-3">Option 3</label>
					</li>
				</ul>
			</div>

			<div class="icon">
				<label class="cd-label" for="cd-textarea">Project description</label>
      			<textarea class="message" name="cd-textarea" id="cd-textarea" required></textarea>
			--></div>

			<div>
		      	<input type="submit" name="btn-signup" value="Отправить" id="submit" class="btnDisabled" disabled>
		    </div>
		</fieldset>
	</form>
 <!-- BOTTOM MENU -->
		<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>
</body>
</html>