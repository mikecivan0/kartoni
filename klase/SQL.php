<?php

class SQL {
	
protected $mysql_host,$mysql_database,$mysql_user,$mysql_password,$veza,$izraz;
	
	function __construct(){

		$this-> mysql_host = "localhost";
		$this-> mysql_database = "database";
		$this-> mysql_user = "user";
		$this-> mysql_password = "pass";
				
		$this->veza = new PDO("mysql:dbname=" . $this->mysql_database . ";host=" . $this->mysql_host 
											  . "", $this->mysql_user, $this->mysql_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		
	}

}
