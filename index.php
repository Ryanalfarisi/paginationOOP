<?php 
	require_once 'class/Pagination.php'
	$pagination =  new Pagination('users');
	$users = $pagination->get_data();
	$pages	= $pagination->get_pagination_numbers();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Pagination PDO Class</title>
	<style type="text/css">
		.active{
			background: rgb(23, 169, 201);
			color: white;
		}
	</style>
</head>
<body>	
	<ul>
		<? foreach ($users as $user): ?>
			<li><? echo $user->username. ':' .$user->email;?> </li>
		<? endforeach; ?>
	</ul>
	<hr>
	<a href="?page=<? echo $pagination->prev_page()?>"> << </a>
		<? for($=i; $i<=$pages; $i++): ?>
			<a class="<? echo $pagination->is_active_class($i) ?>" href="?page=<? echo $i;?>"><? echo $i;</a>
		<? endfor; ?>
	<a href="?page=<? echo $pagination->next_page()?>"> >> </a>
</body>
</html>