<?php require_once "richtexteditor/include_rte.php" ;


?>  
<body>   
<h3>Предпросомотр</h3>
<?php
$data = $_POST["Editor1"];
echo  $data;
?>
<form id="add_article" method="POST" action="add_new_article.php">
<input type="hidden" class="" name="content" value="<?php echo  $data; ?>" ></input> 
<input type="submit" class="" name="btn-comment" value="Добавить статью"></input>
 </form>

     
</body> 


<h2>Редактирование </h2>

      <form id="form1" method="POST" action="edit.php">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text=$data; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
        </form>