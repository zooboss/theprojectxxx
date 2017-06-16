<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="/theprojectxxx/css/reset_template.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="/theprojectxxx/css/signup_template.css"> <!-- Resource style -->
	<script src="/theprojectxxx/js/signup_template.js"></script> <!-- Modernizr -->
  	
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
				<label class="cd-label" for="cd-name">Логин</label>
				<input class="user" type="text" name="cd-name" id="login" name="txtuname" required>
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="cd-email">Адрес email</label>
				<input class="email error" type="email" id='email' name="txtemail" required>
		    </div>
		    
		    <div class="icon">
		    	<label class="cd-label" for="cd-company">Пароль</label>
				<input class="company" type="text" id='password' name="txtpass" required> <!-- type="text" -->
		    </div> 
		    
		    <div class="icon">
		    	<label class="cd-label" for="cd-company">Подтвердите пароль</label>
				<input class="company" type="text" id='password2' name="txtpass_check" required> <!-- type="text" -->
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
						<input type="radio" name="gender" value="Мужской" checked>
						<label for="cd-radio-1">Мужской</label>
					</li>
						
					<li>
						<input type="radio" name="gender" value="Женский">
						<label for="cd-radio-2">Женский</label>
					</li>
					
				</ul>
			</div>
			
            <div class="icon">
				<label class="cd-label" for="cd-name">Дата рождения</label>
				<input class="user" type="text" name='birthdate' id='date' value='' >  <!-- type="datetime" -->
		    </div> 
            
            <div class="icon">
		    	<label class="cd-label" for="cd-company">Номер телефона</label>
				<input class="company" type="text" name='phone_number'  value='' id="cd-company"> <!-- type="phone" -->
		    </div> 
		    
		    <div class="icon">
				<label class="cd-label" for="cd-name">Имя</label>
				<input class="user" type="text" name="name" id="cd-name" >
		    </div> 
		    <div class="icon">
				<label class="cd-label" for="cd-name">Фамилия</label>
				<input class="user" type="text" name="surname" id="cd-name" >
		    </div> 
		    <div class="icon">
				<label class="cd-label" for="cd-name">Отчество</label>
				<input class="user" type="text" name="patronymic" id="cd-name" >
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
		      	<input type="submit" name="btn-signup" value="Отправить" >
		    </div>
		</fieldset>
	</form>
<script src="/theprojectxxx/libs/js/jquery-2.1.1.js"></script>
<script src="/theprojectxxx/js/main_template.js"></script> <!-- Resource jQuery -->
</body>
</html>