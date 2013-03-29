<?php

class login{


public function __construct() {
 
}


public static function checklogin($username, $password) {

$password = md5($password);
$username =  $username. 'sssss';
return $user = array(
	'username' => $username,
	'password' => $password,
);
}
public function gen_token(){
// load up our valid character string

	$chars	=	'01234567890';

	$chars	.=	'abcdefghijklmnopqrstuvwxyz';

	$chars	.=	'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	//$chars	.=	'~!@#$%^&*()_+{}[]|/?<>,.';



	// set password legnth between 8 and 14 characters long

	$len	= rand(8, 25);



	// initialize password & counter

	$pass	= '';

	$i		= 0;



	while ($i < $len)

	{

		// get a new character

		$new_char	= substr($chars, rand(0, strlen($chars) -1), 1);



		// ensure all characters are different

		if(! strstr($pass, $new_char))

		{

			$pass	.= $new_char;

			$i++;

		}

	}

	return $pass;

}
}
?>