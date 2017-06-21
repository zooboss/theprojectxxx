<?php
    require_once(dirname(__FILE__) . "/../models/registration/signup.php");

?>


<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/theprojectxxx/css/reset_template.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/theprojectxxx/css/signup_template.css"> <!-- Resource style -->
	<script src="/theprojectxxx/libs/js/modernizr.js"></script> <!-- Modernizr -->
    <script src="/theprojectxxx/libs/js/jquery-2.1.1.js"></script> <!-- JQuery -->
    <script src="/theprojectxxx/js/main_template.js"></script>
  	
	<title>Contact Form | CodyHouse</title>
</head>
<body>
	<form class="cd-form floating-labels" method="post">
		<fieldset>
			<legend>Регистрация</legend>

			<!--<div class="error-message">
				<p>Пожалуйста, введите правильный email адрес</p>
			--></div>

			<div class="icon">
				<label class="cd-label" for="login">Логин</label>
				<input class="user" type="text"  id="login" name="txtuname" required>
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="email">Адрес email</label>
				<input class="email error" type="email" id='email' name="txtemail" required>
		    </div>
		    
		    <div class="icon">
		    	<label class="cd-label" for="password">Пароль</label>
				<input class="company" type="password" id='password' name="txtpass" required> <!-- type="text" -->
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="password2">Подтвердите пароль</label>
				<input class="company" type="password" id='password2' name="txtpass_check" required> <!-- type="text" -->
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
		      	<input type="submit" name="btn-signup" value="Отправить" id="submit" disabled>
		    </div>
		</fieldset>
	</form>

</body>
</html>