<link href="<?php echo __MAIN_DIR; ?>/css/header/style.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/fixedmenu.js"></script>
<div id="nav">
<ul>

	<li><a href="<?php echo __MAIN_DIR; ?>/customers">Add Contact</a></li>
	<li><a href="<?php echo __MAIN_DIR; ?>/customers/viewall">View Contacts</a></li>
	<li><a href="<?php echo __MAIN_DIR; ?>/customers/export">Export Data</a></li>
<?php
if(isset($_SESSION['username'])){
?>
	<li><a href="<?php echo __MAIN_DIR; ?>/login/logout">Logout</a></li>
<?php
}else{
?>
         <li><a href="<?php echo __MAIN_DIR; ?>/login">Login</a></li>
<?php
}
?>
	<!--<li class="search">
		<input type="Text"/>
		<input class="searchbutton" type="submit" value=""/>
	</li>-->
</ul>
</div>