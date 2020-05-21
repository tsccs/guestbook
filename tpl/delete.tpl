<?php 

if($is_admin)
{

	if($is_delete)
	{
	
		echo '<div class="msg">Message is deleted.<br/>You will redirect to the main page after 2 seconds.</div>';
	
	}
	else
	{
	
	?>

		<div class="msg" id="msgbox"><b>Do you really want to delete entry:</b><br/>
		<br/>Date-Time: <?php echo $datetime; ?>
		<br/>Location: <?php echo $location; ?>
		<br/>Name: <?php echo $name; ?>
		<br/>Phone: <?php echo $phone; ?>
		<br/>Email: <?php echo $email; ?>
		<br/>Message text: <?php echo $message; ?>
		<br/>Answer text: <?php echo $answer; ?></div>
		<form action="?id=<?php echo $id_to_delete; ?>" method="POST">
		<input type = "submit" name = "ok" value = "Yes"/>
		</form>
		
	<?php
	}
}
else
{
?>
<div class="msg">Access denied!</div>
<?php
}
?>
<div class = "msg"><a href = "../">Home</div>