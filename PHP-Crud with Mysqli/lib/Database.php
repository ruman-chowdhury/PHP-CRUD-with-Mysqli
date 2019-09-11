<?php
	
	class Database{
		private $servername ="localhost";
		private $db_user ="root";
		private $db_pass ="";
		private $db_name = "db_user";

		private $conn;
		private $error;

		public function __construct(){

			$mysql_obj =  new mysqli($this->servername, $this->db_user, $this->db_pass, $this->db_name);
			$this->conn = $mysql_obj;

			if (!$this->conn){
				$this->error = "Connection failed !" .$this->mysql_obj->connect_error;
				return false;

			}

		} //end constructor

		//==============================process work===============================
		
		//==========Select Data=======
		public function selectData(){
			
			$query = "SELECT * FROM tbl_userinfo ORDER BY Id ASC";

			$result = $this->conn->query($query) or die($this->conn->error.__LINE__);

			if ($result->num_rows > 0){
				//fetch_row() or num_rows gives number of rows in db
				return $result;
			}else{
				return false;
			}

		}
		

		
		//==========Insert data=======
		public function insertData($data){

			$name = mysqli_real_escape_string($this->conn, $data['name']);
			$email = mysqli_real_escape_string($this->conn, $data['email']);
			$phone = mysqli_real_escape_string($this->conn, $data['phone']);

			$chk_email = $this->checkEmail($email); //method call



			if ($name =="" OR $email =="" OR $phone ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($name) < 3){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Name is too short!</span>" ;
				return $msg;
			}

			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Invalid email!</span>" ;
				return $msg;
			}

			if ($chk_email == true){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Email already exist!</span>" ;
				return $msg;
			}
			

			
			$query = "INSERT INTO tbl_userinfo(Name, Email, Phone) 
			 				VALUES('$name', '$email', '$phone')";
			$insert_row = $this->conn->query($query) or die($this->conn->error. __LINE__);


			if ($insert_row){
				header("Location:index.php");

			}
		
			

		} //end insertData
		
		//check email,it is already used or not
		function checkEmail($email){

			$query = "SELECT Email FROM tbl_userinfo WHERE Email=$email LIMIT 1";
			
			$result = $this->conn->query($query); 

			if (var_dump($result) > 0){
				return true;

			}else{
				return false;

			}

		}//checkEmail method




		//==========Update data=======
		//---show one user data in the field
		public function getUserById($userid){
			$query = "SELECT * FROM tbl_userinfo WHERE Id=$userid LIMIT 1";
			
			$query = $this->conn->query($query) or die($this->conn->error .__LINE__);
			$result = $query->fetch_assoc();
			
			return $result;

		}

		public function updateData($userid, $data){

			$name = mysqli_real_escape_string($this->conn, $data['name']);
			$email = mysqli_real_escape_string($this->conn, $data['email']);
			$phone = mysqli_real_escape_string($this->conn, $data['phone']);


			if ($name =="" OR $email =="" OR $phone ==""){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Field must not be empty!</span>" ;
				return $msg;
			}

			if (strlen($name) < 3){
				$msg = "<span class='alert alert-danger'><strong>*</strong> Name is too short!</span>" ;
				return $msg;
			}

			if (filter_var($email,FILTER_VALIDATE_EMAIL) === false){
				$msg = "<span class='alert alert-danger'><strong>*</strong>Invalid email!</span>" ;
				return $msg;
			}


			$query = "UPDATE tbl_userinfo
					SET Name ='$name', Email ='$email', Phone ='$phone'
					WHERE Id =$userid ";

			$update_row = $this->conn->query($query) or die($this->conn->error .__LINE__);

			if ($update_row){
				$msg = "<span class='alert alert-success'><strong>*</strong>Updated Successfully!</span>" ;
				return $msg;
			}


		} //end updateData
		
		
		//==========Delete data=======
		public function deleteData($id){
			
			$query = "DELETE FROM tbl_userinfo WHERE Id = $id ";
			$delete_row = $this->conn->query($query) or die($this->conn->error .__LINE__);
			header('Location:index.php');

		}
		



	} //end Database class
	
?>