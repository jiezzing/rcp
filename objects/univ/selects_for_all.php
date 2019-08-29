<?php
	class U_Select
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}
		
		//Get all departments that are active
		public function getAllDepartment(){
			$query = "SELECT * FROM department_file, approver_file WHERE approver_dept_code=dept_code AND  dept_status='AC'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all user type
		public function getAllUserType(){
			$query = "SELECT * FROM user_type_file";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all company
		public function getAllCompany(){
			$query = "SELECT * FROM company_file WHERE comp_status='AC'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all projects
		public function getAllProject(){
			$query = "SELECT * FROM project_file WHERE proj_status='AC'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all primary approver
		public function getAllPrmyApprover(){
			$query = "SELECT * FROM user_file WHERE user_type='3'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate primary approver
		public function getAllAltPrmyApprover()
		{
			$query = "SELECT * FROM user_file WHERE user_type='4'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all secondary approver
		public function getAllSecApprover(){
			$query = "SELECT * FROM user_file WHERE user_type='5'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate secondary approver
		public function getAllAltSecApprover(){
			$query = "SELECT * FROM user_file WHERE user_type='6'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all department reports
		public function getAllDeptReport(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_employee_id=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_approver_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		// Get all the department reports
		public function getAllDeptReports(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_employee_id=? AND rcp_department=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_approver_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		//Get all departments
		public function allDepartment(){
			$query = "SELECT * FROM department_file";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all projects
		public function allProject(){
			$query = "SELECT * FROM project_file";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all companies
		public function allCompany(){
			$query = "SELECT * FROM company_file";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all requestor
		public function allRequestor(){
			$query = "SELECT * FROM user_file WHERE user_type=2";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		//Get all company
		public function getUserDetails(){
			$query = "SELECT * FROM user_file, company_file, department_file, user_type_file, user_account_file WHERE user_file.user_id=? AND user_comp_code=comp_code AND user_dept_code=dept_code AND user_file.user_type=user_type_file.user_id AND user_account_file.user_id=user_file.user_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_id);
			$sel->execute();

			return $sel;
		}

		// Get specific RCP data
		public function getRcpDetails(){
			$query = "SELECT * FROM user_file, rcp_file, company_file, project_file, department_file WHERE rcp_no =? AND comp_code=rcp_company AND dept_code=rcp_department AND proj_code=rcp_project AND rcp_employee_id=user_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		// Get all particulars of specific data
		public function getRcpParticularDetails(){
			$query = "SELECT * FROM rcp_particulars_file WHERE rcp_no =? AND rcp_status='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		// Get all particulars of specific data that is validated
		public function getRcpParticularValidatedDetails(){
			$query = "SELECT * FROM rcp_particulars_file WHERE rcp_no =? AND rcp_status!='Removed'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		// Get all particulars of specific data that is validated
		public function getRcpParticularRemovedDetails(){
			$query = "SELECT * FROM rcp_particulars_file WHERE rcp_no =? AND rcp_status='Removed'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		// Get RPC rush data
		public function getRcpRushData(){
			$query = "SELECT * FROM rcp_rush_file WHERE rcp_no =?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		//Get the data of specific department
		public function getSpecificDepartment(){
			$query = "SELECT dept_code, dept_name, dept_no_of_rcp FROM department_file WHERE dept_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->dept_code);
			$sel->execute();

			return $sel;
		}

		//Get the data of specific project
		public function getSpecificProject(){
			$query = "SELECT * FROM project_file WHERE proj_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->proj_code);
			$sel->execute();

			return $sel;
		}

		//Get the data of specific company
		public function getSpecificCompany(){
			$query = "SELECT * FROM company_file WHERE comp_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->comp_code);
			$sel->execute();

			return $sel;
		}

		// Get approver ID of the specific department
		public function getApproversId(){
			$query = "SELECT * FROM approver_file WHERE approver_dept_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->approver_dept_code);

			$sel->execute();

			return $sel;
		}

		// Get approvers data
		public function getApproversData(){
			$query = "SELECT CONCAT(user_firstname, ' ' ,user_lastname) as APP_NAME, user_email, user_file.user_id FROM user_file, user_account_file WHERE user_file.user_id=user_account_file.user_id AND user_file.user_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_id);
			$sel->execute();

			return $sel;
		}

		// Check if rcp no already exists
		public function checkRcpNoExistence(){
			$query = "SELECT rcp_no FROM rcp_file WHERE rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		// Check if password is exist
		public function checkPassword(){
			$query = "SELECT * FROM user_account_file WHERE user_id=? AND user_password=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_id);
			$sel->bindParam(2, $this->user_password);
			$sel->execute();

			return $sel;
		}

		

		// Get primary approver information
		public function getPrmyApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ' ,user_lastname) as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=3";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get alternate primary approver information
		public function getAltPrmyApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ' ,user_lastname) as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=4";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get secondary approver information
		public function getSecApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ' ,user_lastname) as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=5";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get alternate secondary approver information
		public function getAltSecApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ' ,user_lastname) as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=6";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

        // Get specific RCP history
        public function getRcpHistory(){
            $query = "SELECT user_lastname, user_firstname, dept_name, comp_name, rcp_file_edit_history.updated_at, rcp_file_edit_history.rcp_id FROM rcp_file_edit_history, user_file, rcp_file, department_file, company_file WHERE dept_code=user_dept_code AND comp_code=user_comp_code AND rcp_file_edit_history.rcp_approver_id=user_id AND rcp_file.rcp_no=rcp_file_edit_history.rcp_no AND rcp_file_edit_history.rcp_no=? ORDER BY rcp_file_edit_history.rcp_id DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			$sel->execute();

			return $sel;
		}

		// Get specific RCP history
        public function getRcpHistoryDetails(){
            $query = "SELECT * FROM rcp_file_edit_history, department_file, company_file, project_file, user_file, rcp_file WHERE rcp_comp_code=comp_code AND rcp_proj_code=proj_code AND rcp_department=dept_code AND rcp_file.rcp_approver_id=user_id AND rcp_file.rcp_no=rcp_file_edit_history.rcp_no AND rcp_file_edit_history.rcp_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			$sel->execute();

			return $sel;
		}

		// Get specific RCP history
        public function getRcpHistoryParticularDetails(){
            $query = "SELECT * FROM rcp_particulars_edit_history, rcp_file_edit_history WHERE rcp_file_edit_history.rcp_id=rcp_file_id AND rcp_file_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_file_id);

			$sel->execute();

			return $sel;
		}
    }
?>