<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo __MAIN_DIR; ?>/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/forgotpass.js"></script>
<title><?php echo $title; ?></title>
</head>

<body>
<div id="main">
	<div id="message"></div>
	<form id="forgotpass" enctype="multipart/form-data" method="post" action="<?php echo __MAIN_DIR; ?>/forgotpass/checkemail/">
		<?php
			if(isset($_SESSION['username']))
			{
				echo '<div class="message"><p>Your currently logged in as, <b>' .$_SESSION['username']. '</b>.</p><a href="logout">logout</a></div>';
			}
			else
			{
		?>
		<h2>Password Recovery</h2>
		<label>Email</label>
		<input id="email" type="text" name="email" size="20"/>
		<br>
		<input class="button" type="submit" id="submit" value="Recover Password"/>
		<?php
		}
		?>
	</form>
</div>
</body>
</html>