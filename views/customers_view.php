<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo __MAIN_DIR; ?>/css/style.css" type="text/css" rel="stylesheet" /><link href="<?php echo __MAIN_DIR; ?>/css/jtps.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script><script type="text/javascript" src="<?php echo __MAIN_DIR; ?>/js/jtps.js"></script>
<title><?php echo $title; ?></title>
</script><script type="text/javascript">
		$(function () { 
			$('#customers').jTPS( {perPages:[5, 6, 10, 20, 50, 'ALL']} );
		});
</script>
</head>

<body>
<?php $this->registry->template->show('header'); ?>
<div id="main" class="customerview">
	<table id="customers">	<thead>
	<tr>
	  <th sort="company">Company Name</th>
	  <th sort="primarycontact">Primary</th>
	  <th sort="primaryemail">Primary Email</th>
      <th sort="preferredphone">Preferred Phone</th>
      <th sort="secondarycontact">Secondary</th>
      <th sort="secondaryemail">Secondary Email</th>
      <th sort="optionalphone">Optional Phone</th>
      <th sort="department">Dept.</th>
      <th sort="website">Website</th>
	  <th>&nbsp;</th>
	</tr>	</thead>	<tbody>
	<?php
	//loop out datasets
	foreach($customers as $k => $v){
	?>
		<tr id="<?php echo $customers[$k]['id']; ?>">
		<td><?php echo $customers[$k]['companyname']; ?></td>
		<td><?php echo $customers[$k]['primarycontact']; ?></td>
		<td><?php echo $customers[$k]['primaryemail']; ?></td>
		<td><?php echo $customers[$k]['prefphone']; ?></td>
		<td><?php echo $customers[$k]['secondarycontact']; ?></td>
                <td><?php echo $customers[$k]['secondaryemail']; ?></td>
                <td><?php echo $customers[$k]['optionalphone']; ?></td>
                <td><?php echo $customers[$k]['department']; ?></td>
                <td><?php echo $customers[$k]['website']; ?></td>
		<td><a class="delete" href="<?php echo __MAIN_DIR; ?>/customers/delete?id=<?php echo $customers[$k]['id']; ?>" title="delete me">Delete</a>
			<a class="edit" href="<?php echo __MAIN_DIR; ?>/customers/edit?id=<?php echo $customers[$k]['id']; ?>" title="edit me">Edit</a>
		</td>
		</tr>
		
	<?php
	}
	?>		
	</tbody>			
	<tfoot class="nav">
	<tr>					
	<td colspan="10">
	<div class="pagination"></div>		
	<div class="paginationTitle">Page</div>
	<div class="selectPerPage"></div>		
	<div class="status"></div>
	</td>			
	</tr>		
	</tfoot>
	</table>

</div>
</body>
</html>