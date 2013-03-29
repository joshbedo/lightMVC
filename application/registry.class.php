<?php

Class Registry {

 /*
 * @the vars array
 * @access private
 */
 private $vars = array();


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

 /**
 *
 * @get variables
 *
 * @param mixed $index
 *
 * @return mixed
 *
 */
 public function createAndStoreObject($object, $key)
	{
		require_once(__SITE_PATH .'/model/' .$object . '.class.php');
		$this->objects[$key] = new $object($this);
	}
	/**
		store settings
		@param string $setting the data
		@param string $key the key pair for the setting array
	*/
	public function storeSetting($setting, $key)
	{
		$this->settings[$key] = $setting;
	}
	/**
		get a setting from the registries
		@param string $key the settings array key
		@return string the setting data
	*/
	public function getSetting($key)
	{
		return $this->settings[$key];
	}
	/**
		get an object from the registries
		@param string $key the objects array key
		@return object
	*/
	public function getObject($key)
	{
		return $this->objects[$key];
	}
 public function __get($index)
 {
	return $this->vars[$index];
 }


}

?>
