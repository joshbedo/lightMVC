<?php

class customers{

public $filename;
public $department;

public function __construct() {
  /*** maybe set the db name here later ***/
}
public function setExport($filename, $department){
	$this->filename = $filename;
	$this->department = $department;
}
public function getExport(){
	$export = array('filename' => $this->filename, 'department' => $this->department);
	return $export;
}
public function getDepartments(){
	$query = mysql_query("select * from groups order by id");
	$data = array();
	while ($rows = mysql_fetch_array($query)){	

			if(is_array($rows))

			{

				foreach($rows as $key => $value)

					$$key = stripslashes($value);
					//create another array that has the id inside the id has all the information in an array 
					//$end = array('id' => $id, 'company' => $companyname, 'mysql rows' => mysql_affected_rows());
					$data[$id] = array('id' => $id, 'name' => $name);
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
