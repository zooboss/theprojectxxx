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
        $articles_not_visited = get_not_visited_articles($articles_visited);
        ?>
        <div class = "  personal-output "
              id = "personal-data"
              username = "<?php echo $author ?>"
         >
            <?php 
                                     
            if ( empty($articles_not_visited) == true ){
                ?>
                <div class = "text-center"><h2><?php echo "Непрочитанные статьи отсутствуют"; ?></h2></div>
            <?php
            }
            else{
            ?>
                <table class = "table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Автор</th>
                            <th>Дата</th>
                            <th>Превью</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($articles_not_visited as $article) {
                            ?>
                            <tr class = "clickable-row" data-href = '<?php echo '/theprojectxxx/index.php?send=article&id=' . $article[0]['id'] ?>'>

                                <td><?php echo $article[0]['title']  ?> </td>
                                <td><?php echo $article[0]['author']  ?> </td>
                                <td><?php echo $article[0]['date']   ?> </td>
                                <td><?php echo articles_intro($article[0]['content'])  ?> </td>

                            </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                </table>
                
                
            <?php
            }                          
            ?>
            
        </div>
    <?php
    break;

    case "personal_messages":

    ?>
        <div class = "  personal-output "
              id = "personal-data"
              username = "<?php echo $author ?>"
         >
            <div class = "text-center"><h2><?php echo "В разработке"; ?></h2></div>
        </div>
    <?php
    break;


    case "rating":
        ?>
        <div class = "  personal-output "
              id = "personal-data"
              username = "<?php echo $author ?>"
         >
            <div class = "text-center"><h2><?php echo "В разработке"; ?></h2></div>
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