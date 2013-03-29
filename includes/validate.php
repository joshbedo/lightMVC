<?phpsession_start();
//so if not connected to database it displays an error message instead of a php error recommend having on 1 in development mode - for warnings and error
ini_set( "display_errors", 0);
if(!$_POST) exit;
 
		$con = mysql_connect("localhost","imstillr","00002640");
	    mysql_select_db("imstillr_crm", $con);	
		

		$company = protect($_POST['company']); //required
        $primarycontact = protect($_POST['primarycontact']); //required
        $primaryemail   = protect($_POST['primaryemail']); //required
		$preferphone = protect($_POST['preferphone']); //required
		$secondarycontact = protect($_POST['secondarycontact']);
		$secondaryemail = protect($_POST['secondaryemail']);
		$optionalphone = protect($_POST['optionalphone']);
		$department = protect($_POST['department']);
		$website = protect($_POST['website']); //required*/
		
		//database info
		
		mysql_query("SELECT companyname FROM customerinfo WHERE companyname='" .$company. "'");
		
		if (!$con)
		{
		    //checks if database connection string is correct
		    echo '<div class="error_message">Attention! no database connection.</div>';
		    exit();	
		} else if(mysql_affected_rows() == 1) {
			echo '<div class="error_message">Attention! This company already exists.</div>';		
			exit();	
		} else if(trim($company) == '') {
        	echo '<div class="error_message">Attention! You must enter your company name.</div>';
			exit();
		} else if(trim($primarycontact) == '') {
        	echo '<div class="error_message">Attention! You must enter a contact name.</div>';
			exit();
        } else if(trim($primaryemail) == '') {
        	echo '<div class="error_message">Attention! Please enter a valid email address.</div>';
			exit();
		} else if(!isEmail($primaryemail)) {
        	echo '<div class="error_message">Attention! You have to enter an invalid e-mail address, try again.</div>';
			exit();
		} else if(trim($department) == '') {
        	echo '<div class="error_message">Attention! Please enter a department.</div>';
			exit();
	    } else if(trim($preferphone) == '') {
        	echo '<div class="error_message">Attention! Please enter a preferred phone number.</div>';
			exit();
		} else if(!isPhone($preferphone)) {
        	echo '<div class="error_message">Attention! Please enter the right format for phone.</div>';
			exit();
		} else if(trim($website) == '') {
        	echo '<div class="error_message">Attention! Please enter a website name.</div>';
			exit();
		}

        if($error == '') {
        
			
         $address = "joshbedo@yahoo.com";
		 $clientaddress = $primaryemail;

		//admin subject
		 $e_subject = $primarycontact .' has successfully been registered in the database';
		 
		 //client subject
		 $c_subject = 'You have successfully been registered in the database';

		/* another way of doing admin client email as array
		$admin_email = array(	
				'e_body' => '$primarycontact has been registered in department '$department' \r\n\n',
				'e_content' => 'You have been contacted by $name with regards to $subject, their additional message is as follows.\r\n\n';
				'e_reply' => 'You can contact $primarycontact via email, $primaryemail';
		);*/
		
		//admin email
		 $e_body = "$primarycontact has been registered in department '$department' \r\n\n";
		 //$e_body = "You have been contacted by $name with regards to $subject, their additional message is as follows.\r\n\n";
		 $e_content = "Company Name: $company\n Primary Contact: $primarycontact\n Primary Email: $primaryemail\n Preferred Phone: $preferphone\n Secondary Contact: $secondarycontact\n Secondary Email: $secondaryemail\n Optional Phone: $optionalphone\n Department: $department\n Website: $website \r\n\n";
		//$e_content = "\"anything can be displayed here such as all the customers entered info\"\r\n\n";
		 $e_reply = "You can contact $primarycontact via email, $primaryemail ";
		 
		 //client email
		$c_body = "You has been registered in department '$department' \r\n\n";
		$c_content = "Company Name: $company\n Primary Contact: $primarycontact\n Primary Email: $primaryemail\n Preferred Phone: $preferphone\n Secondary Contact: $secondarycontact\n Secondary Email: $secondaryemail\n Optional Phone: $optionalphone\n Department: $department\n Website: $website \r\n\n";
		$c_reply = "For anymore information feel free to contact the administrator vis email, $address";
					
					
        //admin msg					
        $msg = $e_body . $e_content . $e_reply;
		//client msg
		$cmsg = $c_body . $c_content . $c_reply;
		
		 //inserts information
		 
		
		 mysql_query("INSERT INTO `imstillr_crm`.`customerinfo` (`id`, `companyname`, `primarycontact`, `primaryemail`, `prefphone`, `secondarycontact`, `secondaryemail`, `optionalphone`, `department`, `website`) VALUES (NULL, ".checkvalue($company).", ".checkvalue($primarycontact).", ".checkvalue($primaryemail).", ".checkvalue($preferphone).", ".checkvalue($secondarycontact).", ".checkvalue($secondaryemail).", ".checkvalue($optionalphone).", ".checkvalue($department).", ".checkvalue($website).")");
         if(mail($address, $e_subject, $msg, "From: $primaryemail\r\nReply-To: $primaryemail\r\nReturn-Path: $primaryemail\r\n")) {

		//if mail was sent to admin then send to person who signed up
		mail($primaryemail, $c_subject, $cmsg, "From: $address\r\nReply-To: $address\r\nReturn-Path: $address\r\n");
		 // Email has sent successfully, echo a success page.
		
		
		 echo "<fieldset>";			
		 echo "<div id='success_page'>";
		 //echo "<h1>User $primarycontact Successfully added onto '$department'.</h1>";
		 echo "<p>Thank you <strong>$primarycontact</strong>, your registration info has been submitted to us.</p>";
		 echo "</div>";
		 echo "</fieldset>";
		 		 
		} else {
		 
		 echo 'ERROR!';
		 
		}
                      
	}
//all functions go here

//protects database from SQL injection
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