<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo __MAIN_DIR; ?>/css/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/jquery.jigowatt.js"></script>
<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/dFilter.js"></script>
<title><?php echo $title; ?></title>
</head>

<body>
<?php if(isset($_SESSION['username'])) $this->registry->template->show('header'); ?>
<div id="main">
	<div id="message"></div>
	<h2>Register User</h2>
	<form id="createuser" enctype="multipart/form-data" method="post" action="<?php echo __MAIN_DIR; ?>/includes/validate.php">
		<label><span class="required">*</span>Company name</label>
		<input id="company" type="text" name="company" size="20">
		<br>
		<label><span class="required">*</span>Primary Contact Name</label>
		<input id="primarycontact" type="text" name="primarycontact" size="20">
		<br>
		<label><span class="required">*</span>Primary Email</label>
		<input id="primaryemail" type="text" name="primaryemail" size="20">
		<br>
		<label><span class="required">*</span>Preferred Phone</label>
		<input id="preferphone" onBlur="javascript:return checkPhone('#preferphone');" onKeyDown="javascript:return dFilter (event.keyCode, this, '(###) ###-####');" type="textbox" name="preferphone" value="" size="20">
		<br>
		<label>Secondary Contact Name</label>
		<input id="secondarycontact" type="text" name="secondarycontact" size="20">
		<br>
		<label>Secondary Email</label>
		<input id="secondaryemail" type="text" name="secondaryemail" size="20">
		<br>
		<label>Optional Phone</label>
		<input id="optionalphone" onBlur="javascript:return checkPhone('#optionalphone');" onKeyDown="javascript:return dFilter (event.keyCode, this, '(###) ###-####');" type="textbox" name="optionalphone" size="20">
		<br>
		<label>Department</label>
		<select id="department" name="department"> 
		<?php foreach($departments as $k => $v){
		?>
			<option id="<?php echo $departments[$k]['id']; ?>"><?php echo $departments[$k]['name']; ?></td>
		<?php
		}
		?>
		</select>
		<br>
		<label><span class="required">*</span>Website</label>
		<input id="website" type="textbox" name="website" size="20">
		<br>
		<input type="submit" id="submit" value="Create User">
	</form>
</div>
</body>
</html>
