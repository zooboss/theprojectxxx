<?php
if (isset($_GET['send'])) {
    $send = $_GET['send'];
    switch ($send) {
        case 'profile':
            if ($user_login->is_logged_in()!=""  and $row['userID']==$_GET['userID'])
			{
			echo "Мой профиль на RTB";
			} 
			elseif (($user_login->is_logged_in()!=""  and $row['userID']!==$_GET['userID']))
			{
				echo "Профиль пользователя ".$row['PublicUserName'];	
				}  			
            break;
        case "article":
            $article = articles_get($_GET['id']);
            echo $article['title'];	
            break;
        case "registration" :
          echo "Регистрация";
            break;
        case "forgot_pass":
          echo "Восстановление пароля";
            break;                       
    }
        
}
else {
    echo "Главная РТБ";
}
?>