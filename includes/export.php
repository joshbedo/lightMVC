<?php

//so if not connected to database it displays an error message instead of a php error recommend having on 1 in development mode - for warnings and error

ini_set( "display_errors", 0);

if(!$_POST) exit();
$db = mysql_connect('localhost', 'imstillr', '00002640'); // Connect to the database
		$link = mysql_select_db('imstillr_crm', $db); // Select the database name

			function parseCSVComments($comments) {
			  $comments = str_replace('"', '""', $comments); // First off escape all " and make them ""
			  if(eregi(",", $comments) or eregi("\n", $comments)) { // Check if I have any commas or new lines
				return '"'.$comments.'"'; // If I have new lines or commas escape them
			  } else {
				return $comments; // If no new lines or commas just return the value
			  }
			}

			$sql = mysql_query("SELECT * FROM customerinfo WHERE department = '" .$depart. "'"); // Start our query of the database
			$numberFields = mysql_num_fields($sql); // Find out how many fields we are fetching

			if($numberFields) { // Check if we need to output anything
				for($i=0; $i<$numberFields; $i++) {
					$head[] = mysql_field_name($sql, $i); // Create the headers for each column, this is the field name in the database
				}
				$headers = join(',', $head)."\n"; // Make our first row in the CSV
					$data = "";
				while($info = mysql_fetch_object($sql)) {
					foreach($head as $fieldName) { // Loop through the array of headers as we fetch the data
						$row[] = parseCSVComments($info->$fieldName);
					} // End loop
					$data .= join(',', $row)."\n"; // Create a new row of data and append it to the last row
					$row = ''; // Clear the contents of the $row variable to start a new row
				}
				// Start our output of the CSV
				//header("Content-type: application/x-msdownload");
				header("Content-Disposition: attachment; filename=" .$filename. ".csv");
				header("Content-type: application/octet-stream");
				header("Pragma: no-cache");
				header("Expires: 0");

				//echo $headers.$data;
				 echo "<fieldset>";			

		 echo "<div id='success_page'>";

		 //echo "<h1>User $primarycontact Successfully added onto '$department'.</h1>";

		 echo "<p>Thank you <strong>$primarycontact</strong>, your registration info has been submitted to us.</p>";

		 echo "</div>";

		 echo "</fieldset>";
			} else {
				// Nothing needed to be output. Put an error message here or something.
				echo 'No data available for this CSV.';
			}
		 		 



function protect($value) {

	if(get_magic_quotes_gpc()){

		return mysql_real_escape_string(stripslashes($value));

	}else{

		return mysql_real_escape_string(stripslashes($value));

	}

}

function checkvalue($var){

	return ($var === null || $var === '') ? 'NULL' : "'" .$var. "'";

}

function isEmail($email) { // Email address verification, do not edit.



return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

		

}

function isPhone($number) { // Email address verification, do not edit.



return(preg_match("/^([\(]{1}[0-9]{3}[\)]{1}[ ]{1}[0-9]{3}[\-]{1}[0-9]{4})$/",$number));

		

}

?>