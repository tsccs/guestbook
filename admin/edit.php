<?php

$title = "Editing";

include '../config.php';
include '../db_config.php';
include '../admin/auth.php';

if($is_admin)
{
	$id_to_edit = trim($_GET['id']);
	if(isset($_POST['ok']))
	{			
		$loc_to_save = trim(htmlspecialchars($_POST['location']));
		$name_to_save = trim(htmlspecialchars($_POST['name']));
		$company_to_save = trim(htmlspecialchars($_POST['company']));
		$phone_to_save = trim(htmlspecialchars($_POST['phone']));
		$email_to_save = trim(htmlspecialchars($_POST['email']));
		$message_to_save = trim(htmlspecialchars($_POST['message']));
		$rows = $pdo->prepare('UPDATE book SET location=:location, name=:name, company=:company, phone=:phone, email=:email, msg=:message WHERE id=:id;');
		$rows->bindParam(':id',$id_to_edit);
		$rows->bindParam(':location',$loc_to_save);
		$rows->bindParam(':name',$name_to_save);
		$rows->bindParam(':company',$company_to_save);
		$rows->bindParam(':phone',$phone_to_save);
		$rows->bindParam(':email',$email_to_save);
		$rows->bindParam(':message',$message_to_save);
		$rows->execute();
		$is_edit = true;
		//$redirect = $_SERVER['SERVER_NAME'];
		$redirect = '..';
	}
	else
	{
		$rows = $pdo->prepare('SELECT * FROM book WHERE id=:id');
		$rows->bindParam(':id',$id_to_edit);
		$rows->execute();
		$row = $rows->fetch();
		$location = $row['location'];
		$name = $row['name'];
		$company = $row['company'];
		$phone = $row['phone'];
		$email = $row['email'];
		$message = $row['msg'];
		$is_edit = false;
	}
}

include '../tpl/header.tpl';
include '../tpl/edit.tpl';
include '../tpl/footer.tpl';

?>