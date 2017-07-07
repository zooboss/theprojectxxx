<!DOCTYPE html>

<html>

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/head.php"); ?>
    
<body>   

<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/header.php"); ?>

<section id = "section-search" class = "container-fluid">
    <div class = "row">
        <div class = "col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
           
            <input type = "search" placeholder = "Поиск..." name = "search" class = "main-search">
                      
        </div>
    </div>
</section>	
			
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
                        <a href="index.php?id=<?=$a['id']?>#comments"><i class='fa fa-comment'></i></a> 
                        <a href="index.php?id=<?=$a['id']?>#comments">48</a>
                    </div>
                   
                    <div class = "articleDateAnimate"> 
                        <p>2016</p> 
                        <p>дек/08</p>
                    </div>
                </div>
                
                <div class='post-body'>
                    <div class='post-title'>
                        <h2><a href="index.php?id=<?=$a['id']?>"> <?php echo $a['title'] ?> </a></h2> <!-- Вывод названия статьи, первые 100 символов по дефолту -->
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
                        <a href="index.php?id=<?=$a['id']?>"><div class='read'>Читать </div></a>
                    </div>
                </div>
            </div>   
        
        <!-- отдельный блок статьи-->
        <?php endforeach ?>
    </div>
</section>   <!-- galery -->

        <!-- BOTTOM MENU -->
		<?php include_once( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/footer.php"); ?>

<!-- MODAL LOGIN WINDOW -->
    <div id = "login-window" class = "modal fade" role = "dialog">
        <div class = "modal-dialog" role = "document">
            <div class = "modal_content">
                <div class = "modal-header">
                    <button type = "button" class = "close" data-dismiss = "modal">&times;</button> 
                    <h4 class = "modal-title">Логин</h4>
                </div>
                <div class = "modal-body">
                    <section id="login" class = "loginBlock container-fluid">
    
                        <div class = "text-right">
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
                                    <fieldset>
                                        <input type="text" placeholder="Логин" name="uname" required />
                                        <input type="password"  placeholder="Пароль" name="txtupass" required />

                                   </fieldset>

                                   <label for="remember">Запомнить меня</label>
                                   <input name="remember" id="remember" type='checkbox' value='1'>
                                   <button class="btn btn-large btn-primary" type="submit" name="btn-login">Войти</button>

                              </form>
                                <p><a href="views/forgot_pass_page.php">Восстановить пароль </a></p>
                                <p><a href="views/signup_page.php" >Регистрация</a></p>

                          </div>

                        </div>
                    </section>
                </div>
                <div class = "modal-footer">
                    <button type = "button" class = "btn btn-default" data-dismiss = "modal">Закрыть</button>
                </div>
                
            </div>
        </div>
    </div>
<!-- END OF MODAL -->    

</body>
</html>