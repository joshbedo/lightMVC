<?php
session_start();

Class customersController Extends baseController {
	public $file;
	public $department;
	
public function index() 
{
        $this->registry->template->title = 'Ainsworthstudio - Register User';
		
		$this->registry->model->createModel('db', 'db');
		$this->registry->model->createModel('customers', 'customers');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		
		$data = $this->registry->model->getModel('customers')->getDepartments();
				
		while(list($k, $v)=each($data))
		$$k = $v;

		$this->registry->template->departments = $data;
        $this->registry->template->show('customers_index');
}

public function export(){
	if(isset($_SESSION['username'])){
		$this->registry->template->title = 'Ainsworthstudio - Export Customer Info';

		$this->registry->model->createModel('db', 'db');
		$this->registry->model->createModel('customers', 'customers');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		$data = $this->registry->model->getModel('customers')->getDepartments();

		while(list($k, $v)=each($data))
				$$k = $v;
				
		$this->registry->template->departments = $data;
		$this->registry->template->show('customers_export');
	}else{
				header('location:'.__MAIN_DIR.'/login');	
	}
}
public function exportcheck(){
if(!empty($_POST['filename'])){
		ob_start();
		$this->registry->model->createModel('db', 'db');
		$this->registry->model->createModel('customers', 'customers');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		
		$_SESSION['filename'] =  $_POST['filename'];
		$_SESSION['department'] =  $_POST['depart'];
		

		echo "<div class='success_message'>Exported Successfully</div>";
		
		}else{
			echo "<div class='error_message'>Attention! enter a filename</div>";
			exit();
		}
}
public function exportdata(){

$department = $_SESSION['department'];
$filename = $_SESSION['filename'];

$db = mysql_connect(__db_host, __db_uname, __db_upass); // Connect to the database
		$link = mysql_select_db(__db_name, $db); // Select the database name

	function parseCSVComments($comments) {
	  $comments = str_replace('"', '""', $comments); // First off escape all " and make them ""
	  if(eregi(",", $comments) or eregi("\n", $comments)) { // Check if I have any commas or new lines
		return '"'.$comments.'"'; // If I have new lines or commas escape them
	  } else {
		return $comments; // If no new lines or commas just return the value
	  }
	}

	$sql = mysql_query("SELECT * FROM customerinfo  WHERE department = '".$department."'"); // Start our query of the database
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
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=".$filename.".csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $headers.$data;
	} else {
		// Nothing needed to be output. Put an error message here or something.
		echo 'No data available for this CSV.';
	}
}
public function viewall(){
if(isset($_SESSION['username'])){
	/*** should not have to call this here.... FIX ME ***/
		$this->registry->template->title = 'Ainsworthstudio - View All Customers';
		
		$this->registry->model->createModel('db', 'db');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		
		$data = $this->registry->model->getModel('db')->getData();
				
		while(list($k, $v)=each($data))		
		$$k = $v;

		$this->registry->template->customers = $data;
        $this->registry->template->show('customers_view');			}else{		header('location:'.__MAIN_DIR.'/login');			}
}
public function validate(){


	 

			$con = mysql_connect(__db_host,__db_uname,__db_upass);

			mysql_select_db(__db_name, $con);	

			



			$company = protect($_POST['company']); //required

			$primarycontact = protect($_POST['primarycontact']); //required

			$primaryemail   = protect($_POST['primaryemail']); //required

			$preferphone = protect($_POST['preferphone']); //required

			$secondarycontact = protect($_POST['secondarycontact']);

			$secondaryemail = protect($_POST['secondaryemail']);

			$optionalphone = protect($_POST['optionalphone']);

			$department = protect($_POST['department']);

			$website = protect($_POST['website']); //required

			

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

			if(trim($secondarycontact) == ''){ $secondarycontact = 'NULL';}

			if(trim($secondaryemail) == ''){ $secondaryemail = 'NULL';}

			if(trim($optionalphone) == ''){ $optionalphone = 'NULL';}

			

			if($error == '') {

			

				
			//admin address here
			 $address = __admin_email;

			 $clientaddress = $primaryemail;



			//admin subject

			 $e_subject = $primarycontact .' has successfully been registered in the database';

			 

			 //client subject

			 $c_subject = 'You have successfully been registered in the database';



			/* another way of doing admin/client email as array

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

		

			 mysql_query("INSERT INTO `imstillr_crm`.`customerinfo` (`id`, `companyname`, `primarycontact`, `primaryemail`, `prefphone`, `secondarycontact`, `secondaryemail`, `optionalphone`, `department`, `website`) VALUES (NULL, '".protect($company)."', '".protect($primarycontact)."', '".protect($primaryemail)."', '".protect($preferphone)."', '".protect($secondarycontact)."', '".protect($secondaryemail)."', '".protect($optionalphone)."', '".protect($department)."', '".protect($website)."')");

			 if(mail($address, $e_subject, $msg, "From: $primaryemail\r\nReply-To: $primaryemail\r\nReturn-Path: $primaryemail\r\n")) {



			//if mail was sent to admin then send to person who signed up

			mail($primaryemail, $c_subject, $cmsg, "From: $address\r\nReply-To: $address\r\nReturn-Path: $address\r\n");

			 // Email has sent successfully, echo a success page.

			

			

			 echo "<fieldset>";			

			 echo "<div id='success_page'>";

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

			return mysql_real_escape_string($value);

		}

	}

	function isEmail($email) { // Email address verification, do not edit.



	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));

			

	}

	function isPhone($number) { // Email address verification, do not edit.



	return(preg_match("/^([\(]{1}[0-9]{3}[\)]{1}[ ]{1}[0-9]{3}[\-]{1}[0-9]{4})$/",$number));

			

	}


}
public function delete(){
	if(isset($_GET['id']))
{

			$id=$_GET['id'];

									$server	   = __db_host;
									$username  = __db_uname;
									$password  = __db_upass;
									$database  = __db_name;

									$conn = mysql_connect($server, $username, $password);
									if(!$conn)
									{ 	
										exit('Error: could not establish database connection');
									}
									if(!mysql_select_db($database))
									{ 	
										exit('Error: could not select the database');
									}
			
			$result = mysql_query("SELECT id FROM customerinfo WHERE id = '$id'");
			$r = mysql_fetch_array($result);
			$count=mysql_num_rows($result);
			if($count==1){
					mysql_query("DELETE FROM customerinfo WHERE id = '$id'");
					
					mysql_close($conn);			
					echo 'Deleted <b>'.$id.'</b> Successfully';
			}else{
				echo 'Record does not exist';
			}
}
}
}

?>