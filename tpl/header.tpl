<!DOCTYPE html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=yes" />
		<title><?php if($companyname != '') echo $companyname.' - '; echo $title; ?></title>
		<?php echo '<link rel="stylesheet" href="';
			if($guestbooksubfolder != '') echo '/'.$guestbooksubfolder.'/';
			echo 'tpl/style.css" type="text/css" />'.PHP_EOL; ?>
		<?php if($redirect != '') echo '<meta http-equiv="refresh" content="2; URL=\''.$redirect.'\'" />'.PHP_EOL; ?>
	</head>
	<body>
        <div class="all">
			<div class="head"><i><?php echo $title; ?></i></div>
			