<?php require_once "richtexteditor/include_rte.php" ?>   
<html>   
<body>   
        <form id="form1" method="POST" action="edit.php">   
            <?php   
                // Create Editor instance and use Text property to load content into the RTE.  
                $rte=new RichTextEditor();   
                $rte->Text="Type here"; 
                // Set a unique ID to Editor   
                $rte->ID="Editor1";    
                $rte->MvcInit();   
                // Render Editor 
                echo $rte->GetString();  
            ?>   
        </form>   
</body>   
</html> 