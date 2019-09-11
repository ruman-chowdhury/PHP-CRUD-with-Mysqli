<?php  
	
	class Database{
		private $servername ="localhost";
		private $db_user ="root";
		private $db_pass ="";
		private $db_name ="db_user";

		public $conn;
		public $error;


		public function __construct(){

				$link =  new mysqli($this->servername, $this->db_user, $this->db_pass, $this->db_name);
				$this->conn = $link;

				if (!$this->conn){
					$this->error = "Connection failed !" .$this->link->connect_error;
					return false;

				}
			

		} //end constructor



	} //end Database class





?>