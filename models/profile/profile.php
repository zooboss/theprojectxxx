<?php
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/profile/profile_functions.php");

ob_start();

$author = $_POST['username'];
$my_comments = get_my_comments($author);

?>

<div class = "offset-md-2 col-md-8 offset-sm-2 col-sm-8 col-xs-12 personal-output"
     id = "personal-data"
     username = "<?php echo $author ?>"
     >
<?php 
    foreach ($my_comments as $comment) {
        echo $comment['content'] . "<br>";
    }
?>
</div>


<?php


$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
exit;








?>