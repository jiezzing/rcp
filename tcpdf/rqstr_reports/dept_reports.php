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
require_once("../tcpdf.php");
include "../../tcpdf/query.php";
include "../../tcpdf/connection.php";
$database = new connection();
$db = $database->connect();

// create new PDF document
$rcp = new Rcp($db);

$dept_code = $_REQUEST['dept_code'];
$user_id = $_REQUEST['user_id'];

$start_date = $_REQUEST['from'];
$end_date = $_REQUEST['to'];

if($start_date == ""){
    $mFrom = "";
}
else{
    $mFrom = date("Y-m-d", strtotime($_REQUEST['from']));
}

if($end_date == ""){
    $mTo = "";
}
else{
    $mTo = date("Y-m-d", strtotime($_REQUEST['to']));
}

$dept_name = "";


$rcp->dept_code = $dept_code;
$get_deptName = $rcp->GetDeptName();
while ($row = $get_deptName->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $dept_name = $row['dept_name'];
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Department Reports');
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
$pdf->AddPage('L', 'A4');


// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
        if($mFrom != "" && $mTo != ""){
        $tbl = '

            <table  cellpadding="4">
            <tr nobr="true">
                <th colspan="6"><strong>'.$dept_name.' DEPARTMENT</strong></th>
                <th rowspan="2" colspan="3" align="right"><strong>REQUEST FOR CHECK PAYMENT</strong></th>
             </tr>
             <tr nobr="true">
                <th colspan="6" style="font-size: 10px">Reports from <strong>'.$mFrom.'</strong> to <strong>'.$mTo.'</strong></th>
             </tr>
             <tr nobr="true" style="font-size: 11px; font-weight: bold;" align="center">
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black">RCP No.</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Approver</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Payee</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Department</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Company</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Project</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Date</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Total Amt</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Status</th>
             </tr>
             ';
            $rcp->rcp_employee_id = $user_id;
            $rcp->rcp_department = $dept_code;
            $rcp->startDate = $mFrom;
            $rcp->endDate = $mTo;
            $hasValue = false;

            $data = $rcp->GetAllDeptInRcpRqstrFromAndTo();
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $hasValue = true;
            $tbl .= '
            <tr nobr="true" style="font-size: 9px;">
                <td style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>'.$row['rcp_no'].'</strong></td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_payee'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['dept_name'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['comp_name'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['proj_name'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_date_issued'].'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.number_format($row['rcp_total_amount'], 2).'</td>
                <td style="border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><i>'.$row['rcp_status'].'</i></td>
             </tr>
             ';
            }

            if(!$hasValue){
                $tbl .= '
                    <tr nobr="true" style="font-size: 9px;">
                        <td colspan="9" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>NO RECORDS FOUND</strong></td>
                    </tr>
                ';
            }

             $tbl .= '
            </table>
            ';
    }
    else if($mFrom != "" && $mTo == ""){
    $tbl = '
        <table  cellpadding="4">
        <tr nobr="true">
            <th colspan="6"><strong>'.$dept_name.' DEPARTMENT</strong></th>
            <th rowspan="2" colspan="3" align="right"><strong>REQUEST FOR CHECK PAYMENT</strong></th>
         </tr>
         <tr nobr="true">
            <th colspan="6" style="font-size: 10px">Reports from <strong>'.$mFrom.'</strong> and above.</th>
         </tr>
         <tr nobr="true" style="font-size: 11px; font-weight: bold;" align="center">
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black">RCP No.</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Approver</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Payee</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Department</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Company</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Project</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Date</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Total Amt</th>
            <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Status</th>
         </tr>
         ';
            $rcp->rcp_employee_id = $user_id;
            $rcp->rcp_department = $dept_code;
            $rcp->startDate = $mFrom;

            $hasValue = false;

            $data = $rcp->GetAllDeptInRcpRqstrFromOnly();
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
                if(sizeof($row) > 0){
                    $hasValue = true;
                    $tbl .= '
                    <tr nobr="true" style="font-size: 9px;">
                        <td style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>'.$row['rcp_no'].' AHAH</strong></td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_payee'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['dept_name'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['comp_name'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['proj_name'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_date_issued'].'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.number_format($row['rcp_total_amount'], 2).'</td>
                        <td style="border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><i>'.$row['rcp_status'].'</i></td>
                     </tr>
                     ';
                }
            }

            if(!$hasValue){
                $tbl .= '
                    <tr nobr="true" style="font-size: 9px;">
                        <td colspan="9" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>NO RECORDS FOUND</strong></td>
                    </tr>
                ';
            }

            $tbl .= '
                </table>
        ';
    }
    else{

        $tbl = '

            <table  cellpadding="4">
            <tr nobr="true">
                <th colspan="6"><strong>'.$dept_name.' DEPARTMENT</strong></th>
                <th rowspan="2" colspan="3" align="right"><strong>REQUEST FOR CHECK PAYMENT</strong></th>
             </tr>
             <tr nobr="true">
                <th colspan="6" style="font-size: 10px">Reports of <strong>'.$dept_name.'</strong></th>
             </tr>
             <tr nobr="true" style="font-size: 11px; font-weight: bold;" align="center">
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black">RCP No.</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Approver</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Payee</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Department</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Company</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Project</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Date</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Total Amt</th>
                <th style=" border-top: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black">Status</th>
             </tr>
             ';

        $rcp->rcp_employee_id = $user_id;
        $rcp->rcp_department = $dept_code;
        $hasValue = false;
        
        $data = $rcp->GetAllDeptInRcpRqstr();
        while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $hasValue = true;
        $tbl .= '
        <tr nobr="true" style="font-size: 9px;">
            <td style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>'.$row['rcp_no'].'</strong></td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['user_firstname'].' '.$row['user_middle_initial'].'. '.$row['user_lastname'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_payee'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['dept_name'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['comp_name'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['proj_name'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.$row['rcp_date_issued'].'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;">'.number_format($row['rcp_total_amount'], 2).'</td>
            <td style="border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><i>'.$row['rcp_status'].'</i></td>
         </tr>
         ';
        }

        if(!$hasValue){
                $tbl .= '
                    <tr nobr="true" style="font-size: 9px;">
                        <td colspan="9" style="border-left: 1px solid black; border-right: 1px solid black;border-bottom: 1px solid black; text-align: center"><strong>NO RECORDS FOUND</strong></td>
                    </tr>
                ';
            }

         $tbl .= '
        </table>
        ';
    }
$pdf->writeHTML($tbl, true, false, false, false, '');

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+