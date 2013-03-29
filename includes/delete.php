<?php
//delete.php?id=17
session_start();
if(isset($_GET['id']))
{

			$id=$_GET['id'];

			$server	   = 'localhost';
									$username  = 'imstillr';
									$password  = '00002640';
									$database  = 'imstillr_crm';

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

?>
