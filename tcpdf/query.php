<?php
	class Rcp
	{
		private $conn;
		private $table_name="tgu_rcpdb";

		public $employee_email;
		public $employee_password;

		public $employee_fname;
		public $employee_lname;
		public $employee_initial;
		public $employee_company;
		public $employee_department;
		public $employee_username;
		public $employee_email_2;
		public $employee_password_2;
		public $employee_id;
		public $employee_status;
		public $max;
		public $startDate="";
		public $endDate="";

		public function __construct($db)
		{
			$this->conn = $db;
		}


		public function RushRcpFile()
		{
			$query = "SELECT * FROM rcp_file rcp, rcp_rush_file rush, user_file usr WHERE rcp.rcp_no=rush.rcp_no AND rcp.rcp_employee_id=usr.user_id AND rcp.rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}
		public function NotRushRcpFile()
		{
			$query = "SELECT * FROM rcp_file rcp, user_file usr WHERE rcp.rcp_employee_id=usr.user_id AND rcp.rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		public function RcpParticulars()
		{
			$query = "SELECT * FROM rcp_particulars_file WHERE rcp_no=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_no);
			$sel->execute();

			return $sel;
		}

		public function CountRow()
		{
			$query = "SELECT COUNT(rcp_id) as row_counter FROM rcp_particulars_file WHERE rcp_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);
			$sel->execute();

			return $sel;
		}

		public function RcpRush()
		{
			$query = "SELECT * FROM rcp_rush_file WHERE rcp_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_id);
			$sel->execute();

			return $sel;
		}


		public function RcpApproverName()
		{
			$query = "SELECT * FROM rcp_approver_file app, user_file usr WHERE (rcp_prmy_app_id=? OR rcp_alt_prmy_app_id=? OR rcp_sec_app_id=? OR rcp_alt_sec_app_id=?) AND user_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			
			$sel->bindParam(1, $this->rcp_prmy_app_id);
			$sel->bindParam(2, $this->rcp_alt_prmy_app_id);
			$sel->bindParam(3, $this->rcp_sec_app_id);
			$sel->bindParam(4, $this->rcp_alt_sec_app_id);
			$sel->bindParam(5, $this->user_id);

			$sel->execute();

			return $sel;
		}

		public function ApproverName()
		{
			$query = "SELECT * FROM user_file WHERE user_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_id);
			$sel->execute();

			return $sel;
		}
		public function GetDeptName()
		{
			$query = "SELECT * FROM department_file WHERE dept_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->dept_code);
			$sel->execute();

			return $sel;
		}

		public function GetProjName()
		{
			$query = "SELECT * FROM project_file WHERE proj_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->proj_code);
			$sel->execute();

			return $sel;
		}

		public function GetCompName()
		{
			$query = "SELECT * FROM company_file WHERE comp_code=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->comp_code);
			$sel->execute();

			return $sel;
		}

		public function GetRqstrName()
		{
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM user_file WHERE user_id=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->user_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcp()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_approver_id=? AND rcp_department=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_approver_id=? AND rcp_department=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."')  AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_approver_id=? AND rcp_department=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpRqstr()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_employee_id=? AND rcp_department=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_approver_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpRqstrFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_employee_id=? AND rcp_department=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_approver_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpRqstrFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_employee_id=? AND rcp_department=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_approver_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_department=? AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpAdminFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_department=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetAllDeptInRcpAdminFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, project_file, user_file, department_file WHERE rcp_department=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_project=proj_code AND rcp_employee_id=user_id AND rcp_department=dept_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}


		public function GetAllProjInRcp()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_project=? AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_project=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_project=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpRqstr()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_project=? AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpRqstrFromAndT0()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_project=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpRqstrFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_project=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_project=? AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpAdminFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_project=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllProjInRcpAdminFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_project=? AND rcp_date_issued>='".$this->startDate."' AND rcp_company=comp_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_project=proj_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcp()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_company=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_company=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_company=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpRqstr()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_company=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpRqstrFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_company=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpRqstrFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_company=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->bindParam(2, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_company=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpAdminFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_company=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllCompInRcpAdminFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_company=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetAllRqstrRcp()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllRqstrRcpAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllRqstrRcpFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllRqstrRcpFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllRqstrRcpFromOnlyAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_employee_id=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllApprvrRcp()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllApprvrRcpFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllApprvrRcpFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_employee_id=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_approver_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->bindParam(2, $this->rcp_employee_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllPrmyApprvrAdmin()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllPrmyApprvrAdminFromAndTo()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND (rcp_date_issued>='".$this->startDate."' AND rcp_date_issued<='".$this->endDate."') AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->execute();

			return $sel;
		}

		public function GetAllPrmyApprvrAdminFromOnly()
		{
			$query = "SELECT * FROM rcp_file, company_file, department_file, user_file, project_file WHERE rcp_approver_id=? AND rcp_date_issued>='".$this->startDate."' AND rcp_project=proj_code AND rcp_department=dept_code AND rcp_employee_id=user_id AND rcp_company=comp_code";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_approver_id);
			$sel->execute();

			return $sel;
		}


		public function GetApproverId()
		{
			$query = "SELECT * FROM rcp_file WHERE rcp_department=?";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetApproverName()
		{
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE rcp_department=? AND user_id=rcp_approver_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_department);
			$sel->execute();

			return $sel;
		}

		public function GetApproverNameProjAdmin()
		{
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE rcp_project=? AND user_id=rcp_approver_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_project);
			$sel->execute();

			return $sel;
		}

		public function GetApproverNameCompAdmin()
		{
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE rcp_company=? AND user_id=rcp_approver_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_company);
			$sel->execute();

			return $sel;
		}

		public function GetProjApproverName()
		{
			$query = "SELECT CONCAT(user_firstname, ' ', user_middle_initial, '. ', user_lastname) as approver_name FROM rcp_file, user_file WHERE rcp_project=? AND user_id=rcp_approver_id";
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO:: ERRMODE_WARNING);
			$sel = $this->conn->prepare($query);

			$sel->bindParam(1, $this->rcp_project);
			$sel->execute();

			return $sel;
		}
	}
?>