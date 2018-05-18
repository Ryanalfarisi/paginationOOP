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
</head>
<body>	
	<ul>
		<? foreach ($users as $user): ?>
			<li><? echo $user->username. ':' .$user->email;?> </li>
		<? endforeach; ?>
	</ul>
	<hr>
	<? for($=i; $i<=$pages; $i++): ?>
		<a href="?page=<? echo $i;?>"><? echo $i;</a>
	<? endfor; ?>
</body>
</html>