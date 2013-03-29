<?php

 /*** error reporting on ***/
 //error_reporting(E_ALL);

 /*** define the site path ***/
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);

 /*** define the directory path ***/
 define ('__MAIN_DIR', '/customer');

/*** define your database variables ***/
 define ('__db_host', 'localhost');
 define ('__db_uname', 'username');
 define ('__db_upass', 'pass');
 define ('__db_name', 'dbname');

/*** define admin email ***/
define ('__admin_email', 'example@yahoo.com');

 /*** include the init.php file ***/
 include 'includes/init.php';

 /*** load the router ***/
 $registry->router = new router($registry);

 /*** set the controller path ***/
 $registry->router->setPath (__SITE_PATH . '/controller');

 /*** load up the template ***/
 $registry->template = new template($registry);

 /*** load up the model ***/
 $registry->model = new model($registry);

 /*** load the controller ***/
 $registry->router->loader();

?>
