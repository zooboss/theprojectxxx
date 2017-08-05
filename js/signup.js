//Плавающие названия полей регистрации

jQuery(document).ready(function($){
	if( $('.floating-labels').length > 0 ) floatLabels();

	function floatLabels() {
		var inputFields = $('.floating-labels .cd-label').next();
		inputFields.each(function(){
			var singleInput = $(this);
			//check if user is filling one of the form fields 
			checkVal(singleInput);
			singleInput.on('change keyup', function(){
				checkVal(singleInput);	
			});
		});
	}

	function checkVal(inputField) {
		( inputField.val() == '' ) ? inputField.prev('.cd-label').removeClass('float') : inputField.prev('.cd-label').addClass('float');
	}
});


//Функционал проверки данных регистрации

jQuery(document).ready(function($){
var login,
	email,
	password,
	password2,
	loginStat,
	emailStat,
	passwordStat,
	password2Stat;

$(function() {
	//Логин
	$("#signup_login").change(function(){
        console.log("login start");
        login = $("#signup_login").val();
		var expLogin = /^[а-яА-ЯёЁa-zA-Z0-9]+$/g;
		var resLogin = login.search(expLogin);
		if(resLogin == -1){
			/*$("#login").next().hide().text("Неверный логин").css("color","red").fadeIn(400);
			$("#login").removeClass().addClass("inputRed");*/
            $("#login_warning").removeClass("warning_disabled");
			loginStat = 0;
			buttonOnAndOff();
		}else{
			$.ajax({
			url: "models/registration/testLoginEmail.php",
			type: "GET",
			data: "login=" + login,
			cache: false,
			success: function(response){
                console.log("login success");
				if(response == "no"){
					/*$("#login").next().hide().text("Логин занят").css("color","red").fadeIn(400);
					$("#login").removeClass().addClass("inputRed");*/	
                    $("#login_warning").removeClass("warning_disabled");
				}else{					
					/*$("#login").removeClass().addClass("inputGreen");
					$("#login").next().text("");*/
                    $("#login_warning").addClass("warning_disabled");
				}			
				
			},
            error: function(xhr, status, error){
              console.log(xhr.responseText);;
           } 
		});
			loginStat = 1;
			buttonOnAndOff();
            console.log("buttononoff_event");
		}
		
	});
	$("#login").keyup(function(){
        /*
		$("#login").removeClass();
		$("#login").next().text("");
        */
        $("#login_warning").addClass("warning_disabled");
	});
	
	// Email
	$("#email").change(function(){
		email = $("#email").val();
		var expEmail = /[-0-9a-z_]+@[-0-9a-z_]+\.[a-z]{2,6}/i;
		var resEmail = email.search(expEmail);
		if(resEmail == -1){
			/*
            $("#email").next().hide().text("Неверный формат Email").css("color","red").fadeIn(400);
			$("#email").removeClass().addClass("inputRed");
            */
            $("#email_warning").removeClass("warning_disabled");
            emailStat = 0;
			buttonOnAndOff();
		}else{
			
			$.ajax({
			url: "models/registration/testLoginEmail.php",
			type: "GET",
			data: "email=" + email,
			cache: false,			
			success: function(response){
				if(response == "no"){
					/*
                    $("#email").next().hide().text("Email Занят").css("color","red").fadeIn(400);
					$("#email").removeClass().addClass("inputRed");
                    */
                    $("#email_warning").removeClass("warning_disabled");
                    emailStat = 0;
                    buttonOnAndOff();
				}else{					
					/*
                    $("#email").removeClass().addClass("inputGreen");
					$("#email").next().text("");
                    */
                    $("#email_warning").addClass("warning_disabled");
                    emailStat = 1;
                    buttonOnAndOff();
				}					
			}    
		      });
			
			
		}
		
	});	
	$("#email").keyup(function(){
        /*
		$("#email").removeClass();
		$("#email").next().text("");
        */
        $("#email_warning").addClass("warning_disabled");
	});	
	
	
	//Пароль
	$("#password").change(function(){
		password = $("#password").val();
		if(password.length < 6){
            /*
			$("#password").next().hide().text("Слишком короткий пароль").css("color","red").fadeIn(400);
			$("#password").removeClass().addClass("inputRed");
            */
            $("#password_warning").removeClass("warning_disabled");
			passwordStat = 0;
			buttonOnAndOff();
		}else{
            /*
			$("#password").removeClass().addClass("inputGreen");
			$("#password").next().text("");
            */
            $("#password_warning").addClass("warning_disabled");
			passwordStat = 1;
			buttonOnAndOff();
		}		
	});
	$("#password").keyup(function(){
        /*
		$("#password").removeClass();
		$("#password").next().text("");
        */
        $("#password_warning").addClass("warning_disabled");
        
	});
	
	//Проверка пароля
	$("#password2").change(function(){
		if(password2 != password){
            /*
			$("#password2").next().hide().text("Пароли не совпадают").css("color","red").fadeIn(400);
			$("#password2").removeClass().addClass("inputRed");
            */
            $("#password2_warning").removeClass("warning_disabled");
			password2Stat = 0;
			buttonOnAndOff();
		}else{
            /*
			$("#password2").removeClass().addClass("inputGreen");
			$("#password2").next().text("");
            */
            $("#password2_warning").addClass("warning_disabled");
		}		
	});
	$("#password2").keyup(function(){
		password2 = $("#password2").val();
		if(password2 == password){
			password2Stat = 1;
			buttonOnAndOff();
		}else{
			password2Stat = 0;
			buttonOnAndOff();
		}
	});
	
	function buttonOnAndOff(){
        //console.log(emailStat, passwordStat, password2Stat, loginStat);
        console.log(emailStat + " " + passwordStat + " " + password2Stat + "Login " + loginStat);
        if(emailStat == 1 && passwordStat == 1 && password2Stat == 1 && loginStat == 1){
			$("#submit").removeAttr("disabled").removeClass().addClass("btnEnabled");
		}else{
			$("#submit").attr("disabled","disabled").removeClass().addClass("btnDisabled");
		}
	
	}
    
  /*  
	<script>
    $(document).on('ready', function(){
    showForm.preventDefault();

		window.alert("we are in special place");
		
  });
</script>
    
    */
});
  
//Маски

$(document).ready(function() {

  $(":input[data-inputmask-mask]").inputmask();

  $(":input[data-inputmask-alias]").inputmask();

  $(":input[data-inputmask-regex]").inputmask("Regex");

});    
    
$(function(){
    $("#phone_number_id").inputmask("8 (999) 999-9999");
}); 
   
$(function(){
    
    $("#login_public").inputmask("email");
            
            
              
});
    
    
    
    
    
    
});



















