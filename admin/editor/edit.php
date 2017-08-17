<?php 
if (!isset($_POST["Editor1"]) and !isset($_POST["title"])) {  //проверяем наличие нужного Post запроса
 exit ("Пошел на хуй1");	
  }
else 
{  
session_start ();
if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['_SS'])) //проверяем наличие админской сессии
{
	if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;  //убиваем сессию, если нет адмиской сессии
}	
exit ("Пошел на хуй");
}
else { // если есть админская сессия и админский кукис
  
if (isset ($_POST["Editor1"]) and !isset ($_SERVER['HTTP_X_REQUESTED_WITH'])  ) //Если есть запрос Post и нет никакого заголовка
{	  
if (!defined("security")) // конец проверка на наличие переменной из admin/admin.php
{
	exit ("3112");
}
else 
	{
	require_once "richtexteditor/include_rte.php" ;
	$data = $_POST["Editor1"];
?>  

<h3>Предпросомотр</h3>
  
<section class = "container-fluid container-fluid-my article-body">
    <div class = "col-md-9 col-sm-12 col-xs-12 ">
	
	        <div class = "article">
           <div class = "article-main-image-wrap">
            <img alt="#0" id="preview" src="" class = "img-responsive pull-left"> 
           </div>
            <div class = "article-header">
                <h1> <strong><?=$article['title']?></strong> </h1>
            </div>

			<div class = "article-content">
			<?php
			echo  $data;
			?>
			</div> 

			
			
        </div>
   
            
        
            
        </div>

		
		 <!-- Форма дополнительных параметров -->
	 <div class="col-sm-12 col-md-12">

                <h2 >Дорогой модератор, пожалуйста, заполни поля: "название", "ключевые слова", и добавь картинку, иначе будешь послан</h2>
				  <form id="add_article"  class="form-horizontal" enctype="multipart/form-data" method="POST" action="http://localhost/theprojectxxx/admin/editor/edit.php">
                    <div class="form-group form-material">
                      <label class="col-sm-3 control-label">Название статьи теги H1 и title (255) </label>
                      <div class="col-sm-9">
                        <input type="text" required class="form-control" name="title" placeholder="Статья о хороших людях" autocomplete="off"
                        />
                      </div>
                    </div>
					
					  <div class="form-group form-material">
                      <label class="col-sm-3 control-label">Ключевые слова, тег Keywords, через запятую (300) </label>
                      <div class="col-sm-9">
                        <input type="text" required class="form-control" name="keywords" placeholder="политика, Путин, скаклы," autocomplete="off"
                        />
                      </div>
                    </div>
					
					  <div class="form-group form-material">
                      <label class="col-sm-3 control-label">Главная картинка статьи</label>
                      <div class="col-sm-9">
                       <input class="input-group" id="image" type="file" name="article_image" accept="image/*" required />              
                      </div>
                    </div>
					
					<div class="form-group form-material">
                      <label class="col-sm-3 control-label">атрибут alt для главной картинки (50)</label>
                      <div class="col-sm-9">
                        <input type="text" required class="form-control" name="main_alt" placeholder="Милонов" autocomplete="off"
                        />
                      </div>
                    </div>
            

                    <textarea name="content" style="display:none;"><?php echo  $data; ?></textarea>
					
                    <div class="form-group form-material">
                      <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit"  class="btn btn-primary">Добавить статью </button>
                        <button type="reset" class="btn btn-danger">Сбросить дополнительные параметры </button>
                      </div>
                    </div>
                  </form>
               
            
			  </div>
   
</section>


<script>
$(document).ready(function () {
 
  function readImage ( input ) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
 
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      }
 
      reader.readAsDataURL(input.files[0]);
    }
  }

 
  $('#image').change(function(){
    readImage(this);
  });
 

});
</script>

 
<h2>Редактирование</h2>

	
	<?php	
	} // конец проверка на наличие переменной из admin/admin.php
	}  //Конец если есть запрос Post и он не от Аякса
	

elseif  (isset($_POST["content"])  and !isset($_SERVER['HTTP_X_REQUESTED_WITH']))  //если есть контент и нет аяксса
{	
define("Redactor_check", true);	
require_once "add_new_article.php" ;	
$add_article_content = new ARTICLES();
$recieved_date = $_POST["content"]; //статья
if (isset($_POST["title"]) and isset($_POST["keywords"]) )
{
$title = $_POST["title"]; //название
$keywords = $_POST["keywords"]; //ключевые слова
$main_alt = $_POST["main_alt"]; //alt главной картинки
$article_date = date("Y.m.d.");  //дата
$article_time = date("H:i:s");   //время

$imgFile = $_FILES['article_image']['name'];  //получаям имя картинки
$tmp_dir = $_FILES['article_image']['tmp_name'];  //формат
$imgSize = $_FILES['article_image']['size'];    //получаям размер
$ip = $_SERVER["REMOTE_ADDR"];
$ip_1 = ip2long($ip);
$add_article_content->add_article($recieved_date,$article_date,$article_time,$ip_1,$title,$keywords,$main_alt,$imgFile,$tmp_dir,$imgSize);
echo "Добавлено";
session_destroy();
}
else
{ // если не заполнено поле с ключевыми словами и названием 
$_SESSION['userSession'] = false;	
exit ("Пошел на хуй");	
}  // конец если не заполнено поле с ключевыми словами и названием 
} // конец если есть контент и нет аяксса
else   //если нет контента и есть аякс
{
$_SESSION['userSession'] = false;	
exit ("Пошел на хуй");	
}
} // конец если есть админская сессия и админский кукис
}


	?> 
		