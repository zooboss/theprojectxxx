<!DOCTYPE html>

<html>
    <head>
        <?php 
        include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); 
        ?>
    </head>
    
<body>   



<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<section id = "section-search" class = "container-fluid container-fluid-my">
    <div class = "row">
        <div class = "col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
           
            <input type = "search" placeholder = "Поиск..." name = "search" class = "main-search">
                      
        </div>
    </div>
</section>	
		
<?php   if ($user_login->is_logged_in()!="" and $row['role']=="chief")
{ //если залогинен и шеф
define("Security", true);
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/admin/index.php"); //включаем первый редактор
if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session'])) //проверяем наличие админской сессии
{
	if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;  //убиваем сессию, если нет адмиской сессии
}	
exit ("Пошел на хуй");
} //конец проверяем наличие админской сессии

else { //если все ок и есть запрос от редактора в admin/index.php плдключаем редактор на текущей странице, форма редактора ссылаетсяна текущую страницы.
   if (isset($_POST["Editor1"]) and !isset ($_SERVER['HTTP_X_REQUESTED_WITH']) and defined("security"))
   {
	   require_once ($_SERVER['DOCUMENT_ROOT'] ."/theprojectxxx/admin/editor/richtexteditor/include_rte.php");
	   $data = $_POST["Editor1"];
	   require_once ($_SERVER['DOCUMENT_ROOT'] ."/theprojectxxx/admin/editor/edit.php");
	   ?>
	   <form id="form1" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text=  $data ; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
        </form> 
 <?php    
 }
  else 
 {
  //Возможно, лишнее условие
 }
 }

 
}// конец если залогинен и шеф
else {	//если не админ
?>		
<section class='container-fluid container-fluid-my articlesGallery'>
    
     <!-- Вывод массива всех статей из бд-->
        <?php 
         $count = 0;
         foreach ($articles as $a)
         {
             
           ?>
            
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
                        <a href="index.php?send=article&id=<?=$a['id']?>#comments"><i class='fa fa-comment'></i></a> 
                        <a href="index.php?send=article&id=<?=$a['id']?>#comments">48</a>
                    </div>
                   
                    <div class = "articleDateAnimate"> 
                        <p>2016</p> 
                        <p>дек/08</p>
                    </div>
                </div>
                
                <div class='post-body'>
                    <div class='post-title'>
                        <h2><a href="index.php?send=article&id=<?=$a['id']?>"> <?php echo $a['title'] ?> </a></h2> <!-- Вывод названия статьи, первые 100 символов по дефолту -->
                    </div>

                    <div class='post-entry'>
                     <p> <?php echo articles_intro($a['content']) ?></p> <!-- Вывод текста, первые 100 символов по дефолту -->
                    </div>

                    <div class='postfooter clearfix'>
                       <i class='fa fa-comment linker'></i>
                        <a class='linker' href="index.php?send=article&id=<?=$a['id']?>#comments" >48 Комментариев</a>
                        <!-- Социалки для превью статьи
                            <div class='socialpost'>
                               <div class='icons clearfix'>
                                <a href='#0'><i class='fa fa-facebook'></i><div class='texts'>Facebook</div></a>
                                <a href='#0'><i class='fa fa-vk'></i><div class='texts'>VK</div></a>
                                <a href='#0'><i class='fa fa-twitter'></i><div class='texts'>Twitter</div></a>
                                </div>
                               
                            </div>
                        --> 
                        <a href="index.php?send=article&id=<?=$a['id']?>"><div class='read'>Читать </div></a>
                    </div>
                </div>
            </div> 
             
        
        <!-- отдельный блок статьи-->
       
	   
	  <?php 
	  }
} // конец если не админ		
?>
    
</section>   <!-- galery -->

        <!-- BOTTOM MENU -->
		<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>



</body>
</html>