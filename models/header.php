<div itemscope='itemscope' itemtype='http://schema.org/Blog' class="invisible">  <!-- Прописать в css display: none -->
<meta content='' itemprop='name'/>    <!-- Придумать название это тег для микроразметки и поисковиков -->
</div>

<!-- Cookie initiation -->
<?php

    // Проверка дано ли согласие на куки, вызывается аяксом из мейн.жс //
    if ( !isset( $_COOKIE[ 'cookie_accept' ] ) ) {
        ?>
        <div id = "cookie-initial" class = "container-fluid">
            <div class = "container">  
               <div class = "col-xs-10 ">
                 <p>
                     Администрация сайта просит вашего разрешения на использования cookie-файлов при навигации по сайту <span style="white-space: nowrap;" >russian-tribune.ru</span>
                     Это делается в целях улучшения работы сайта и повышения его комфортабельности. 
                 </p>
               </div>
               <div class = "col-xs-2">
                   <button id = "cookie-accept" class = "btn btn-warning"> ОК </button>
               </div>
            </div>
        </div>
    <?php
    }
?>


<header class='top-navigation container-fluid total-header'>

 
  <?php if (!isset($_COOKIE['_SS']))
  { ?>
   <div class = 'navlist col-md-3 hidden-sm hidden-xs'>
       <a href="/theprojectxxx/index.php"><img src = "/theprojectxxx/img/logotype.png" class = "logo"></a>
   </div>
  <?php } ?>    
    <div class='navlist col-md-6 hidden-sm hidden-xs'>
       
        <ul id = "everywhere-top-navigation-menu">
            
            <li class='selected'><a href='' cathegory-type = "main">Главная</a></li>
            <li><a href='' cathegory-type = "actual">События</a></li>
            <li><a href='' cathegory-type = "future">Тренды</a></li>
            <li><a href='' cathegory-type = "past">История</a></li>
        </ul>
                        
    </div>


    <!-- Аватар-Меню -->
    <div class = "col-md-1 offset-md-0 col-sm-1 offset-sm-11 col-xs-1 offset-xs-11 text-right">
        <div class = "btn-group" id = "avatar-image-dropdown">
            
            <a  class="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class = "header-profile-image" src = 
                <?php
                     if ($user_login->is_logged_in()!="") {
                         echo "/theprojectxxx/img/icons/full_user.jpg";
                     }
                     else {
                         echo "/theprojectxxx/img/icons/empty_user.png";
                     }
                
                ?>
                >
            </a>
            <div class="dropdown-menu dropdown-menu-right">
               <?php
                     if ($user_login->is_logged_in()!="") {
                ?>
                         <a href = "<?php echo 'user-'.$row['userID'].'.html'?>" class = "dropdown-item btn">
                             <img class = "login-icon" src = "/theprojectxxx/img/icons/login_icon.svg">
                             Профиль
                         </a>
                         <div class="dropdown-divider"></div>
                         <a href = "/theprojectxxx/models/registration/logout.php" class = "dropdown-item btn">
                             <img class = "login-icon" src = "/theprojectxxx/img/icons/logout_icon.svg">
                             Выйти
                         </a>
              <?php
                     }
                     else {
                ?>
                         <button type = "button" class = "dropdown-item" data-toggle = "modal" data-target = "#login-window">
                            <img class = "login-icon" src = "/theprojectxxx/img/icons/login_icon.svg">
                            Войти
                        </button>
             <?php
                     }
                
            ?>
                
                                   
            </div>
        </div>
        
        
    </div>        
                        
                                    
                                                
                                                            
                                                                                    
    <!-- Соцсети -->
    <div class='col-md-2 hidden-sm hidden-xs social-links'>
        
        <a href='#0' target='_blank'><i class='fa fa-facebook'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-twitter'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-vk'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-odnoklassniki'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-telegram'></i></a>
        <a href='#0' target='_blank'><i class='fa fa-rss'></i></a>
        
    </div>
    <!-- Меню для планшетов и мобильных  -->

        <div id="top-hidden-menu">
            <span id='menu-trigger'>&#9776;</span>
            <span id="menu-close-trigger">&#10005;</span>
        </div>

        <div id="mySidenav" class="sidenav">
          <a href="/theprojectxxx/index.php">Главная</a>
          <a href="#">События</a>          
          <a href="#">Тренды</a>
          <a href="#">История</a>
        </div>
</header>







<?php if (!defined("No_login_form")) {         //если не определена переменная "No_login_form" - идем дальше, возможно, следует убрать этот пункт, изменив порядок.  
if(!$user_login->is_logged_in()) {?>   <!-- Быдлокод начало -->

<!-- MODAL LOGIN WINDOW -->
    <div id = "login-window" class = "modal fade" role = "dialog">
        <div class = "modal-dialog" role = "document">
            <div class = "modal_content">
                
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
        </div>
    </div>
<!-- END OF MODAL -->    


 <?php 
    }   

} ?> <!-- Быдлокод конец --> 
  
