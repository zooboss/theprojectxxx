<?php
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/dbconfig.php"); 
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/functions.php");
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/comments/comments.php");
require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/models/profile/profile_functions.php");

ob_start();

$personal_request_type = $_POST['personal_request_type'];
$author = $_POST['username'];

switch ($personal_request_type): 
    case "my_comments" :
    
    $my_comments = get_my_comments($author);

    ?>

    <div class = "  personal-output "
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
                    <tr class = "clickable-row" data-href = "<?php echo '/theprojectxxx/index.php?send=article&id=' . $comment['article_id'] ?>">
                        <td><?php echo $comment['content'] ?> </td>
                        <td><?php echo $comment['date'] . " " . $comment['time'] ?> </td>
                        <td><?php echo get_article_by_id($comment['article_id'])[0]['title'] ?> </td>
                        <td><?php echo "Рейтинг" ?> </td>

                    </tr>
                <?php
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php 
    break;

    case "my_replies":

        $my_replies = get_my_replies($author);
         
        ?>
        
         <div class = "  personal-output "
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
                    foreach ($my_replies as $reply) {
                        ?>
                        <tr class = "clickable-row" data-href = '<?php echo '/theprojectxxx/index.php?send=article&id=' . $reply[0]['article_id'] . "#" . $reply[0]['id']?>'>
                            
                            <td><?php echo $reply[0]['content'] ?> </td>
                            <td><?php echo $reply[0]['date'] . " " . $reply[0]['time'] ?> </td>
                            <td><?php echo get_article_by_id($reply[0]['article_id'])[0]['title'] ?> </td>
                            <td><?php echo "Рейтинг" ?> </td>

                        </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    <?php
    break;

    case "articles_not_visited":
        $articles_visited = get_articles_visited();
        
        ?>
        <div class = "  personal-output "
              id = "personal-data"
              username = "<?php echo $author ?>"
         >
            <?php 
            $articles_visited = get_articles_visited();
            $articles_not_visited = get_not_visited_articles($articles_visited);
            if ( empty($articles_not_visited) == true){
                echo "Непрочитанные статьи отсутствуют";
            }
            else{
                
                
                
                
            }
             
             
            ?>
            
        </div>
    <?php
    break;

endswitch;
?>

<?php


$req = ob_get_contents();
ob_end_clean();
echo json_encode($req); // вернем полученное в ответе
exit;






?>