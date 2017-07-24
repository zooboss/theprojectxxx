<?php 
if (!defined("Security") )
{
	header('Location: https://navalny.com/');
	exit ("Пошел на хуй");	 
}

else {	
$cookie_bd = $row['cookie'];
$cookie_local = $_COOKIE['admin_session'];
if (!isset($_COOKIE['admin_session'])or ($cookie_bd !== $cookie_local) )
{
exit ("Пошел на хуй");		
}
else 
{
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/admin/admin_functions.php");	  
$_SESSION['adminSession'] = GenUnicPass();
$update_Session ='-+*M,./(31M'.$_SESSION['adminSession'].'GhUy891246/*- '.'  ';
$update_Session = hash("sha256", $update_Session );	
?>
<h3>Админка</h3>
<ol class="rounded">
  <li><a class="send" href="#0" data="New_article" session="<?php echo $update_Session; ?>" >Добавить новую статью</a></li>
  <li><a class="send" href="#0" data="">Пользователи</a></li>
</ol>
<script>  
$(document).ready(function(){
$('.send').click(function( event ){
event.preventDefault();
		var data = $(this).attr('data');
		var id = $(this).attr('session');
		$.ajax({ //отправляем ajax-запрос
        type: "POST", //тип (POST, GET, PUT, etc)
        url: "admin/admin.php", //адрес обработчика
        data: { 
		Data: data,	
		ID: id
		} //сами данные, передается POST[xmlUrl] со значением из data-link нажатой кнопки
    })
           .done(function( res ) { //при успехе (200 статус)
        	$('.articlesGallery').html(res) //заменяем блок с div.popup  полученной строкой от сервера.
            $('#section-search').remove()
    });
    
	}); 
    
});
</script> 
<?php 
}

}
?> 
