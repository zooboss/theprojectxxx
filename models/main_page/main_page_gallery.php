<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/functions.php");
$articles = articles_all();
$articles_in_block = $_POST['articlesInBlock'];
$request_type = $_POST['requestType']; 

$block_number = 1;
if( isset($_POST['blockNumber']) ){
    $block_number = $_POST['blockNumber'];
}

$articles_to_show = $block_number * $articles_in_block;

ob_start();


switch ($request_type){
    case "initial_request":

    ?>

    <section id = "articlesGallery" class='articlesGallery clearfix'  >

         <!-- Вывод массива всех статей из бд-->
            <?php 
             $master_key = 0;
             $minor_key = 0;
             

             //foreach ($articles as $a)
             //{
                //while($master_key < count($articles)){
                while($master_key < $articles_to_show){    
                   ?>

                    <div class = "columns" id = "block-<?php echo $block_number ?>">  
                                                            <?php
                                                            while ($minor_key % ($articles_in_block + 1) < $articles_in_block){
                                                                if ($master_key < $articles_to_show){
                                                                    $a = $articles[$master_key];
                                                                }
                                                                else{
                                                                    break;
                                                                }   
                                                                ?>    

                         <!-- отдельный блок статьи-->
                        <div class='article-wrap' >                           
                        <div class='image-wrap'> <!-- Тестовая картинка-обертка -->
                            <img alt="#0" src="img/articles/article_image-<?=$a['id']?>.jpg" class = "main-page-main-image"> 

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

                                                               <?php 

                                                                $master_key++;
                                                                $minor_key++;
                                                            }
                                                            $minor_key = 0;
                                                            ?>
                    </div>

                    <!-- <div class = "column-page"></div> -->
                    <?php
                    $block_number++;
                }
             //}

    ?>       
    </section>   <!-- galery -->
<?php
    break;
        
    case "scroll_request":
        $master_key = $articles_to_show - $articles_in_block;
        $minor_key = 0;
    ?>
       
        <div class = "columns" id = "block-<?php echo $block_number ?>">  
                                                            <?php
                                                            while ($minor_key % ($articles_in_block + 1) < $articles_in_block){
                                                                if ($master_key < $articles_to_show){
                                                                    $a = $articles[$master_key];
                                                                }
                                                                else{
                                                                    break;
                                                                }   
                                                                ?>    

                         <!-- отдельный блок статьи-->
                        <div class='article-wrap' >                           
                        <div class='image-wrap'> <!-- Тестовая картинка-обертка -->
                            <img alt="#0" src="img/articles/article_image-<?=$a['id']?>.jpg" class = "main-page-main-image"> 

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

                                                               <?php 

                                                                $master_key++;
                                                                $minor_key++;
                                                            }
                                                            $minor_key = 0;
                                                            ?>
            </div>
    <?php
    break;
        
}
?>
   
   
    
<?php
  $articles_html = ob_get_contents();
  ob_end_clean();
  echo json_encode($articles_html); // вернем полученное в ответе
  exit;
?>




















