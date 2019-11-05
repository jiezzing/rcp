<?php
	class ApproverInsert
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

		// Insert data to decline file
        public function createDeclineFile(){
			$query = "INSERT INTO rcp_declined_file(rcp_no, rcp_reason, rcp_date_declined, rcp_status) VALUES (?, ?, ?, 'Declined')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_reason);
			$sel->bindParam(3, $this->rcp_date_declined);

			$sel->execute();
			return $sel;
		}

		// Insert data to approve file
		public function createApproveFile(){
			$query = "INSERT INTO rcp_approved_file(rcp_no, rcp_date_approved, rcp_status) VALUES (?, ?, 'Approved')";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_date_approved);

			$sel->execute();
			return $sel;
		}

		// Method in creating RCP
		public function createRcpEditHistory(){
			$query = "INSERT INTO rcp_file_edit_history(rcp_no, rcp_comp_code, rcp_proj_code, rcp_payee, rcp_amt_in_words, rcp_total_amt, rcp_approver_id, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_comp_code);
			$sel->bindParam(3, $this->rcp_proj_code);
			$sel->bindParam(4, $this->rcp_payee);
			$sel->bindParam(5, $this->rcp_amt_in_words);
			$sel->bindParam(6, $this->rcp_total_amt);
			$sel->bindParam(7, $this->rcp_approver_id);
			$sel->bindParam(8, $this->updated_at);

			$sel->execute();
			return $sel;
		}

		// Method in creating RCP
		public function createRcpParticularsEditHistory(){
			$query = "INSERT INTO rcp_particulars_edit_history(rcp_file_id, rcp_no, rcp_particulars, rcp_ref_code, rcp_amount, updated_at) VALUES ((SELECT COUNT(rcp_no) FROM rcp_file_edit_history), ?, ?, ?, ?, ?)";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->bindParam(2, $this->rcp_particulars);
			$sel->bindParam(3, $this->rcp_ref_code);
			$sel->bindParam(4, $this->rcp_amount);
			$sel->bindParam(5, $this->updated_at);

			$sel->execute();
			return $sel;
		}
    }
?>