<?php 

if($is_admin)
{

	if($is_edit)
	{
	
		echo '<div class="msg">Message is edited.<br/>You will redirect to the main page after 2 seconds.</div>';
	
	}
	else
	{
	
	?>

		<div class="msg">Message id: <?php echo $id_to_edit; ?></div>
		<form action="?id=<?php echo $id_to_edit; ?>" method="POST">
		<textarea name="location" cols="61" rows="1" maxlength="64" placeholder="Location of Visit (required)"><?php echo $location; ?></textarea>
		<textarea name="name" cols="61" rows="1" maxlength="64" placeholder="Your Name (required)"><?php echo $name; ?></textarea>
		<textarea name="phone" cols="61" rows="1" maxlength="20" placeholder="Your Phone Number"><?php echo $phone; ?></textarea>
		<textarea name="email" cols="61" rows="1" maxlength="80" placeholder="Your Email Address"><?php echo $email; ?></textarea>
		<textarea name="message" cols="61" rows="4" maxlength="450" placeholder="Type your message here"><?php echo $message; ?></textarea>
		<input type = "submit" name = "ok" value = "Save"/>
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