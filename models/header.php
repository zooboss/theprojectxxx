<div itemscope='itemscope' itemtype='http://schema.org/Blog' class="invisible">  <!-- Прописать в css display: none -->
<meta content='' itemprop='name'/>    <!-- Придумать название это тег для микроразметки и поисковиков -->
</div>

<div class='top-navigation'>

    <div class='navlist'>
       <a href="/theprojectxxx/index.php"><img src = "/theprojectxxx/img/logo.jpg" class = "logo"></a>
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
    <!--
    <div class='search-box'>
        <span class='icon-search'>
            <img src = "img/icons/empty_user.png">
        </span>
        <form action='http://gridz-themexpose.blogspot.ru/search' method='get'>
            <input name='q' type='search' placeholder='Search and hit enter'/>
        </form>
    </div>
    -->
            
    <!-- подобрать иконки -->
    <div class='share-box'>
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
            <div class="dropdown-menu">
                <button type = "button" class = "dropdown-item" data-toggle = "modal" data-target = "#login-window">
                    <img class = "login-icon" src = "/theprojectxxx/img/icons/login_icon.svg">
                    Войти
                </button>
                                   
            </div>
        </div>
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
                                   <p class = "p-register-button"><a href="views/signup_page.php" class = "register-button btn btn-success pull-right">РЕГИСТРАЦИЯ</a></p>
                                   <p class = "text-right"><a href="views/forgot_pass_page.php">Забыли пароль?</a></p>
                                </form>
                                                                                        

                          </div>

                        
                    </section>
                </div>
                
                
            </div>
        </div>
    </div>
<!-- END OF MODAL -->    


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