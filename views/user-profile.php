<!DOCTYPE html>

<html>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
<body>   
 
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<?php if(!$user_login->is_logged_in()) {?>   <!-- Быдлокод начало -->

<section id="login" class = "loginBlock container-fluid container-fluid-my">
    <div class = "col-md-10 col-sm-6 text-center"><h1>Название сайта</h1></div>
    <div class = "col-md-2 col-sm-6 text-right">
        <div class = "loginSocial"> 
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
                    Ваш профиль не активирован, подтвердите E-mail для просмотра других пользователей
                </div>
                <?php
            }
            ?>
      </div>
      
    </div>
</section>
 <?php } // быдлокод конец ?> 
 
 <?php if($user_login->is_logged_in()!="" and $row['userID']==$_GET['userID'])
 {  // Быдлокод начало
 //echo '<h1>Вы вошли как ' . $row['userName'] . ', но кого это ебет?</h1>';
 //echo '<a tabindex="-1" href="/theprojectxxx/models/registration/logout.php">Выйти</a>  '; //Исправить путь
  ?>   
   <div class='alert alert-success'>
                     <h3>Моя страница</h3>
                    </div>
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
 
 if ($user_login->is_logged_in()=="") 
 {?>
 <h2>зарегестрируйтесь или авторизуйтесь для просмотра профиля</h2>
 	 <form class="form-signin" method="post">
                <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
                <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
                <hr />
                <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>
                <a href="models/registration/signup.php" class="btn btn-large">Регистрация</a><hr />
                <a href="models/registration/fpass.php">Забыли пароль ? </a>
          </form>

<?php } ?>
<section class='container-fluid container-fluid-my articlesGallery'>
    

	
     
</section>   <!-- galery -->

        <!-- BOTTOM MENU -->
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>
    

</body>
</html>