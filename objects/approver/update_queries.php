<?php
	class ApproverUpdate
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
        public $updated_at;
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

		// Update rcp file
		public function updateRcp(){

			$query = "UPDATE rcp_file SET rcp_payee='".$this->payee."', rcp_company='".$this->comp_code."', rcp_project='".$this->proj_code."', rcp_amount_in_words='".$this->amount_in_words."', rcp_total_amount='".$this->total_amount."', edited_by_app='Yes' WHERE rcp_id=?";
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

		// Update rcp backup
		public function updateBackupRcp(){

			$query = "UPDATE rcp_backup_file SET rcp_comp_code='".$this->comp_code."', rcp_proj_code='".$this->proj_code."', rcp_payee='".$this->payee."', rcp_amt_in_words='".$this->amount_in_words."', rcp_total_amt='".$this->total_amount."', rcp_approver_id='".$this->apprvr_id."' WHERE rcp_id=? AND rcp_status = 'NO CHANGES'";
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

		// Update RCP backup particulars
		public function updateRcpBackupParticulars(){
			$query = "UPDATE rcp_backup_particulars_file SET rcp_particulars='".$this->particulars."', rcp_ref_code='".$this->ref_code."', rcp_amount='".$this->amount."' WHERE rcp_id=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);

			if($sel->execute()){
				return true;
			}
			else{
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

		public function declineRcpFileStatus(){
			$query = "UPDATE rcp_file SET updated_at='".$this->updated_at."', rcp_status = 'Declined' WHERE rcp_no=? AND rcp_status = 'Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function declineOrigRcpFileStatus(){
			$query = "UPDATE rcp_orig_file SET rcp_status = 'Declined' WHERE rcp_no=? AND rcp_status = 'Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function declineParticularStatus(){
			$query = "UPDATE rcp_particulars_file SET updated_at='".$this->updated_at."', rcp_status = 'Declined' WHERE rcp_no=? AND rcp_status = 'Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function declineOrigParticularStatus(){
			$query = "UPDATE rcp_orig_particulars_file SET rcp_status = 'Declined' WHERE rcp_no=? AND rcp_status = 'Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function declineRushStatus(){
			$query = "UPDATE rcp_rush_file SET rcp_status = 'Declined' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function approveRcpFileStatus(){
			$query = "UPDATE rcp_file SET updated_at='".$this->updated_at."', rcp_status = 'Approved' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function approveOrigRcpFileStatus(){
			$query = "UPDATE rcp_orig_file SET rcp_status = 'Approved' WHERE rcp_no=? AND rcp_status='Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function approveParticularStatus(){
			$query = "UPDATE rcp_particulars_file SET rcp_status = 'Approved' WHERE rcp_no=? AND rcp_status='Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function approveOrigParticularStatus(){
			$query = "UPDATE rcp_orig_particulars_file SET rcp_status = 'Approved' WHERE rcp_no=? AND rcp_status='Pending'";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function approveRushStatus(){
			$query = "UPDATE rcp_rush_file SET rcp_status = 'Approved' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}

		public function readNotification(){
			$query = "UPDATE notification_file SET notif_status = 'Read' WHERE rcp_no=?";
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			if($sel->execute()){
				return true;
			}
			else{
				return false;
			}
			return $sel;
		}
    }
?>