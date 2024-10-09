<?php
if($errors != '') echo '<div class="error">'.$errors.'</div>';
if(isset($_GET['loc'])) $location = $_GET['loc'];
if(!isset($location)) {if(isset($_GET['location'])) {$location = $_GET['location'];}}
if(isset($location)) $loc_after_refresh = $location
?>

<form action="?p=<?php echo $page;?>" method="POST">
	<?php
	if (empty($locationlist)) {
        echo '<textarea name="location" cols="61" rows="1" maxlength="64" placeholder="Location of Visit (required)" ' . ($loc_after_refresh == '' ? 'autofocus' : '') . ' required>' . htmlspecialchars($loc_after_refresh) . '</textarea>';
    } else {
        $locations = preg_split("/[;,]/", $locationlist); // Split by comma or semicolon
        echo 'Select Location: <select name="location" required>';
        foreach ($locations as $location) {
            $selected = ($location == $loc_after_refresh) ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($location) . '" ' . $selected . '>' . htmlspecialchars($location) . '</option>';
        }
        echo '</select> (required)';
    }
    ?>
	<br/>
	<textarea name="name" cols="61" rows="1" maxlength="64" placeholder="Your Name (required)" <?php if($name_after_refresh == '') echo 'autofocus'; ?> required><?php echo $name_after_refresh; ?></textarea>
	<br/>
	<textarea name="company" cols="61" rows="1" maxlength="64" placeholder="Your Company" <?php if($company_after_refresh == '') echo 'autofocus'; ?>><?php echo $company_after_refresh; ?></textarea>
	<br/>
	<textarea name="phone" cols="61" rows="1" maxlength="20" placeholder="Your Phone Number" <?php if($phone_after_refresh == '') echo 'autofocus'; ?>><?php echo $phone_after_refresh; ?></textarea>
	<br/>
	<textarea name="email" cols="61" rows="1" maxlength="80" placeholder="Your Email Address" <?php if($email_after_refresh == '') echo 'autofocus'; ?>><?php echo $email_after_refresh; ?></textarea>
	<br/>
	<textarea name="message" cols="61" rows="4" maxlength="450" placeholder="Additional info or accompanying guests" <?php if($msg_after_refresh == '') echo 'autofocus'; ?>><?php echo $msg_after_refresh; ?></textarea>
	<br/>
	Code: <?php echo $captcha; ?> <input type="number" name="captcha" placeholder="Enter digits (required)" autofocus required />
	<button name="add">Add</button>
	<button name="refresh">Refresh</button>
	
</form>

<?php
if($is_admin || !$adminrequired || $guestnonadminmax > 0)
{
foreach ($messages as $row)
{
    echo '<div class="msg"><span class="alignleft"><img src="img/'.strtolower($row['user']).'.png" width="15" height="12" alt="'.strtolower($row['user']).'," title="Created by '.$row['user'].'" /><b>'.$row['location'].', '.$row['name'].'</b>,</span>';
    echo '<span class="alignright">'.$row['date'].' ID: <b>'.$row['id'].'</b>';
	if($is_admin)
	{
		echo '<a href="admin/edit.php?id='.$row['id'].'" title="Edit"><img src="img/edit.png" width="12" height="12" alt="," style="margin: 0px 2px"/></a>';
		if($is_admin) echo '<a href="admin/answer.php?id='.$row['id'].'" title="Answer/Reply"><img src="img/answer.png" alt="" width="12" height="12" style="margin: 0px 2px" /></a>';
		echo '<a href="admin/delete.php?id='.$row['id'].'" title="Delete"><img src="img/delete.png" width="12" height="12" alt="" style="margin: 0px 2px"/></a>';
	}
	echo '</span>';
	if($row['company'] != '')
	{	
		echo '<br/><span class="alignleft"><b>Company</b>: '.$row['company'].'</span>';
	}
	if($row['phone'] != '' || $row['email'] != '')
	{	
		echo '<br/><span class="alignleft"><b>Email</b>: '.$row['email'].'</span><span class="alignright">>&nbsp;<b>Phone</b>: '.$row['phone'].'&nbsp;</span>';
	}
	if($row['msg'] != '') echo '<br/><b>Message</b>: '.$row['msg'];
	if($row['answer'] != '') echo '<br/><b>Answer</b>: '.$row['answer'];
	echo '</div>'.PHP_EOL;

}
}
if($posts == 0)
{
	echo '<div class="msg">No messages, be the first!</div>';
}
elseif(!$is_admin && $adminrequired && $guestnonadminmax == 0)
{
	echo '<div class="msg">Guest list limited to Admin user only.</div>';
}

?>
<?php
	echo '<div class="msg">'.PHP_EOL.'<span class="alignleftfoot">&nbsp;';
if($is_admin) 
{
	echo '<a href="logout.php">Logout</a>';
}
else
{
	echo '<a href="login.php">Sign in</a>';
}
	echo '</span><span class="aligncenterfoot">Posts:'.$posts.'</span><span class="alignrightfoot">'.$navi_links.'&nbsp;</span></div>'.PHP_EOL; /* Links of navi */
?>
