<?php

Class Model {

/*
 * @the registry
 * @access private
 */
private $registry;

/*
 * @Variables array
 * @access private
 */
private $vars = array();

/**
 *
 * @constructor
 *
 * @access public
 *
 * @return void
 *
 */
function __construct($registry) {
	$this->registry = $registry;

}


 /**
 *
 * @set undefined vars
 *
 * @param string $index
 *
 * @param mixed $value
 *
 * @return void
 *
 */
 public function __set($index, $value)
 {
        $this->vars[$index] = $value;
 }


function getStuff() {
    echo 'username';
    echo 'password';
}
public function createModel($object, $key)
{
	require_once(__SITE_PATH .'/model/' .$object . '.class.php');
	$this->objects[$key] = new $object($this);
}
	/**
		get an object from the registries
		@param string $key the objects array key
		@return object
	*/
public function getModel($key)
{
	return $this->objects[$key];
}

}

?>
