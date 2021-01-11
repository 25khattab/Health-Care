<?php
class singleton {
	private $_connection;
	private static $_instance;
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "";
	private $_database="dp";

	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, $this->_password,$this->_database);
	
		if(mysqli_connect_error()) {
			$message = "database connection error";
			echo "<script type='text/javascript'>alert('$message');</script>";			
		}
	}

	public function getConnection() {
		return $this->_connection;
	}
}
?>
