<?php

session_start();

Class forgotpassController Extends baseController {
	

public function index() 

{

        $this->registry->template->title = 'Ainsworthstudio - Password Recovery';

		$this->registry->model->createModel('db', 'db');

		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);


        $this->registry->template->show('forgotpass_index');

}
public function checkemail()
{
$this->registry->model->createModel('db', 'db');
$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);

if(empty($_POST['email'])){
     echo '<div class="error_message">Attention! please enter your email</div>';
}else{
     $email = $_POST['email'];
     $sql = mysql_query("SELECT id,email FROM users WHERE email= '" .$email. "'");
     $row = mysql_fetch_array($sql);
     
     if(mysql_affected_rows() != 0){					 	 $id = $row['id'];
     $email = $row['email'];					 	 $sql = mysql_query("SELECT userid, token, date FROM tokens WHERE userid = '".$id."' AND date = CURDATE()");	 $row = mysql_fetch_array($sql);	 if(mysql_affected_rows() != 0){		echo '<div class="error_message">Attention! email has already been sent</div>';	}else{		/*token not found - generate new one and send an email*/		$this->registry->model->createModel('login', 'login');		$token = $this->registry->model->getModel('login')->gen_token();				$e_subject = 'Somebody has attempted to reset your password';		$e_body = "Somebody has tried to reset your password \r\n\n";		$e_confirm = "Please follow this link to confirm your password reset \r\n\n";		$e_link = "http://imstillreallybored.com/customer/forgotpass/resetpassword?token=".$token."&uid=".$id." \r\n\n";				$e_end = "If this was not you please disregard this email";					$msg = $e_body . $e_confirm . $e_link . $e_end;		if(mail($email, $e_subject, $msg, "From: ".__admin_email."\r\nReply-To: ".__admin_email."\r\nReturn-Path: ".__admin_email."\r\n")) {			$insert = mysql_query("INSERT INTO tokens (id, token, userid, date) VALUES(null, '".$token."', '".$id."', CURDATE())");				echo "<fieldset>";			echo "<div id='success_page'>";			echo "<p>You have been sent a confirmation email to reset your password.</p>";			echo "</div>";			echo "</fieldset>";		}			}		
        //echo '<br />' .$token;
     }else{
        echo '<div class="error_message">Attention! could not find user</div>';
		exit();
     }
} 
}
public function resetpassword(){	
if(empty($_GET['token']) || empty($_GET['uid'])){
		exit();	
	}else{		
			$token = $_GET['token'];		$userid = $_GET['uid'];				$this->registry->model->createModel('db', 'db');		
			$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);				
			$sql = mysql_query("SELECT token,userid,date FROM tokens WHERE token = '".$token."' AND userid = '".$userid."' AND date = CURDATE()");		
			$row = mysql_fetch_array($sql);				
		if(mysql_affected_rows() != 0){			
			$this->registry->template->title = 'Ainsworthstudio - Reset Password';			
			$this->registry->template->show('forgotpass_resetpass');
			
			$_SESSION['uid'] = $userid;
			$_SESSION['token'] = $token;		
		}else{			
			echo 'token expired';		
		}	
	}
}
public function checkreset(){
	if(empty($_GET['uid']) || empty($_GET['token']))
	{
		if(empty($_POST['password'])){
			 echo '<div class="error_message">Attention! please fill in a new password.</div>';
			 exit();
		}else if(empty($_POST['passwordsecond'])){
			 echo '<div class="error_message">Attention! please retype your password.</div>';
			 exit();
		}else if($_POST['password'] != $_POST['passwordsecond']){
			 echo '<div class="error_message">Attention! please make sure the passwords match.</div>';
			 exit();
		}
		$this->registry->model->createModel('db', 'db');
		$this->registry->model->getModel('db')->addConnection(__db_host, __db_uname, __db_upass, __db_name);
		
		$password = mysql_real_escape_string($_POST['password']);
		$id =  $_SESSION['uid'];
		$token = $_SESSION['token'];
		
		$password = md5($password);
		
		if($sql = mysql_query("UPDATE users SET password = '".$password."' WHERE id = '".$id."'")){
			$sql = mysql_query("DELETE FROM tokens WHERE token = '".$token."'");
			echo '<div class="success_message">password changed successfully <a href="'.__MAIN_DIR.'/login" title="Log in">Log in</a></div>';
			$_SESSION = array();
			session_destroy();
		}

	}else{
		exit();
	}}
}



?>