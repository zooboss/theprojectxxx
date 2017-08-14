<?php 
if (!defined("Admin") )
{
if (isset ($_SESSION))
{  
$_SESSION['userSession'] = false;
}	
exit ("Пошел на хуй");
}
else {
	
require_once "richtexteditor/include_rte.php" 

?>   


<div class="container">
        <form id="form1" method="POST" action="admin/editor/edit.php">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();
                if (!isset ($data) )
				{				
                $rte->Text="Новая статья"; 
                // Set a unique ID to Editor  
                }
                 else
				 {
				$rte->Text="21321321";	 
				 }					 
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
			
        </form>   
	</div>

		<script>  
$(document).ready(function(){
$('#form1').click(function( event ){
event.preventDefault();
		var editor_data = $("#Editor1").attr('value');
		$.ajax({ //отправляем ajax-запрос
        type: "POST", //тип (POST, GET, PUT, etc)
        url: "admin/edit.php", //адрес обработчика
        data: { 
		editor_data: editor_data	
		} //сами данные, передается POST[xmlUrl] со значением из data-link нажатой кнопки
    })
           .done(function( res ) { //при успехе (200 статус)
        	$('#form1').html(res) //заменяем блок с div.popup  полученной строкой от сервера.
           
    });
    
	}); 
    
});
</script> 

<?php } ?>