<!DOCTYPE html>

<html>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
<body>   
 
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<?php if ($user_login->is_logged_in()=="") 
 {?>
 
 	 
        
           <div class = "text-center">
                <div class = "modal-header">
                    <h4><b>ДЛЯ ПРОСМОТРА ПРОФИЛЯ НЕОБХОДИМО АВТОРИЗИРОВАТЬСЯ</b></h4>
                </div>
                <div class = "modal-body">
                    <section id="login" class = "loginBlock container-fluid">
                           
                            <div class = "loginSocial text-center"> 
                               <p class = "text-center">ВОЙТИ ЧЕРЕЗ:</p>
                              
                                <a href = "#0"><div class = "loginSocialLink"></div></a>
                                <a href = "#0"><div class = "loginSocialLink"></div></a>
                                <a href = "#0"><div class = "loginSocialLink"></div></a>
                                <a href = "#0"><div class = "loginSocialLink"></div></a>
                            </div>   
                                               
                            <div class = "loginStandart">
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
                                <form class="cd-form floating-labels" method="post">
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
                                    <fieldset>
                                       <div class = "icon">
                                            <label class="cd-label" for="main-login">Логин</label>
                                            <input class = "user" type="text" name="uname" id = "main-login" required />
                                        </div>
                                        <div class = "icon">
                                            <label class="cd-label" for="main-password">Пароль</label>
                                            <input class = "company" type="password"  name="txtupass" id = "main-password" required />
                                        </div>
                                   </fieldset>
                                    
                                    <ul class="cd-form-list">
                                        <li>
                                            <input name="remember" id="remember" type='checkbox' value='1'>
                                            <label for="remember">запомнить меня</label>
                                        </li>
                                    </ul>
                                   <button class="btn btn-large btn-primary btn-login pull-right" type="submit" name="btn-login">ВОЙТИ</button>
                                   <p class = "p-register-button"><a href="index.php?send=registration&registration=1" class = "register-button btn btn-success pull-right">РЕГИСТРАЦИЯ</a></p>
                                   <p class = "text-right"><a href="index.php?send=forgot_pass&forgot_pass=1">Забыли пароль?</a></p>
                                </form>
                                                                                        

                          </div>

                        
                    </section>
                </div>
             </div>   
       

<?php } ?>
 
 
 <?php if($user_login->is_logged_in()!="" and $row['userID']==$_GET['userID'])
 {  // Быдлокод начало
 //echo '<h1>Вы вошли как ' . $row['userName'] . ', но кого это ебет?</h1>';
 //echo '<a tabindex="-1" href="/theprojectxxx/models/registration/logout.php">Выйти</a>  '; //Исправить путь
  ?>   
   
  <h4>Логин: <?php echo $row['userName'] ?></h4>
   <h4>E-mail: <?php echo $row['userEmail'] ?></h4>
   <h4>Фамилия: <?php echo $row['Surname'] ?></h4>
   <h4>Имя: <?php echo $row['Name'] ?></h4>
   <h4>Отчество: <?php echo $row['Patronymic'] ?></h4>
   <h4>Дата рождения: <?php echo $row['birthday'] ?></h4>
   <h4>Пол: <?php echo $row['sex'] ?></h4>
    <h4>Телефон:   <?php echo $row['phone'] ?></h4>
		
  
  
  <?php  } ?> <!-- Быдлокод конец -->
  
  <?php 
// Вывод данных другого пользователя через новое PDO//



  if ($user_login->is_logged_in()!="" and $row['userID']!==$_GET['userID']) {  ?>
	<?php 

$pdo = new PDO('mysql:host=localhost;dbname=blog;charset=UTF8','root','');
	$statment = $pdo->prepare('SELECT * FROM users WHERE userID = ?');
    $statment->execute([$_GET['userID']]);
foreach ($statment as $line)
{ ?>
   <h1>Профиль <?php echo $line['userName'] ?></h1>
   <h4>Логин: <?php echo $line['userName'] ?></h4>
   <h4>Фамилия: <?php echo $line['Surname'] ?></h4>
   <h4>Имя: <?php echo $line['Name'] ?></h4>
   <h4>Отчество: <?php echo $line['Patronymic'] ?></h4>
   <h4>Дата рождения: <?php echo $line['birthday'] ?></h4>
   <h4>Пол: <?php echo $line['sex'] ?></h4>
<?php
}
 echo '<a tabindex="-1" href="/theprojectxxx/models/registration/logout.php">Выйти</a>  '; //Исправить путь
}
 
?>
         
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>
    

</body>
</html>