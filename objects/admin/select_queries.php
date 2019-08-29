<?php
	class AdminSelect
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}
		
		//Get all RCP
		public function getAllRcp(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code ORDER BY created_at DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}
		
		//Get all pending RCP
		public function getAllPendingRcp(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code AND rcp_status='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}
		
		//Get all approved RCP
		public function getAllApprovedRcp(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code AND rcp_status='Approved'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}
		
		//Get all declined RCP
		public function getAllDeclinedRcp(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code AND rcp_status='Declined'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all approvers name
		public function getAllApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ', user_lastname) as approver_name FROM rcp_file, user_file WHERE user_id=rcp_approver_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all pending rcp approvers name
		public function getAllPendingApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE user_id=rcp_approver_id AND rcp_status='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all approved rcp approvers name
		public function getAllApprovedApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE user_id=rcp_approver_id AND rcp_status='Approved'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all declined rcp approvers name
		public function getAllDeclinedApprover(){
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE user_id=rcp_approver_id AND rcp_status='Declined'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all users information
		public function getAllUsers(){
			$query = "SELECT CONCAT(user_lastname, ', ' ,user_firstname) as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name, user_username, user_email, user_password FROM user_file, company_file, department_file, user_type_file, user_account_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_id=user_account_file.user_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get requestor information
		public function getRequestor(){
			$query = "SELECT CONCAT(user_lastname, ', ' ,user_firstname, ' ' ,user_middle_initial, '.') as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=2";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get administrator information
		public function getAdministrator(){
			$query = "SELECT CONCAT(user_lastname, ', ' ,user_firstname, ' ' ,user_middle_initial, '.') as name, user_file.user_id, user_comp_code, user_dept_code, user_type_file.user_type, user_file.user_status, comp_name, dept_name FROM user_file, company_file, department_file, user_type_file WHERE comp_code=user_comp_code AND dept_code=user_dept_code AND user_type_file.user_id=user_file.user_type AND user_file.user_type=1";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all user account details
		public function getAccounts(){
			$query = "SELECT CONCAT(file.user_lastname, ', ', file.user_firstname, ' ', file.user_middle_initial, '.') as fullname, file.user_id, acc.user_password, acc.user_username, acc.user_email, acc.user_status FROM user_file file, user_account_file acc WHERE acc.user_id = file.user_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all primary approver
		public function getAllPrmyApprover(){
			$query = "SELECT * FROM approver_file, user_file, department_file, company_file WHERE approver_prmy_id=user_id AND dept_code=approver_dept_code AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all primary approver id that is equals to 0
		public function getAllNotSetPrmyApprover(){
			$query = "SELECT * FROM approver_file, department_file WHERE approver_prmy_id=0 AND dept_code=approver_dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate primary approver
		public function getAllAltPrmyApprover(){
			$query = "SELECT * FROM approver_file, user_file, department_file, company_file WHERE approver_alt_prmy_id=user_id AND dept_code=approver_dept_code AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate primary approver id that is equals to 0
		public function getAllNotSetAltPrmyApprover(){
			$query = "SELECT * FROM approver_file, department_file WHERE approver_alt_prmy_id=0 AND dept_code=approver_dept_code ";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all secondary approver
		public function getAllSecApprover(){
			$query = "SELECT * FROM approver_file, user_file, department_file, company_file WHERE approver_sec_id=user_id AND dept_code=approver_dept_code AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all secondary approver id that is equals to 0
		public function getAllNotSetSecApprover(){
			$query = "SELECT * FROM approver_file, department_file WHERE approver_sec_id=0 AND dept_code=approver_dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate primary approver
		public function getAllAltSecApprover(){
			$query = "SELECT * FROM approver_file, user_file, department_file, company_file WHERE approver_alt_sec_id=user_id AND dept_code=approver_dept_code AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all alternate primary approver id that is equals to 0
		public function getAllNotSetAltSecApprover(){
			$query = "SELECT * FROM approver_file, department_file WHERE approver_alt_sec_id=0 AND dept_code=approver_dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get all requestor RCP for report generation with specific department
		public function getAllRequestorsRcpWithDeptCode(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_department=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		// Get all requestor RCP for report generation
		public function getAllRequestorsRcp(){
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Get the data of specific primary approver
		public function getPrmyApproversData(){
            $query = "SELECT * FROM approver_file, department_file, user_file, company_file WHERE approver_dept_code=? AND approver_dept_code=dept_code AND approver_prmy_id=? AND approver_prmy_id=user_id AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->approver_dept_code);
			$sel->bindParam(2, $this->approver_prmy_id);

			$sel->execute();

			return $sel;
		}

		// Get the data of specific alternate primary approver
		public function getAltPrmyApproversData(){
            $query = "SELECT * FROM approver_file, department_file, user_file, company_file WHERE approver_dept_code=? AND approver_dept_code=dept_code AND approver_alt_prmy_id=? AND approver_alt_prmy_id=user_id AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->approver_dept_code);
			$sel->bindParam(2, $this->approver_alt_prmy_id);

			$sel->execute();

			return $sel;
		}

		// Get the data of specific alternate primary approver
		public function getSecApproversData(){
            $query = "SELECT * FROM approver_file, department_file, user_file, company_file WHERE approver_dept_code=? AND approver_dept_code=dept_code AND approver_sec_id=? AND approver_sec_id=user_id AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->approver_dept_code);
			$sel->bindParam(2, $this->approver_sec_id);

			$sel->execute();

			return $sel;
		}

		// Get the data of specific alternate primary approver
		public function getAltSecApproversData(){
            $query = "SELECT * FROM approver_file, department_file, user_file, company_file WHERE approver_dept_code=? AND approver_dept_code=dept_code AND approver_alt_sec_id=? AND approver_alt_sec_id=user_id AND comp_code=user_comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->approver_dept_code);
			$sel->bindParam(2, $this->approver_alt_sec_id);

			$sel->execute();

			return $sel;
		}

		// Get the data of specific alternate primary approver
		public function getRcpParticulars(){
            $query = "SELECT * FROM rcp_file, rcp_particulars_file WHERE rcp_file.rcp_no=rcp_particulars_file.rcp_no AND rcp_particulars_file.rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			$sel->execute();

			return $sel;
		}
    }
?>