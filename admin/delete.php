<?php

$title = "Removing";

include '../config.php';
include '../db_config.php';
include '../admin/auth.php';

if($is_admin)
{
	$id_to_delete = trim($_GET['id']);
	if(isset($_POST['ok']))
	{			
		$STH = $pdo->prepare("DELETE FROM book WHERE (id = :id) ;");
		$STH->bindParam(':id',$id_to_delete);
		$STH->execute();
		$is_delete = true;
		//$redirect = $_SERVER['SERVER_NAME'];
		$redirect = '..';
	}
	else
	{
		$rows = $pdo->prepare('SELECT * FROM book WHERE id=:id');
		$rows->bindParam(':id',$id_to_delete);
		$rows->execute();
		$row = $rows->fetch();
		$datetime = $row['date'];
		$location = $row['location'];
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$message = $row['msg'];
		$answer = $row['answer'];
		$is_delete = false;
	}
}

include '../tpl/header.tpl';
include '../tpl/delete.tpl';
include '../tpl/footer.tpl';

?>