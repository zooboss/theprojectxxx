<!DOCTYPE html>

<html>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
<body>   

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>


<?php if(!$user_login->is_logged_in()) {?>   <!-- Быдлокод начало -->

 
<section id="login" class = "loginBlock container-fluid">
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

                <input type="text" placeholder="Логин" name="uname" required />
                <input type="password"  placeholder="Пароль" name="txtupass" required />
                Запомнить меня <input name='remember' type='checkbox' value='1'>
                <hr />
                <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>
                <a href="views/signup_page.php" class="btn btn-large">Регистрация</a><hr />
                <a href="models/registration/fpass.php">Забыли пароль ? </a>
          </form>
      </div>
      
    </div>
</section>
 <?php }   // быдлокод конец
 elseif($user_login->is_logged_in()!="")
 {  // Быдлокод начало
 echo '<h1>Вы вошли как ' . $row['PublicUserName'] . ', но кого это ебет?</h1>';
 echo '<a tabindex="-1" href="/theprojectxxx/models/registration/logout.php">Выйти</a>  '; //Исправить путь
  ?>   
   <div class='alert alert-success'>
                     <h3>Моя страница</h3>
                     <a href=' <?php echo 'user-'.$row['userID'].'.html'?>' ><?php echo $row['PublicUserName'] ?></a>
					 
                    </div>
 
  <?php  } ?> <!-- Быдлокод конец -->
	
<section class='container-fluid articlesGallery'>
    
     <div class='row'>
    <!-- Вывод массива всех статей из бд-->
        <?php foreach ($articles as $a): ?>  
            <!-- отдельный блок статьи-->
        
            <div class='col-md-4 col-sm-6  article-wrap' >                           
                <div class='image-wrap'> <!-- Тестовая картинка-обертка -->
                    <img alt="#0" src="img/test_image4.jpg">
                    <div class='post-author'>

                        <div class='image-thumb'>
                            <img alt='#0' title='#0' src='img/author_icon.jpg'/>
                            <cite> 
                                <a href="#0"><?php echo "Author"; ?></a> 
                                <span><?php echo "{$a['date']}"; ?> </span>
                            </cite>  <!-- Вывод автора статьи, необходимо добавить в бд, пока выводится дата добавления -->
                        </div>
                    </div>
                    <div class = "articleImageAnimate"></div>
                    <div class = "articleCathegoryAnimate"> <a href='#0'>политика</a></div>
                    <div class = "articleCommentsAnimate"> 
                        <a href='#0'><i class='fa fa-comment'></i></a> 
                        <a href='#0'>48</a>
                    </div>
                    <div class = "articleDateAnimate"> 
                        <p>2016</p> 
                        <p>дек/08</p>
                    </div>
                </div>
                
                <div class='post-body'>
                    <div class='post-title'>
                        <h2><a href='#0'> <?php echo $a['title'] ?> </a></h2> <!-- Вывод названия статьи, первые 100 символов по дефолту -->
                    </div>

                    <div class='post-entry'>
                     <p> <?php echo articles_intro($a['content']) ?></p> <!-- Вывод текста, первые 100 символов по дефолту -->
                    </div>

                    <div class='postfooter clearfix'>
                       <i class='fa fa-comment linker'></i>
                        <a class='linker' href='#0' >48 Комментариев</a>
                        <!-- Социалки для превью статьи
                            <div class='socialpost'>
                               <div class='icons clearfix'>
                                <a href='#0'><i class='fa fa-facebook'></i><div class='texts'>Facebook</div></a>
                                <a href='#0'><i class='fa fa-vk'></i><div class='texts'>VK</div></a>
                                <a href='#0'><i class='fa fa-twitter'></i><div class='texts'>Twitter</div></a>
                                </div>
                               
                            </div>
                        --> 
                        <a href='#0'><div class='read'>Читать </div></a>
                    </div>
                </div>
            </div>   
        
        <!-- отдельный блок статьи-->
        <?php endforeach ?>
    </div>
</section>   <!-- galery -->

        <!-- BOTTOM MENU -->
		<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>

    

</body>
</html>