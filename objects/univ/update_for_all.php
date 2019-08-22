<?php
	class U_Update
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        public $firstname;
        public $lastname;
        public $middile_initial;
        public $email;
        public $username;
        public $password;
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

		// Update first login attempt password
        public function updatePassword(){
			$query = "UPDATE user_account_file SET user_password='".$this->password."', user_log_count=1 WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->user_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		// Update department no. of rcp
		public function updateDeptRcpNo(){
			$query = "UPDATE department_file SET dept_no_of_rcp = (dept_no_of_rcp + 1) WHERE dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->dept_code);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		// Update first login attempt password
        public function updateUserDetails(){
			$query = "UPDATE user_file SET user_firstname='".$this->firstname."', user_lastname='".$this->lastname."', user_middle_initial='".$this->middile_initial."' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->user_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		// Update first login attempt password
        public function updateUserAccountDetails(){
			$query = "UPDATE user_account_file SET user_username='".$this->username."', user_email='".$this->email."' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->user_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateUserAccountDetailsAndPassword(){
			$query = "UPDATE user_account_file SET user_username='".$this->username."', user_email='".$this->email."', user_password='".$this->password."' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->user_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}
    }
?>