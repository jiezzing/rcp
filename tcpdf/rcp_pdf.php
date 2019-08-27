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
include '../config/connection.php';
include '../objects/univ/selects_for_all.php';

$con = new connection();
$db = $con->connect();

$sel = new U_Select($db);

$rcp_no = "";
$rcp_apprvr = "";
$rcp_payee = "";
$rcp_words_amt = "";
$rcp_amt = "";
$rcp_date_issued = "";
$rcp_due_date = "";
$rcp_justify = "";
$dept_name = "";
$comp_name = "";
$apprvr_id = "";
$rqstr_name = "";
$apprvr_name = "";

$sel->rcp_no = $_GET['rcp_no'];
$query = $sel->getRcpDetails();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $rcp_no = $row['rcp_no'];
  $dept_name = $row['dept_name'];
  $comp_name = $row['comp_name'];
  $rcp_payee = $row['rcp_payee'];;
  $rqstr_name = $row['user_firstname'] . " " . $row['user_middle_initial'] . ". " . $row['user_lastname'];
  $rcp_words_amt = $row['rcp_amount_in_words'];
  $rcp_amt = $row['rcp_total_amount'];
  $apprvr_id = $row['rcp_approver_id'];
  $rcp_date_issued = $row['rcp_date_issued'];
}
$sel->user_id = $apprvr_id;
$query = $sel->getApproversData();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $apprvr_name = $row['APP_NAME'];
}

$sel->rcp_no = $rcp_no;
$query = $sel->getRcpRushData();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
  $rcp_due_date = $row['rcp_due_date'];
  $rcp_justify = $row['rcp_justification'];
}
// create new PDF document

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
<table cellpadding="2">
    <tr nobr="true" style="font-size: 12px">
        <th colspan="2"><strong>'.$comp_name.'</strong></th>
        <th colspan="2" align="right"><strong>REQUEST FOR CHECK PAYMENT</strong></th>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="3" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">PAYEE: '.$rcp_payee.'</td>
        <td colspan="1" style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">Date: '.$rcp_date_issued.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="4" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">AMOUNT IN WORDS: '.$rcp_words_amt.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="4" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">CHARGE TO PROJECT/DEPT: '.$dept_name.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;" align="center">
        <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">PARTICULARS</td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">BOM Ref/Acct Code</td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">Amount </td>
    </tr>
    ';
  $index = 0;
  $sel->rcp_no = $rcp_no;
  $query = $sel->getRcpParticularValidatedDetails();
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $tbl .= '
      <tr nobr="true" style="font-size: 9px;">
          <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.$row['rcp_particulars'].'</td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.$row['rcp_ref_code'].'</td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.number_format($row['rcp_amount'], 2).'</td>
      </tr>
    ';
    $index++;
  }
  for ($i=$index; $i < 8; $i++) { 
    $tbl .= '
      <tr nobr="true" style="font-size: 9px;">
          <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
      </tr>
    ';
  }
  $tbl .= '
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"><strong>TOTAL: </strong> '.number_format($rcp_amt, 2).'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="3" style="border-left: 1px solid black; border-right: 1px solid black;"><strong>NOTE:</strong><br>
          1. BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
          <br> 
           2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
           <br> 
           3.  All alterations must be initialed by the authorized requesters / officers. 
           <br> 
           4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
           <br>  
           5.  All "RUSH" RCPs should be accompanied by an <u>acceptable explanation.</u></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;"><strong>IF Rush, fill in the ff.: <br></strong>
         Due Date: '.$rcp_due_date.'<br><strong>Reason/Justification: <br> </strong> '.$rcp_justify.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Prepared by: 
          <br>
          <br>
          <label><u>'.strtoupper($rqstr_name).'</u></label>
          <br>
          Signature Over Printed Name</td>
        <td style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Approved by:
          <br>
          <br>
          <label><u>'.strtoupper($apprvr_name).'</u></label>
          <br>
          Signature Over Printed Name</td>
        <td style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Counter Check: 
          <br>
          <br>
          ________________________________
          <br>
          ACCOUNTING</td>
        <td style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">RCP NO.
          <br>
          <br>
          <label style="font-size: 16px"><strong>'.$rcp_no.'</strong></label>
          <br>
        </td>
    </tr>
</table>
<br>
<br>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
<br>
<br>
<table cellpadding="2">
    <tr nobr="true" style="font-size: 12px">
        <th colspan="2"><strong>'.$comp_name.'</strong></th>
        <th colspan="2" align="right"><strong>REQUEST FOR CHECK PAYMENT</strong></th>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="3" style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">PAYEE: '.$rcp_payee.'</td>
        <td colspan="1" style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">Date: '.$rcp_date_issued.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="4" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">AMOUNT IN WORDS: '.$rcp_words_amt.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="4" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">CHARGE TO PROJECT/DEPT: '.$dept_name.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;" align="center">
        <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">PARTICULARS</td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">BOM Ref/Acct Code</td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;">Amount </td>
    </tr>
    ';
  $index = 0;
  $sel->rcp_no = $rcp_no;
  $query = $sel->getRcpParticularValidatedDetails();
  while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $tbl .= '
      <tr nobr="true" style="font-size: 9px;">
          <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.$row['rcp_particulars'].'</td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.$row['rcp_ref_code'].'</td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> '.number_format($row['rcp_amount'], 2).'</td>
      </tr>
    ';
    $index++;
  }
  for ($i=$index; $i < 8; $i++) { 
    $tbl .= '
      <tr nobr="true" style="font-size: 9px;">
          <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
          <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"> </td>
      </tr>
    ';
  }
  $tbl .= '
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black;"><strong>TOTAL: </strong> '.number_format($rcp_amt, 2).'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td colspan="3" style="border-left: 1px solid black; border-right: 1px solid black;"><strong>NOTE:</strong><br>
          1. BOM Ref Code refers to Project Construction Expenses; Account Code refers to department expenses. Fixed Asset must use CPX-code. 
          <br> 
           2.  To facilitate processing, please fill out all the fields COMPLETELY especially the account to be charged and attach the necessary supporting documents.
           <br> 
           3.  All alterations must be initialed by the authorized requesters / officers. 
           <br> 
           4.  Avoid having RUSH requests; however, if truly urgent, indicate the date needed (box at the right). 
           <br>  
           5.  All "RUSH" RCPs should be accompanied by an <u>acceptable explanation.</u></td>
        <td colspan="1" style="border-left: 1px solid black; border-right: 1px solid black;"><strong>IF Rush, fill in the ff.: <br></strong>
         Due Date: '.$rcp_due_date.'<br><strong>Reason/Justification: <br> </strong> '.$rcp_justify.'</td>
    </tr>
    <tr nobr="true" style="font-size: 9px;">
        <td style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Prepared by: 
          <br>
          <br>
          <label><u>'.strtoupper($rqstr_name).'</u></label>
          <br>
          Signature Over Printed Name</td>
        <td style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Approved by:
          <br>
          <br>
          <label><u>'.strtoupper($apprvr_name).'</u></label>
          <br>
          Signature Over Printed Name</td>
        <td style="border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">Counter Check: 
          <br>
          <br>
          ________________________________
          <br>
          ACCOUNTING</td>
        <td style="border-top: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center">RCP NO.
          <br>
          <br>
          <label style="font-size: 16px"><strong>'.$rcp_no.'</strong></label>
          <br>
        </td>
    </tr>
</table>
';
$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output($rcp_no. '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+