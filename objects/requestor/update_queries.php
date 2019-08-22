<?php
	class RequestorUpdate
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        public $apprvr_id;
        public $comp_code;
        public $proj_code;
        public $payee;
        public $amount_in_words;
        public $total_amount;
        public $particulars;
        public $ref_code;
        public $amount;
        public $due_date;
        public $justification;
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

		// Update rcp file
		public function updateRcp(){

			$query = "UPDATE rcp_file SET rcp_approver_id='".$this->apprvr_id."', rcp_payee='".$this->payee."', rcp_company='".$this->comp_code."', rcp_project='".$this->proj_code."', rcp_amount_in_words='".$this->amount_in_words."', rcp_total_amount='".$this->total_amount."', updated_at='".date("Y-m-d H:i:s")."' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		// Update rcp file
		public function updateOrigRcp(){

			$query = "UPDATE rcp_orig_file SET rcp_approver_id='".$this->apprvr_id."', rcp_payee='".$this->payee."', rcp_company='".$this->comp_code."', rcp_project='".$this->proj_code."', rcp_amount_in_words='".$this->amount_in_words."', rcp_total_amount='".$this->total_amount."', updated_at='".date("Y-m-d H:i:s")."' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		// Update RCP particulars
		public function updateRcpParticulars(){
			$query = "UPDATE rcp_particulars_file SET rcp_particulars='".$this->particulars."', rcp_ref_code='".$this->ref_code."', rcp_amount='".$this->amount."' WHERE rcp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		// Update RCP particulars orig
		public function updateOrigRcpParticulars(){
			$query = "UPDATE rcp_orig_particulars_file SET rcp_particulars='".$this->particulars."', rcp_ref_code='".$this->ref_code."', rcp_amount='".$this->amount."', updated_at='".date("Y-m-d H:i:s")."'  WHERE rcp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		// Remove RCP particulars
		public function removeRcpParticulars(){
			$query = "UPDATE rcp_particulars_file SET rcp_status='Removed' WHERE rcp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		// Remove RCP backup particulars
		public function removeRcpBackupParticulars(){
			$query = "UPDATE rcp_backup_particulars_file SET rcp_status='Removed' WHERE rcp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			if($sel->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
			return $sel;
		}

		public function updateRcpRushFile(){
			$query = "UPDATE rcp_rush_file SET rcp_justification='".$this->justification."', rcp_due_date='".$this->due_date."' WHERE rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}
    }
?>