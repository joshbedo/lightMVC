<?php

class db{

/*** Declare instance ***/
private static $instance = NULL;

/**
*
* the constructor is set to private so
* so nobody can create a new instance using new
*
*/
public function __construct() {
  /*** maybe set the db name here later ***/
}

/**
*
* Return DB instance or create intitial connection
*
* @return object (PDO)
*
* @access public
*
*/
public static function getInstance() {

if (!self::$instance)
    {
    self::$instance = new PDO("mysql:host=localhost;dbname=imstillr_crm", 'imstillr', '00002640');
    self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
return self::$instance;
}
public function addConnection($host, $user, $pass, $db){
	/*$dbh = new PDO("mysql:host=localhost;dbname=imstillr_crm", 'imstillr', '00002640');
	foreach($dbh->query('SELECT * from customerinfo') as $row) {
        return $row;
    }*/
		$server	   = $host;
		$username  = $user;
		$password  = $pass;
		$database  = $db;

		$conn = mysql_connect($server, $username, $password);
		if(!$conn)
		{ 	
			exit('Error: could not establish database connection');
		}
		if(!mysql_select_db($database))
		{ 	
			exit('Error: could not select the database');
		}

}
public function getData(){
	$query = mysql_query("select * from customerinfo order by id");
	$data = array();
	while ($rows = mysql_fetch_array($query)){	

			if(is_array($rows))

			{

				foreach($rows as $key => $value)

					$$key = stripslashes($value);
					//create another array that has the id inside the id has all the information in an array 
					//$end = array('id' => $id, 'company' => $companyname, 'mysql rows' => mysql_affected_rows());
					$data[$id] = array('id' => $id, 'companyname' => $companyname, 'primarycontact' => $primarycontact, 'primaryemail' => $primaryemail, 'prefphone' => $prefphone, 'secondarycontact' => $secondarycontact, 'secondaryemail' => $secondaryemail, 'optionalphone' => $optionalphone, 'department' => $department, 'website' => $website);
					if(empty($data[$id]['secondarycontact'])){
						$data[$id]['secondarycontact'] = 'N/A';	
					}					
					if(empty($data[$id]['secondaryemail'])){
						$data[$id]['secondaryemail'] = 'N/A';
					}					
					if(empty($data[$id]['optionalphone'])){
						$data[$id]['optionalphone'] = 'N/A';					
					}												
					//$data[$id] = $primarycontact;
			}
	}
	return $data;
}
/**
*
* Like the constructor, we make __clone private
* so nobody can clone the instance
*
*/
private function __clone(){
}

} /*** end of class ***/

?>
