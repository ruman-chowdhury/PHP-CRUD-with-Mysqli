<?php  
	include 'lib/Database.php';

	class Process{
		private $db;

		public function __construct(){
			$this->db = new Database();
		}

	
	//======================process of work=====================
		//==========select data==============
		public function selectData(){
			
			$query = "SELECT * FROM tbl_userInfo ORDER BY Id ASC";
			
			$result = $this->db->conn->query($query) or die($this->db->conn->error .__LINE__);

			if ($result->num_rows > 0){
				return $result;
			}else{
				return false;
			}

		} //end selectData

		
		//==========insert data==============
		public function insertData($data){

			$name = mysqli_real_escape_string($this->db->conn, $data['name']);
			$email = mysqli_real_escape_string($this->db->conn, $data['email']);
			$phone = mysqli_real_escape_string($this->db->conn, $data['phone']);

			$chk_email = $this->checkEmail($email);


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


			$query = "INSERT INTO tbl_userInfo(Name, Email, Phone)
					  VALUES('$name', '$email', '$phone')";

			$insert_row = $this->db->conn->query($query) or die($this->db->conn->error .__LINE__);

			if ($insert_row){
				header("Location: index.php");
			}
			
		}

		//check email,it is already used or not
		function checkEmail($email){
			$query = "SELECT Email FROM tbl_userInfo WHERE Email=$email LIMIT 1";
			$result = $this->db->conn->query($query); 

			if (var_dump($result) > 0){
				return true;

			}else{
				return false;

			}

		}//checkEmail method

		

		//==========update data==============
		public function getEmployeeById($id){
			$query = "SELECT * FROM tbl_userInfo WHERE Id=$id ";
			
			$query = $this->db->conn->query($query) or die($this->db->conn->error.__LINE__);
			
			$result = $query->fetch_assoc();

			return $result;
		}

		
		public function updatetData($id, $data){
			
			$name = mysqli_real_escape_string($this->db->conn, $data['name']);
			$email = mysqli_real_escape_string($this->db->conn, $data['email']);
			$phone = mysqli_real_escape_string($this->db->conn, $data['phone']);


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


			$query = "UPDATE tbl_userInfo 
					 SET Name='$name', Email='$email', Phone='$phone' WHERE Id=$id LIMIT 1";

			$update_row = $this->db->conn->query($query) or die($this->db->conn->error .__LINE__);

			if ($update_row){
				$msg = "<span class='alert alert-success'><strong>*</strong>Updated Successfully!</span>" ;
				return $msg;
			}
			


		} //end updateData

		

		//==========delete data==============
		public function deletetData($id){

			$query = "DELETE FROM tbl_userInfo WHERE Id=$id LIMIT 1";
			$delete_row = $this->db->conn->query($query) or die($this->db->conn->error .__LINE__);
			
			header('Location:index.php');

		}





	} //end process

?>