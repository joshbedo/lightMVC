<?php
session_start();
Class loginController Extends baseController {
	
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
}public function check(){
		$this->registry->model->createModel('db', 'db');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		if(isset($_POST['username'])){

		$username = mysql_real_escape_string($_POST['username']);
		$password = mysql_real_escape_string($_POST['password']);

		$password = md5($password);				
                $sql = mysql_query("SELECT username FROM users WHERE username = '".$username."' AND password = '".$password."'");

		$row = mysql_fetch_array($sql);
		if(mysql_affected_rows() != 0){	

		$_SESSION['username'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];

		echo 'success';	
        	}else{
		echo '<div class="error_message">Wrong username and password</div>';		
}		}else{			

$_POST['username'] == '';			
echo 'Wrong username and password';
			exit();		}}
public function logout(){
        ob_start();
	session_destroy();
	$_POST['username'] = '';
	$_POST['password'] = '';
	echo 'Successfully logged out';
        header('Location:'.__MAIN_DIR.'/login');
	}
}
?>