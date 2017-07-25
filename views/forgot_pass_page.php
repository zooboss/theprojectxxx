<?php
 require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration.php");
 require_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/registration/fpass.php"); 
 define ("No_login_form", false);
 ?>

<!DOCTYPE html>
<html>
  <head>
  
  <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
  
  </head>
  <body>
  
   <?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>
   
    <div class="container forgot-password-container">

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
    
     <!-- BOTTOM MENU -->
		<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>
  </body>
</html>