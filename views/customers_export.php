<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo __MAIN_DIR; ?>/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/export.js"></script>
<title><?php echo $title; ?></title>
</head>

<body>
<?php if(isset($_SESSION['username'])) $this->registry->template->show('header'); ?>
<div id="main">
	<div id="message"></div>
	<form id="export" enctype="multipart/form-data" method="post" action="<?php echo __MAIN_DIR; ?>/customers/exportcheck/">
		<h2>Export Data</h2>
		<label>Filename</label>
		<input id="filename" type="text" name="filename" size="20"/>
		<br />
		<label>Department</label>
		<select id="department" name="department"> 
		<?php foreach($departments as $k => $v){
		?>
			<option><?php echo $departments[$k]['name']; ?></option>
		<?php
		}
		?>
		</select>
		<br />
		<input class="button" type="submit" id="submit" value="Export Data"/>

	</form>
</div>
</body>
</html>