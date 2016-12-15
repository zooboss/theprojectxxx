<!DOCTYPE html>

<html>

<head> 

<title>      </title> <!-- Придумать название -->

<link href='#0' rel='icon' type='image/x-icon'/>	<!-- сгенерировать фавиконы для всех устройств --> 
<link type='text/css' rel='stylesheet' href='libs/css/bootstrap.css' />  <!-- локальное подключение для запуска на апаче -->
<link type='text/css' rel='stylesheet' href='css/style.css' />
<link type='text/css' rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link type='text/css' rel='stylesheet' href='libs/css/font-awesome.css' />
<script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type='text/javascript' src="js/main.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
    
<body>   




<div itemscope='itemscope' itemtype='http://schema.org/Blog' class="invisible">  <!-- Прописать в css display: none -->
<meta content='' itemprop='name'/>    <!-- Придумать название это тег для микроразметки и поисковиков -->
</div>

<div class='top-navigation'>

    <div class='navlist'>
        <ul>
               <img src = "img/logo.jpg" class = "logo">
            <li class='selected'><a href='#0'>Главная</a></li>
            <li><a href='#0'>About</a></li>
            <li><a href='#0'>Contact Us</a></li>
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


<header>
    <div class="col-md-12">   
    <h1 class="text-center"> Название нашего сайта для СЕО, можно скрыть </h1>   
    </div>
</header>      

<?php if(!$user_login->is_logged_in()) {?>   <!-- Быдлокод начало -->
 
<div id="login">
    <div class="container"> 
	
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
        <h2 class="form-signin-heading">Войти.</h2><hr />
        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>
        <a href="models/registration/signup.php" style="float:right;" class="btn btn-large">Регистрация</a><hr />
        <a href="models/registration/fpass.php">Забыли пароль ? </a>
      </form>

    </div> <!-- /container -->
  </div>
 <?php }   // быдлокод конец
 elseif($user_login->is_logged_in()!="")
 {
 echo '<h1>Вы вошли как ' . $row['userName'] . ', но кого это ебет?</h1>';
 echo '<a tabindex="-1" href="/theprojectxxx/models/registration/logout.php">Выйти</a>  '; //Исправить путь
 }  ?>   <!-- Быдлокод конец -->
 
  
  
	
<section class='container-fluid articlesGallery'>
    
     <div class='row'>
    <!-- Вывод массива всех статей из бд-->
        <?php foreach ($articles as $a): ?>  
            <!-- отдельный блок статьи-->
        
            <div class='col-md-4 col-sm-6  article-wrap' >                           
                <div class='image-wrap'> <!-- Тестовая картинка-обертка -->
                    <img alt="#0" src="img/test_image3.jpg">
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

<section class = "bottomMenu container-fluid">
    <div class = "container">
        <div class = "col-md-2 col-sm-2 col-xs-6">
            <ul>
                <li>Название сайта</li>
                <li><a href = "#0">Главная</a></li>
                <li><a href = "#0">О проекте</a></li>
                <li><a href = "#0">Контакты</a></li>
                <li><a href = "#0">Реклама</a></li>
            </ul>
        </div>
        <div class = "col-md-2 col-sm-2 col-xs-6">
            <ul>
                <li>Рубрики</li>
                <li><a href = "#0">Политика</a></li>
                <li><a href = "#0">Экономика</a></li>
                <li><a href = "#0">История России</a></li>
                <li><a href = "#0">Всемирная история</a></li>
            </ul>
        </div>
        
        <div class = "col-md-2 col-sm-2 col-xs-6">
            <ul>
                <li>Мы в соцсетях</li>
                <li><a href='#0' target='_blank'><i class='fa fa-facebook-square'> Facebook </i></a></li>
                <li><a href='#0' target='_blank'><i class='fa fa-twitter-square'> Twitter </i></a></li>
                <li><a href='#0' target='_blank'><i class='fa fa-vk'></i> Вконтакте </a></li>
            </ul>
        </div>
        
        <div class = "col-md-2 col-sm-2 col-xs-6">
            <ul>
                <li> &nbsp; </li>
                <li><a href='#0' target='_blank'><i class='fa fa-odnoklassniki-square'></i> Одноклассники </a></li>
                <li><a href='#0' target='_blank'><i class='fa fa-telegram'></i> Telegramm </a></li>
                <li><a href='#0' target='_blank'><i class='fa fa-rss'></i> RSS </a></li>
            </ul>
        </div>
        
        <div class = "col-md-4 col-sm-4 col-xs-12">
           <div class = "mailerHeader">
               Подпишитесь на нашу рассылку
           </div>
            <div class = "searchBottom">
                <form action='http://gridz-themexpose.blogspot.ru/search' method='get'>
                    <input name='q' type='search' placeholder='Ваш email'/>
                </form>
            </div>
        </div>
        
</section>
    
<!-- Footer -->
   
<footer>
   <div class = "container">
                   
        <div class = "copyright text-right">
            SiteName done by SiteName Studio &copy; 2016. Все права защищены.
        </div>
        
    </div>
</footer>
    

</body>
</html>