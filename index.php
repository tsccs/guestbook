<?php

$title = "Guest Book";

include 'config.php';
include 'db_config.php';
include 'admin/auth.php';

//Init variable
$errors = '';
$loc_after_refresh = isset($_POST['location']) ? $_POST['location'] : '';
$name_after_refresh = isset($_POST['name']) ? $_POST['name'] : '';
$comapny_after_refresh = isset($_POST['company']) ? $_POST['company'] : '';
$phone_after_refresh = isset($_POST['phone']) ? $_POST['phone'] : '';
$email_after_refresh = isset($_POST['email']) ? $_POST['email'] : '';
$msg_after_refresh = isset($_POST['message']) ? $_POST['message'] : '';
$show_new_add = false;
$posts = 0;
$isadd = (isset($_POST['add']))? true : false;
////

//After click on "Add"
if($isadd)
{
    if(empty(trim($_POST['location'])))
    {
		$errors = "Enter location!";
    }
    elseif(empty(trim($_POST['name'])))
    {
    		$errors = "Enter name!";
    }
    else
    {
		if($_SESSION['captcha'] == $_POST['captcha'])
		{
			//Prepare input data
			$loc_to_save = trim(htmlspecialchars($_POST['location']));
			$name_to_save = trim(htmlspecialchars($_POST['name']));
			$company_to_save = trim(htmlspecialchars($_POST['company']));
			$phone_to_save = trim(htmlspecialchars($_POST['phone']));
			$email_to_save = trim(htmlspecialchars($_POST['email']));
			$msg_to_save = trim(htmlspecialchars($_POST['message']));
			
			if($is_admin)
			{
				$user_to_save = "Admin";
			}
			else
			{
				$user_to_save = "Guest";
			}
			////
			
			//Smiles
			$msg_to_save = str_replace(':)','<img src="img/smile.png" width="20" height="20"/>',$msg_to_save);
			$msg_to_save = str_replace(':-)','<img src="img/smile.png" width="20" height="20"/>',$msg_to_save);
			////
			
			//Save message
			$STH = $pdo->prepare("INSERT INTO book (location,name,company,phone,email,msg,date,user) VALUES (:location,:name,:company,:phone,:email,:msg,now(),:user);");
			$STH->bindParam(':location',$loc_to_save);
			$STH->bindParam(':name',$name_to_save);
			$STH->bindParam(':company',$company_to_save);
			$STH->bindParam(':phone',$phone_to_save);
			$STH->bindParam(':email',$email_to_save);
			$STH->bindParam(':msg',$msg_to_save);
			$STH->bindParam(':user',$user_to_save);
			$STH->execute();
			//////////
			if(!$keeplocation) $loc_after_refresh = '';
			$name_after_refresh = '';
			$company_after_refresh = '';
			$phone_after_refresh = '';
			$email_after_refresh = '';
			$msg_after_refresh = '';
			//Show the newly added entry, even if history is disabled in the config.
			if($adminrequired && $guestnonadminmax < 1) $guestnonadminmax = 1;
		}
		else
		{
			$errors = "Wrong captcha code!";
		}
    }
}
////

//After click on "Refresh"
if(isset($_POST['refresh']))
{
    $loc_after_refresh = $_POST['location'];
    $name_after_refresh = $_POST['name'];
    $company_after_refresh = $_POST['company'];
    $phone_after_refresh = $_POST['phone'];
    $email_after_refresh = $_POST['email'];
    $msg_after_refresh = $_POST['message'];
}
////


// Count posts, calc  amount pages
$pg = $pdo->query('SELECT COUNT(id) AS total FROM book;');
$posts = $pg->fetch()['total'];
if($posts < $guestnonadminmax) $guestnonadminmax = $posts;
if(!$adminrequired || $is_admin) $pages = intval(($posts-1)/$perpagemax)+1; 
// Override if limited in config.
if($adminrequired && $guestnonadminmax > 0 && !$is_admin)
{
  $pages = intval(($guestnonadminmax-1)/$perpagemax)+1; 
  if($guestnonadminmax < $perpagemax) $perpagemax = $guestnonadminmax;
}


////

//Receive messages from DB
if(isset($_GET['p']))
{
	$page = $_GET['p'];
	if($page < 1 || $page > $pages)
	{
		$page = 1;
	}
}
else
{
	$page = 1;
}

$page_at = $page * $perpagemax - $perpagemax;

$rows = $pdo->prepare('SELECT * FROM book ORDER BY id DESC LIMIT :pageat,'.$perpagemax.' ;');
$rows->bindParam(':pageat',$page_at,PDO::PARAM_INT);
$rows->execute();

$messages = $rows->fetchAll();
////

//Page navigation
if($page > 1)
{
	$prev = '<a href="?p='.($page-1).'">Prev.</a>';
}
else
{
	$prev = 'Prev.';
}

if($page < $pages)
{
	$post = '<a href="?p='.($page+1).'">Next.</a>';
}
else
{
	$post = 'Post.';
}

$navi_links = $prev.'|'.$post.' (Page:'.$page.'/'.$pages.')';
////

//Generate catcha
$_SESSION['captcha'] = rand(1000,9999);
$captcha = $_SESSION['captcha'];
////

include 'tpl/header.tpl';
include 'tpl/index.tpl';
include 'tpl/footer.tpl';
?>
