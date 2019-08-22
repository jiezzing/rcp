<?php
ob_start();
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');
include '../tcpdf/query.php';
include "../tcpdf/connection.php";
$database = new connection();
$db = $database->connect();

// create new PDF document
$rcpRow = new Rcp($db);

$id=   $_REQUEST['id'];
$rcp_no=$_REQUEST['rcp_no'];
$app_id = $_REQUEST['user_id'];
$rush_rcp = $_REQUEST['rush'];

echo $id;

$rcpRow->rcp_id = $id;
$rcpRow->rcp_no = $rcp_no;


$get_rush_rcp = $rcpRow->RushRcpFile();
$get_not_rush_rcp = $rcpRow->NotRushRcpFile();
$get_part = $rcpRow->RcpParticulars();
$get_part2 = $rcpRow->RcpParticulars();
$ctr_row = $rcpRow->CountRow();
// $rcp_rush = $rcpRow->RcpRush();
if($rush_rcp == "Yes")
{
  while ($row = $get_rush_rcp->fetch(PDO::FETCH_ASSOC)) {
  	    extract($row);
  	    $rcp_no = $row['rcp_no'];
  	    $rcp_company = $row['rcp_company'];
  	    $rcp_payee = $row['rcp_payee'];
  	    $rcp_date = $row['rcp_date_issued'];
  	    $rcp_amt = $row['rcp_amount_in_words'];
  	    $rcp_sub_dept = $row['rcp_sub_department'];
  	    $rcp_due_date = $row['rcp_due_date'];
  	    $rcp_justification = $row['rcp_justification'];
  	    $rcp_total = $row['rcp_total_amount'];
        $firstname = $row['user_firstname'];
        $middleI = $row['user_middle_initial'];
        $lastname = $row['user_lastname'];
  	}
}
else
{
  while ($row = $get_not_rush_rcp->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $rcp_no = $row['rcp_no'];
        $rcp_company = $row['rcp_company'];
        $rcp_payee = $row['rcp_payee'];
        $rcp_date = $row['rcp_date_issued'];
        $rcp_amt = $row['rcp_amount_in_words'];
        $rcp_sub_dept = $row['rcp_sub_department'];
        $rcp_total = $row['rcp_total_amount'];
        $firstname = $row['user_firstname'];
        $middleI = $row['user_middle_initial'];
        $lastname = $row['user_lastname'];
    }
}

$rcpRow->rcp_prmy_app_id = $app_id;
$rcpRow->rcp_alt_prmy_app_id = $app_id;
$rcpRow->rcp_sec_app_id = $app_id;
$rcpRow->rcp_alt_sec_app_id = $app_id;

$rcpRow->user_id = $app_id;

$approver = $rcpRow->RcpApproverName();

  while ($row = $approver->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $app_fname = $row['user_firstname'];
    $app_mname = $row['user_middle_initial'];
    $app_lname = $row['user_lastname'];
  }
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('RCP');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
// $pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$tbl = '


<table cellspacing="0" cellpadding="3" border="1" style="font-size: 9px;" id="table">
	<tr>
        <td colspan="2" style="font-size:13px; border-top: 1px solid white; border-left: 1px solid white"><strong>'.$rcp_company.'</strong></td>
        <td colspan="2" style="text-align: right; font-size:13px; border-top: 1px solid white; border-right: 1px solid white"><strong>REQUEST FOR CHECK PAYMENT</strong></td>
    </tr>
    <tr>
        <td colspan="3" style="width:487px">PAYEE: <strong>'.$rcp_payee.'</strong></td>
        <td style="width:151px">Date: '.$rcp_date.'</td>
    </tr>
    <tr>
        <td colspan="4">AMOUNT IN WORDS: '.$rcp_amt.'</td>
    </tr>
    <tr>
        <td colspan="4">CHARGE TO PROJECT/DEPT: '.$rcp_project.'</td>
    </tr>
    <tr style="text-align: center">
        <th style="width: 387px" colspan="2">PARTICULARS</th>
        <th style="width: 100px">BOM Ref/Acct Code</th>
        <th style="width: 151px" colspan="2">Amount</th>
    </tr>
    ';
    while ($row = $get_part->fetch(PDO::FETCH_ASSOC)) {
	    extract($row);
	    $tbl .= '
	    <tr>
	        <td colspan="2" style="text-indent: 10px">'.$row['rcp_particulars'].'</td>
	        <td style="text-indent: 10px">'.$row['rcp_ref_code'].'</td>
	        <td colspan="2" style="text-align: right">'.number_format($row['rcp_amount'], 2).'</td>
	    </tr>
	    ';
	}
	// for()
	$ctr = "";
	while ($row = $ctr_row->fetch(PDO::FETCH_ASSOC)) {
		$ctr = $row['row_counter'];
	}
	for($i = $ctr; $i < 7; $i++)
	{
	$tbl .= '
	    <tr>
	        <td colspan="2"></td>
	        <td></td>
	        <td colspan="2"></td>
	    </tr>
	    ';
	}

    $tbl .= '
    <tr>
        <td colspan="2"></td>
        <td></td>
        <td style="width: 43px">TOTAL</td>
        <td style="width: 108px; text-align: right">'.number_format($rcp_total, 2).'</td>
    </tr>
    <tr>
        <td colspan="3"><p style="color: black; text-align: justify">NOTE:
        <br> 
               1.  BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
               <br> 
               2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
               <br> 
               3.  All alterations must be initialed by the authorized requesters / officers. 
               <br> 
               4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
               <br>  
               5.  All "RUSH" RCPs should be accompanied by an <u>acceptable explanation.</u>
            </p></td>
        <td colspan="2"><p style="color: black;" cellpadding="5">
              <strong>IF Rush, fill in the ff.:</strong>
              <br>
              <label>Due Date:<u></u></label> <u>'.$rcp_due_date.'</u>
              <br>
              <strong><label>Reason/Justification:</label></strong>
              <br>
              <label>'.$rcp_justification.'</label>
              <br>
              <label></label>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2"  style="width: 160px; height: 50px; text-align: center;"> 
	        Prepared by:
	        <br>
	        <br>
	        <label><u>'.$firstname.' '.$middleI.'. '.$lastname.'</u></label>
	        <br>
	        Signature Over Printed Name
        </td>
        <td style="width: 160px; text-align: center"> 
        	Approved by:
        	<br>
	        <br>
          <label>________________________________</label>
	        <br>
	        SUPERVISOR / DEPT. HEAD
        </td>
        <td style="width:167px; text-align: center"> 
        	Counter Check:
        	<br>
	        <br>
	        ________________________________
	        <br>
	        ACCOUNTING
        </td>
        <td style="width: 151px; text-align: center;">
	        RCP No. 
	        <br>
	        <br>
	        <strong><label style="font-size: 13px;">'.$rcp_no.'</label></strong>
        </td>
    </tr>
