<?php
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/profile/profile_functions.php");

ob_start();

$author = $_POST['username'];
$my_comments = get_my_comments($author);

?>

<div class = " table-responsive personal-output "
     id = "personal-data"
     username = "<?php echo $author ?>"
     >
    <table class = "table table-striped table-hover">
        <thead>
            <tr>
                <th>Комментарий</th>
                <th>Дата</th>
                <th>Статья</th>
                <th>Рейтинг</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach ($my_comments as $comment) {
                ?>
                <tr>
                    <td><?php echo $comment['content'] ?> </td>
                    <td><?php echo $comment['date'] . " " . $comment['time'] ?> </td>
                    <td><?php echo $comment['id'] ?> </td>
                    <td><?php echo "Рейтинг" ?> </td>
                
                </tr>
            <?php
            }
        ?>
        </tbody>
    </table>
</div>


<?php


$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
exit;








?>