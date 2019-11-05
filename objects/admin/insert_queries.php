<?php
	class AdminInsert
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}
		
		// Method in creating new user
		public function createUser(){
			$query = "INSERT INTO user_file(user_lastname, user_firstname, user_middle_initial, user_comp_code, user_dept_code, user_type, user_status) VALUES (?, ?, ?, ?, ?, ?, 'AC')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);
			$sel->bindParam(1, $this->user_lastname);
			$sel->bindParam(2, $this->user_firstname);
			$sel->bindParam(3, $this->user_middle_initial);
			$sel->bindParam(4, $this->user_comp_code);
			$sel->bindParam(5, $this->user_dept_code);
			$sel->bindParam(6, $this->user_type);

			$sel->execute();
			return $sel;
		}

		// Method in creating new user account
		public function createUserAccount(){
			$query = "INSERT INTO user_account_file(user_username, user_password, user_log_count, user_email, user_status) VALUES (?, ?, 0, ?, 'AC')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_username);
			$sel->bindParam(2, $this->user_password);
			$sel->bindParam(3, $this->user_email);

			$sel->execute();
			return $sel;
		}

		// Method in creating new department
		public function addNewDepartment(){
			$query = "INSERT INTO department_file(dept_code, dept_name, dept_no_of_rcp, dept_status) VALUES (?, ?, 0, 'AC')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->dept_code);
			$sel->bindParam(2, $this->dept_name);

			$sel->execute();
			return $sel;
		}

		// Method in creating new project
		public function addNewProject(){
			$query = "INSERT INTO project_file(proj_code, proj_name, proj_status) VALUES (?, ?, 'AC')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->proj_code);
			$sel->bindParam(2, $this->proj_name);

			$sel->execute();
			return $sel;
		}

		// Method in creating new company
		public function addNewCompany(){
			$query = "INSERT INTO company_file(comp_code, comp_name, comp_status) VALUES (?, ?, 'AC')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->comp_code);
			$sel->bindParam(2, $this->comp_name);

			$sel->execute();
			return $sel;
		}
    }
?>