<?php
	class Select
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}
		
		// Login
		public function login()
		{
			$query = "SELECT CONCAT(file.user_firstname, ' ' ,file.user_lastname) as user_fullname, file.user_id, acc.user_email, acc.user_username, acc.user_password, file.user_dept_code, file.user_comp_code, acc.user_log_count, file.user_type FROM user_account_file acc, user_file file, user_type_file type WHERE type.user_id=file.user_type AND acc.user_id = file.user_id AND acc.user_username=? AND acc.user_password=? AND acc.user_status = 'AC'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_username);
			$sel->bindParam(2, $this->user_password);

			$sel->execute();

			return $sel;
		}

        // Get all pending RCP's
        public function getPendingRcp($limit, $offset)
        {
            $query = "SELECT * FROM rcp_file rcp, user_file usr, user_account_file acc, project_file, company_file, department_file WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp.rcp_status=1 AND rcp.rcp_employee_id=? AND rcp.rcp_approver_id=usr.user_id AND rcp.rcp_approver_id=acc.user_id ORDER BY rcp.created_at DESC LIMIT $limit OFFSET $offset";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}
		
		// Check the type of user
		public function checkUserType()
		{
			$query = "SELECT file.user_type, acc.user_status FROM user_account_file acc, user_file file WHERE file.user_id = acc.user_id AND acc.user_username=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);


			$sel->bindParam(1, $this->user_username);
			$sel->execute();

			return $sel;
		}

		// Logout
		public function logout(){
			session_start();
			if(session_destroy()){
				return true;
			}
			else{
				return false;   	 	
			}
	    }

	    // Get all approved RCP's
	    public function getApprovedRcp(){
			$query = "SELECT * FROM rcp_file rcp, rcp_approved_file app, user_file usr, project_file, company_file, department_file WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp.rcp_no = app.rcp_no AND rcp.rcp_status = 'Approved' AND rcp.rcp_employee_id=? AND rcp.rcp_approver_id=usr.user_id ORDER BY rcp.rcp_id DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

		// Get all declined RCP's
		public function getDeclinedRcp(){
			$query = "SELECT * FROM rcp_file, project_file, company_file, department_file, user_file, rcp_declined_file  WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_file.rcp_no=rcp_declined_file.rcp_no AND rcp_file.rcp_status='Declined' AND rcp_employee_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

		// Get specific RCP old data
		public function getOldRcpDetails(){
			$query = "SELECT * FROM user_file, rcp_orig_file, company_file, project_file, department_file WHERE rcp_no =? AND comp_code=rcp_company AND dept_code=rcp_department AND proj_code=rcp_project AND rcp_employee_id=user_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}


		// Get all particulars of specific old data that is validated
		public function getOldRcpParticularDetails(){
			$query = "SELECT * FROM rcp_orig_particulars_file WHERE rcp_no =? AND rcp_status='Approved'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		public function getAllRcpNo(){
            $query = "SELECT * FROM rcp_file, notification_file WHERE rcp_file.rcp_no=notification_file.rcp_no AND rcp_employee_id=? AND rcp_status!='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}
    }
?>