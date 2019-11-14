<?php
	class RequestorInsert
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}
		
		// Method in creating RCP
		public function createRcp(){
			$query = "INSERT INTO rcp_file(rcp_no, rcp_employee_id, rcp_approver_id, rcp_payee, rcp_company, rcp_project, rcp_department, rcp_date_issued, rcp_amount_in_words, rcp_total_amount, rcp_vat, rcp_supp_file, rcp_rush, edited_by_app, created_at, updated_at, rcp_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->bindParam(3, $this->rcp_approver_id);
			$sel->bindParam(4, $this->rcp_payee);
			$sel->bindParam(5, $this->rcp_company);
			$sel->bindParam(6, $this->rcp_project);
			$sel->bindParam(7, $this->rcp_department);
			$sel->bindParam(8, $this->rcp_date_issued);
			$sel->bindParam(9, $this->rcp_amount_in_words);
			$sel->bindParam(10, $this->rcp_total_amount);
			$sel->bindParam(11, $this->rcp_vat);
			$sel->bindParam(12, $this->rcp_supp_file);
			$sel->bindParam(13, $this->rcp_rush);
			$sel->bindParam(14, $this->edited_by_app);
			$sel->bindParam(15, $this->created_at);
			$sel->bindParam(16, $this->updated_at);
			$sel->bindParam(17, $this->rcp_status);

			$sel->execute();
			return $sel;
		}

		// Method in creating RCP original
		public function createOrigRcp(){
			$query = "INSERT INTO rcp_orig_file VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->bindParam(3, $this->rcp_approver_id);
			$sel->bindParam(4, $this->rcp_payee);
			$sel->bindParam(5, $this->rcp_company);
			$sel->bindParam(6, $this->rcp_project);
			$sel->bindParam(7, $this->rcp_department);
			$sel->bindParam(8, $this->rcp_date_issued);
			$sel->bindParam(9, $this->rcp_amount_in_words);
			$sel->bindParam(10, $this->rcp_total_amount);
			$sel->bindParam(11, $this->rcp_rush);
			$sel->bindParam(12, $this->created_at);
			$sel->bindParam(13, $this->updated_at);

			$sel->execute();
			return $sel;
		}

		// Method in creating particulars
		public function createRcpParticulars(){
			$query = "INSERT INTO rcp_particulars_file(rcp_no, rcp_qty, rcp_unit, rcp_particulars, rcp_ref_code, rcp_amount, rcp_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_qty);
			$sel->bindParam(3, $this->rcp_unit);
			$sel->bindParam(4, $this->rcp_particulars);
			$sel->bindParam(5, $this->rcp_ref_code);
			$sel->bindParam(6, $this->rcp_amount);
			$sel->bindParam(7, $this->rcp_status);

			$sel->execute();
			return $sel;
		}

		// Method in creating orig particulars 
		public function createOrigRcpParticulars(){
			$query = "INSERT INTO rcp_orig_particulars_file(rcp_no, rcp_particulars, rcp_ref_code, rcp_amount, created_at, updated_at, rcp_status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_particulars);
			$sel->bindParam(3, $this->rcp_ref_code);
			$sel->bindParam(4, $this->rcp_amount);
			$sel->bindParam(5, $this->created_at);
			$sel->bindParam(6, $this->updated_at);

			$sel->execute();
			return $sel;
		}

		// Data for inserting rush RCP
		public function createRushData(){
			$query = "INSERT INTO rcp_rush_file(rcp_no, rcp_justification, rcp_due_date, rcp_status)  VALUES (?, ?, STR_TO_DATE(?, '%m/%d/%Y'), ?)";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_justification);
			$sel->bindParam(3, $this->rcp_due_date);
			$sel->bindParam(4, $this->rcp_status);

			$sel->execute();
			return $sel;
		}

		// Create Notification
		public function createNotification(){
			$query = "INSERT INTO notification_file(rcp_no, notif_status)  VALUES (?, 'Unread')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			$sel->execute();
			return $sel;
		}
    }
?>