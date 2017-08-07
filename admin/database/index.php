<?php
if (defined("Users_check"))
{
$crud = new Editing_db();

?>


<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Добавить запись</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>id</th>
     <th>Логин</th>
     <th>Публичный логин</th>
     <th>Регистрация </th>
     <th>Последний раз онлайн</th>
     <th colspan="2" align="center">Действия</th>
     </tr>
     <?php
		$query = "SELECT * FROM users";       
		$records_per_page=5;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php 
}
else
{
	exit('Доступ закрыт');
}	?>