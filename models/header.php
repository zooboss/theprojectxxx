<div itemscope='itemscope' itemtype='http://schema.org/Blog' class="invisible">  <!-- Прописать в css display: none -->
<meta content='' itemprop='name'/>    <!-- Придумать название это тег для микроразметки и поисковиков -->
</div>

<div class='top-navigation'>

    <div class='navlist'>
       <a href="index.php"><img src = "img/logo.jpg" class = "logo"></a>
        <ul>
            
            <li class='selected'><a href='#0'>Политика</a></li>
            <li><a href='#0'>Экономика</a></li>
            <li><a href='#0'>История России</a></li>
            <li><a href='#0'>Всемирная история</a></li>
        </ul>
                        
    </div>

    <!-- Меню для планшетов и мобильных  -->

    <div id="top-hidden-menu">
        <span id='menu-trigger'>&#9776;</span>
        <span id="menu-close-trigger">&#10005;</span>
    </div>

    <div id="mySidenav" class="sidenav">
      <a href="#">Раздел 1</a>
      <a href="#">Раздел 2</a>
      <a href="#">Раздел 3</a>
      <a href="#">Раздел 4</a>
    </div>


    <!-- Меню для планшетов и мобильных  -->

    <div class='search-box'>
        <span class='icon-search'>
            <i class='fa fa-search'></i>
        </span>
        <form action='http://gridz-themexpose.blogspot.ru/search' method='get'>
            <input name='q' type='search' placeholder='Search and hit enter'/>
        </form>
    </div>
    
    <!-- подобрать иконки -->
    <div class='share-box'>
        <a href='#0' target='_blank'><i class='fa fa-facebook'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-twitter'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-vk'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-odnoklassniki'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-telegram'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-rss'></i></a>
        
    </div>

</div>

<?php if (!defined("No_login_form")) {         //если не определена переменная "No_login_form" - идем дальше, возможно, следует убрать этот пункт, изменив порядок.  
if(!$user_login->is_logged_in()) {?>   <!-- Быдлокод начало -->

 
<section id="login" class = "loginBlock container-fluid">
    <div class = "col-md-10 col-sm-6 text-center"><h1>Название сайта</h1></div>
    <div class = "col-md-2 col-sm-6 text-right">
        <div class = "loginSocial"> 
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
                <hr />
                <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>
				<input name="remember" type='checkbox' value='1'>
				Запомнить меня
                <a href="views/signup_page.php" class="btn btn-large">Регистрация</a><hr />
                <a href="views/forgot_pass_page.php">Забыли пароль ? </a>
		
				
			
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
 
  <?php  }  }?> <!-- Быдлокод конец -->