<?php
	class AdminUpdate
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        public $firstname;
        public $lastname;
        public $middile_initial;
        public $user_type;
        public $dept_code;
        public $comp_code;
        public $email;
        public $username;
        public $password;
        public $id;
        public $name;
        public $code;
        
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

		public function deactUserFileStatus(){
			$query = "UPDATE user_file SET user_status='NA' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$del = $this->conn->prepare($query);

			$del->bindParam(1, $this->user_id);

			if($del->execute()){
				return true;
			}
			else{
				return false;
			}
			return $del;
		}

		public function deactUserAccountStatus(){
			$query = "UPDATE user_account_file SET user_status='NA' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$del = $this->conn->prepare($query);

			$del->bindParam(1, $this->user_id);

			if($del->execute()){
				return true;
			}
			else{
				return false;
			}
			return $del;
		}

		public function activateUserFileStatus(){
			$query = "UPDATE user_file SET user_status='AC' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$del = $this->conn->prepare($query);

			$del->bindParam(1, $this->user_id);

			if($del->execute()){
				return true;
			}
			else{
				return false;
			}
			return $del;
		}

		public function activateUserAccountStatus(){
			$query = "UPDATE user_account_file SET user_status='AC' WHERE user_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$del = $this->conn->prepare($query);

			$del->bindParam(1, $this->user_id);

			if($del->execute()){
				return true;
			}
			else{
				return false;
			}
			return $del;
		}



		// Update first login attempt password
        public function updateUserDetails(){
			$query = "UPDATE user_file SET user_firstname='".$this->firstname."', user_lastname='".$this->lastname."', user_middle_initial='".$this->middile_initial."', user_comp_code='".$this->comp_code."', user_dept_code='".$this->dept_code."', user_type='".$this->user_type."' WHERE user_id=?";
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
			$query = "UPDATE user_account_file SET user_username='".$this->username."', user_password='".$this->password."', user_email='".$this->email."' WHERE user_id=?";
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
        public function updateUserAccountDetailsUpdate(){
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

		public function updatePrmyApprover(){
			$query = "UPDATE approver_file SET approver_prmy_id='".$this->id."' WHERE approver_dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->approver_dept_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateAltPrmyApprover(){
			$query = "UPDATE approver_file SET approver_alt_prmy_id='".$this->id."' WHERE approver_dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->approver_dept_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateSecApprover(){
			$query = "UPDATE approver_file SET approver_sec_id='".$this->id."' WHERE approver_dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->approver_dept_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateAltSecApprover(){
			$query = "UPDATE approver_file SET approver_alt_sec_id='".$this->id."' WHERE approver_dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->approver_dept_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateDepartment(){
			$query = "UPDATE department_file SET dept_code='".$this->code."', dept_name='".$this->name."' WHERE dept_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->dept_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateProject(){
			$query = "UPDATE project_file SET proj_code='".$this->code."', proj_name='".$this->name."' WHERE proj_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->proj_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function updateCompany(){
			$query = "UPDATE company_file SET comp_code='".$this->code."', comp_name='".$this->name."' WHERE comp_code=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->comp_code);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function deactivateDepartment(){
			$query = "UPDATE department_file SET dept_status='NA' WHERE dept_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->dept_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function activateDepartment(){
			$query = "UPDATE department_file SET dept_status='AC' WHERE dept_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->dept_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function activateProject(){
			$query = "UPDATE project_file SET proj_status='AC' WHERE proj_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->proj_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function deactivateProject(){
			$query = "UPDATE project_file SET proj_status='NA' WHERE proj_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->proj_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function deactivateCompany(){
			$query = "UPDATE company_file SET comp_status='NA' WHERE comp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->comp_id);

			if($upd->execute()){
				return true;
			}
			else{
				return false;
			}
			return $upd;
		}

		public function activateCompany(){
			$query = "UPDATE company_file SET comp_status='AC' WHERE comp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$upd = $this->conn->prepare($query);

			$upd->bindParam(1, $this->comp_id);

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