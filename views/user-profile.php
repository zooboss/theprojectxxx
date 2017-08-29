<!DOCTYPE html>

<html>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
<script src="/theprojectxxx/js/profile.js"></script>
    
<body>   
 
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<section class = "container-fluid container-fluid-my">
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


    <?php }
    
    //Залогиненный пользователь
    
    else {
    
         if($user_login->is_logged_in()!="" and $row['userID']==$_GET['userID'])
         {  
          ?>   
            <div class = "personal-body">
                <div class = "row">
                    <div class = "personal-avatar offset-md-4 col-md-4 offset-sm-0 col-sm-6 offset-xs-0 col-xs-12 text-center">
                        <img src = "/theprojectxxx/img/icons/full_user.jpg" class = "personal-avatar">
                        <h1><?php echo $row['userName'] ?></h1>
                        
                    </div>
                </div>
                <div class = "divider"></div>
                <div class = "row">
                    <div class = "offset-md-2 col-md-4 offset-sm-0 col-sm-5 offset-xs-0 col-xs-12">
                        <div class = "panel panel-info personal-panel">
                            <div class = "panel-heading text-center">
                                Персональные данные
                            </div>
                            <div class = "panel-body personal-info">

                                   <h4>Логин: <?php echo $row['userName'] ?></h4>
                                   <h4>E-mail: <?php echo $row['userEmail'] ?></h4>
                                   <h4>Фамилия: <?php echo $row['Surname'] ?></h4>
                                   <h4>Имя: <?php echo $row['Name'] ?></h4>
                                   <h4>Отчество: <?php echo $row['Patronymic'] ?></h4>
                                   <h4>Дата рождения: <?php echo $row['birthday'] ?></h4>
                                   <h4>Пол: <?php echo $row['sex'] ?></h4>
                                   <h4>Телефон:   <?php echo $row['phone'] ?></h4>
                                    
                                    <div class = "text-right">
                                        <button class = "btn btn-success">
                                            Изменить данные
                                        </button>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    <div class = "col-md-4  col-sm-5  col-xs-12">
                        <div class = "panel panel-info personal-panel">
                            <div class = "panel-heading text-center">
                                Активность
                            </div>
                            <div class = "panel-body personal-info">

                                <a href = #0 id = "articles_not_visited"><h4>Непрочитанные статьи</h4></a>
                                <a href = #0 id = "my_comments"         ><h4>Ваши комментарии</h4></a>
                                <a href = #0 id = "my_replies"          ><h4>Ответы</h4></a>
                                <a href = #0 id = "personal_messages"   ><h4>Личные сообщения</h4></a>
                                <a href = #0 id = "rating"              ><h4>Рейтинг</h4></a>
                                
                            </div>
                        </div>
                    </div>
                   
                                        
                    
                </div>
            </div>
            <div class = "offset-md-2 col-md-8 offset-sm-2 col-sm-8 col-xs-12 personal-output"
                 id = "personal-data"
                 username = "<?php echo $row['PublicUserName'] ?>"
               
               
               >
                
            </div>



          <?php  
            } ?> 
            

          <?php 
        
        // Вывод данных другого пользователя через новое PDO//



          if ($user_login->is_logged_in()!="" and $row['userID']!==$_GET['userID']) {  ?>
            <?php 

            $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=UTF8','root','');
                $statement = $pdo->prepare('SELECT * FROM users WHERE userID = ?');
                $statement->execute([$_GET['userID']]);
                $statement = $statement->fetchAll();
              
            foreach ($statement as $line)
            { ?>
               <h1><?php echo $line['userName'] ?></h1>
               <h4>Логин: <?php echo $line['userName'] ?></h4>
               <h4>Фамилия: <?php echo $line['Surname'] ?></h4>
               <h4>Имя: <?php echo $line['Name'] ?></h4>
               <h4>Отчество: <?php echo $line['Patronymic'] ?></h4>
               <h4>Дата рождения: <?php echo $line['birthday'] ?></h4>
               <h4>Пол: <?php echo $line['sex'] ?></h4>
            <?php
            }
        }
    }
    ?>
    
</section>                 
                  
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>
    

</body>
</html>