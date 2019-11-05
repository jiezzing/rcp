<?php
	class Count
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

        // Get all pending RCP's
        public function countPendingRcp(){
            $query = "SELECT COUNT(rcp_employee_id) AS TOTAL FROM rcp_file WHERE rcp_employee_id=? AND rcp_status='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

        // Get all approved RCP's
        public function countApprovedRcp(){
            $query = "SELECT COUNT(rcp_employee_id) AS TOTAL FROM rcp_file WHERE rcp_employee_id=? AND rcp_status='Approved'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

        public function countValidatedRcp(){
            $query = "SELECT COUNT(notif_status) AS TOTAL FROM rcp_file, notification_file WHERE rcp_employee_id=? AND notif_status='Unread' AND rcp_file.rcp_no=notification_file.rcp_no AND rcp_status!='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

        // Get all declined RCP's
        public function countDeclinedRcp(){
            $query = "SELECT COUNT(rcp_employee_id) AS TOTAL FROM rcp_file WHERE rcp_employee_id=? AND rcp_status='Declined'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}

        // Total all RCP's
        public function totalRcp(){
            $query = "SELECT COUNT(rcp_employee_id) AS TOTAL FROM rcp_file WHERE rcp_employee_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);

			$sel->execute();

			return $sel;
		}
    }
?>