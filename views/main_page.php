<!DOCTYPE html>

<html>

<head> 

<title>      </title> <!-- Придумать название -->

<link href='#0' rel='icon' type='image/x-icon'/>	<!-- сгенерировать фавиконы для всех устройств --> 
<link type='text/css' rel='stylesheet' href='libs/css/bootstrap.css' />  <!-- локальное подключение для запуска на апаче -->
<link type='text/css' rel='stylesheet' href='css/style.css' />
<link type='text/css' rel='stylesheet' href='css/font-awesome.css' />
<link type='text/css' rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
        <a class='social-facebook' href='#' target='_blank'><i class='fa fa-facebook'></i></a>
        <a class='social-twitter' href='#' target='_blank'><i class='fa fa-twitter'></i></a>
        <a class='social-gplus' href='#' target='_blank'><i class='fa fa-google-plus'></i></a>
        <a class='social-linkedin' href='#' target='_blank'><i class='fa fa-linkedin'></i></a>
        <a class='social-pinterest' href='#' target='_blank'><i class='fa fa-pinterest'></i></a>
        <a class='social-youtube' href='#' target='_blank'><i class='fa fa-youtube'></i></a>
        <a class='social-vimeo' href='#' target='_blank'><i class='fa fa-vimeo-square'></i></a>
        <a class='social-instagram' href='#' target='_blank'><i class='fa fa-instagram'></i></a>
    </div>

</div>





<header>
    <div class="col-md-12">   
    <h1 class="text-center"> Название нашего сайта для СЕО, можно скрыть </h1>   
    </div>
</header>      
    


	
<section class='container-fluid articlesGallery'>
    
     <div class='row'>
    <!-- Вывод массива всех статей из бд-->
        <?php foreach ($articles as $a): ?>  
            <!-- отдельный блок статьи-->
        
            <div class='col-md-4 col-sm-6  article-wrap' >                           
                <div class='image-wrap'> <!-- Тестовая картинка-обертка -->
                    <img alt="#0" src="img/test_image.jpg">
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



	
	
	
	
	
	
	

	
	</body>
</html>