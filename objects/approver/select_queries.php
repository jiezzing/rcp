<?php
	class ApproverSelect
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

        // Get all pending RCP's
        public function getPendingRcp(){
            $query = "SELECT * FROM rcp_file rcp, user_file usr, project_file, company_file, department_file, user_account_file acc WHERE usr.user_id=acc.user_id AND rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp.rcp_status = 1 AND rcp.rcp_approver_id=? AND rcp.rcp_employee_id=usr.user_id ORDER BY rcp.created_at DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);

			$sel->execute();

			return $sel;
		}

	    // Get all approved RCP's
	    public function getApprovedRcp(){
			$query = "SELECT * FROM rcp_file rcp, rcp_approved_file app, user_file usr, project_file, company_file, department_file WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp.rcp_no = app.rcp_no AND rcp.rcp_status = 'Approved' AND rcp.rcp_approver_id=? AND rcp.rcp_employee_id=usr.user_id ORDER BY rcp_date_approved DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);

			$sel->execute();

			return $sel;
		}

		// Get all declined RCP's
		public function getDeclinedRcp(){
			$query = "SELECT * FROM rcp_file, project_file, company_file, department_file, user_file, rcp_declined_file  WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_file.rcp_no=rcp_declined_file.rcp_no AND rcp_file.rcp_status='Declined' AND rcp_approver_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);

			$sel->execute();

			return $sel;
		}

        // Get specific RCP
        public function getRcpDetails(){
            $query = "SELECT * FROM rcp_file rcp, user_file usr, project_file, company_file, department_file WHERE rcp_project=proj_code AND rcp_company=comp_code AND rcp_department=dept_code AND rcp.rcp_status = 'Pending' AND rcp.rcp_no=? AND rcp.rcp_approver_id=usr.user_id ORDER BY rcp.rcp_date_issued DESC";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			$sel->execute();

			return $sel;
		}

        // Get specific RCP history
        public function getRcpHistory(){
            $query = "SELECT * FROM rcp_file_edit_history, company_file, project_file WHERE rcp_comp_code=comp_code AND rcp_proj_code=proj_code AND rcp_no=? AND rcp_approver_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_approver_id);

			$sel->execute();

			return $sel;
		}

        // Get specific RCP particulars
        public function getRcpParticularsHistory(){
            $query = "SELECT * FROM rcp_particulars_edit_history, rcp_file WHERE rcp_file_id=? AND rcp_file.rcp_no=rcp_particulars_edit_history.rcp_no";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_file_id);

			$sel->execute();

			return $sel;
		}
    }
?>