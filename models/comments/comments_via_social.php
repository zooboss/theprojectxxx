<?php 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
$article_comments = new COMMENTS();		

if (isset($_POST['article_id']))
{
?>
<h1>
Логинимся через соцсети!
</h1>
<div class="close_window">x</div>
<?php
}
?>