</table>
<br>
<br>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
<br>
<br>
<table cellspacing="0" cellpadding="3" border="1" style="font-size: 9px;" id="table">
	<tr>
        <td colspan="2" style="font-size:13px; border-top: 1px solid white; border-left: 1px solid white"><strong>'.$rcp_company.'</strong></td>
        <td colspan="2" style="text-align: right; font-size:13px; border-top: 1px solid white; border-right: 1px solid white"><strong>REQUEST FOR CHECK PAYMENT</strong></td>
    </tr>
    <tr>
        <td colspan="3" style="width:487px">PAYEE: <strong>'.$rcp_payee.'</strong></td>
        <td style="width:151px">Date: '.$rcp_date.'</td>
    </tr>
    <tr>
        <td colspan="4">AMOUNT IN WORDS: '.$rcp_amt.'</td>
    </tr>
    <tr>
        <td colspan="4">CHARGE TO PROJECT/DEPT: '.$rcp_project.'</td>
    </tr>
    <tr style="text-align: center">
        <th style="width: 387px" colspan="2">PARTICULARS</th>
        <th style="width: 100px">BOM Ref/Acct Code</th>
        <th style="width: 151px" colspan="2">Amount</th>
    </tr>
    ';
    while ($row = $get_part2->fetch(PDO::FETCH_ASSOC)) {
	    extract($row);
	    $tbl .= '
	    <tr>
	        <td colspan="2" style="text-indent: 10px">'.$row['rcp_particulars'].'</td>
	        <td style="text-indent: 10px">'.$row['rcp_ref_code'].'</td>
	        <td colspan="2" style="text-align: right">'.number_format($row['rcp_amount'], 2).'</td>
	    </tr>
	    ';
	}
	// for()
	$ctr = "";
	while ($row = $ctr_row->fetch(PDO::FETCH_ASSOC)) {
		$ctr = $row['row_counter'];
	}
	for($i = $ctr; $i < 7; $i++)
	{
	$tbl .= '
	    <tr>
	        <td colspan="2"></td>
	        <td></td>
	        <td colspan="2"></td>
	    </tr>
	    ';
	}

    $tbl .= '
    <tr>
        <td colspan="2"></td>
        <td></td>
        <td style="width: 43px">TOTAL</td>
        <td style="width: 108px; text-align: right">'.number_format($rcp_total, 2).'</td>
    </tr>
    <tr>
        <td colspan="3"><p style="color: black; text-align: justify">NOTE:
        <br> 
               1.  BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
               <br> 
               2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
               <br> 
               3.  All alterations must be initialed by the authorized requesters / officers. 
               <br> 
               4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
               <br>  
               5.  All "RUSH" RCPs should be accompanied by an <u>acceptable explanation.</u>
            </p></td>
        <td colspan="2"><p style="color: black;" cellpadding="5">
              <strong>IF Rush, fill in the ff.:</strong>
              <br>
              <label>Due Date:<u></u></label> <u>'.$rcp_due_date.'</u>
              <br>
              <strong><label>Reason/Justification:</label></strong>
              <br>
              <label>'.$rcp_justification.'</label>
              <br>
              <label></label>
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2"  style="width: 160px; height: 50px; text-align: center;"> 
	        Prepared by:
	        <br>
	        <br>
	        <label><u>'.$firstname.' '.$middleI.'. '.$lastname.'</u></label>
          <br>
          Signature Over Printed Name
        </td>
        <td style="width: 160px; text-align: center"> 
          Approved by:
          <br>
          <br>
          <label>________________________________</label>
	        SUPERVISOR / DEPT. HEAD
        </td>
        <td style="width:167px; text-align: center"> 
        	Counter Check:
        	<br>
	        <br>
	        ________________________________
	        <br>
	        ACCOUNTING
        </td>
        <td style="width: 151px; text-align: center;">
	        RCP No. 
	        <br>
	        <br>
	        <strong><label style="font-size: 13px;">'.$rcp_no.'</label></strong>
        </td>
    </tr>
</table>
';




$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+