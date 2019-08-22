<?php
	class AdminCount
	{
		private $conn;
        private $table_name="tgu_rcpdb";
        
        // Connect database
		public function __construct($db){
			$this->conn = $db;
		}

        // Get all pending RCP's
        public function countPendingRcp(){
            $query = "SELECT COUNT(rcp_approver_id) AS TOTAL FROM rcp_file WHERE rcp_status='Pending'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

        // Get all approved RCP's
        public function countApprovedRcp(){
            $query = "SELECT COUNT(rcp_approver_id) AS TOTAL FROM rcp_file WHERE rcp_status='Approved'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

        // Get all declined RCP's
        public function countDeclinedRcp(){
            $query = "SELECT COUNT(rcp_approver_id) AS TOTAL FROM rcp_file WHERE rcp_status='Declined'";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

        // Total all RCP's
        public function totalRcp(){
            $query = "SELECT COUNT(rcp_approver_id) AS TOTAL FROM rcp_file";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);

			$sel->execute();

			return $sel;
		}

        // Count all the administrator users
        public function countAdmins(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=1";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Count all the requestor users
        public function countRequestor(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=2";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Count all the primary approver users
        public function countPrmyApprover(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=3";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Count all the alternate primary approver users
        public function countAltPrmyApprover(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=4";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Count all the secondary approver users
        public function countSecApprover(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=5";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}

		// Count all the allternate secondary approver users
        public function countAltSecApprover(){
            $query = "SELECT COUNT(user_type) AS TOTAL FROM user_file WHERE user_type=6";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->execute();

			return $sel;
		}
    }
?>