<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo __MAIN_DIR; ?>/css/style.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/resetpass.js"></script>

<title><?php echo $title; ?></title>
</head>



<body>

<div id="main">

	<div id="message"></div>

	<form id="resetpassword" enctype="multipart/form-data" method="post" action="<?php echo __MAIN_DIR; ?>/forgotpass/checkreset/">


		<h2>Reset Password</h2>

		<label>Password</label>

		<input id="password" type="password" name="password" size="20"/>

		<br>
		<label>Re-enter Password</label>

		<input id="passwordsecond" type="password" name="passwordsecond" size="20"/>

		<br>

		<input class="button" type="submit" id="submit" value="Reset Password"/>


	</form>

</div>

</body>

</html>