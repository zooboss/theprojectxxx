<?php 
session_start ();

if (!isset($_SESSION['adminSession']) or !isset($_COOKIE['admin_session']))
{
header('Location: https://navalny.com/');	
exit ("Пошел на хуй");	 
}// если нет админской сессии или админского кукиса
else //если есть админская сессия и админский кукис
{	
if (empty($_POST['ID'])) //если нет POST запроса
{
header('Location: https://navalny.com/');	
exit ("Пошел на хуй");
} // конец если нет POST запроса
  else // если есть POST запрос
    {
      $check_session = '-+*M,./(31M'.$_SESSION['adminSession'].'GhUy891246/*- '.'  ';
      $check_session = hash("sha256", $check_session );
      if ($_POST['ID'] === $check_session and ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') and (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) ) // если есть запрос Ajax и если ID пост запроса соответствует 
      {
       require_once ( $_SERVER['DOCUMENT_ROOT'] . "/theprojectxxx/admin/admin_functions.php");	
	   $send = $_POST['Data'];
		define("Admin", true);
		
		switch ($send) {
        case 'New_article':
            include ("editor/index.php");
            setcookie('edit', rand(10, 15), time()+10, '/');		//куки для отвлечения внимания	
            break;                
    }
 		
 } // конец есть запрос Ajax и если ID пост запроса соответствует 
 else 
{
 exit ("Пошел на хуй");	
}


    

}     //конец  если есть POST запрос
 
	
}	 // конец если есть админская сессия и админский кукис


//https://ruseller.com/lessons.php?rub=37&id=301
?>