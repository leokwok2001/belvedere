<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF {

    function __construct() {
        parent::__construct();
    }

}

class MYPDF extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    // Load table data from file
    public function LoadData($file) {
        $data = array();
        $data = $file;
        return $data;
    }

    // Page footer
//    public function Footer() {
//        // Position at 15 mm from bottom
//        $this->SetY(-15);
//        // Set font
//            $this->SetFont('cid0jp', '', 5);
//        //$this->SetFont('helvetica', 'I', 8);
//        // Page number
//        $this->Cell(0, 10, 'BG3 Managment Office|Poltium Block 3,Belvedere Garden Phase 3,625 Castle Park Road,Tseung Wan,N.T 電話 Tel:24987292 傳真 Fax:24167070 '.' Page:' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
//              
//              
//    }
    // Colored table
    public function ColoredTable($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            //FIRSTNAME,LASTNAME,TEL,BLOCK'
            $this->Cell($w[0], 6, $row['CODE'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['FIRSTNAME'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['LASTNAME'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['TEL'], 'LR', 0, 'L', $fill);
            //  $this->Cell($w[4], 6, $row[4], 'LR', 0, 'L', $fill);
            //  $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            //  $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Colored table
    public function Debitnote($detail_header, $data_detail) {





        // echo searchForId('202E1611',$data_detail);



        $this->SetFont('helvetica', '', 8);

// define barcode style
        $style = array(
            'position' => 'R',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $this->write1DBarcode($detail_header['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');

        $this->SetFont('cid0jp', '', 11);

        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);


        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $date = date_create($detail_header['INDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        $this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);

        //     $this->SetFont('Arial','',11);
        $this->Write(0, $detail_header['ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, $detail_header['ADDRESS2'], '', 0, 'L', true, 0, false, false, 0);

        $block = $detail_header['RES_BLOCK'];
        $floor = $detail_header['RES_FLOOR'];
        $unit = $detail_header['RES_UNIT'];

        $K = array(125, 50);
        $this->Cell($K[0], 5, $detail_header['ADDRESS3'], 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);
        $this->Cell($K[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'C', false);
        $this->SetFont('cid0jp', '', 9);
        $this->Ln();


        $this->Cell($K[0], 5, $detail_header['ADDRESS4'], 0, 0, 'L', false);
        $this->Cell($K[1], 5, 'FLAT ' . $unit . ',' . $floor . ' /F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'C', false);


        $w = array(120, 40, 25);

        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->SetTextColor(0);
        $this->SetLineWidth('');

//

        $ttloverdue = 0.00;




        foreach ($data_detail as $key => $val) {
            //   echo   $val['FROMDATE']. "-".  $val['FROMDATE']. "  ". $val['AMT']. "</br>" ;

            $this->Cell($w[0], 6, '', 0, 0, 'L', false);

            $this->Cell($w[1], 6, $val['FROMDATE'] . "  -  " . $val['TODATE'], 0, 0, 'C', false);
            $this->Cell($w[2], 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);

            $ttloverdue = $ttloverdue + $val['AMT'];
            $this->Ln();
        }

        $array1 = array_filter($data_detail);
        if (empty($array1)) {
            for ($x = 1; $x <= 3; $x++) {
                $this->Cell($w[0], 6, '', 0, 0, 'L', false);
                $this->Cell($w[1], 6, '', 0, 0, 'C', false);
                $this->Cell($w[2], 6, '', 0, 0, 'R', false);
                $this->Ln();
            }
        }

        $this->Ln(6);
//        
//print_r($data_detail);
/// current data


        $this->Ln();
        $this->Ln();
        $this->Ln();


        $time = strtotime($detail_header['INDATE']);
        $month = date("m", $time);
        $year = date("Y", $time);

        $date1 = $year . '/' . $month . '/1';
        $this->Cell($w[0], 6, '', 0, 0, 'L', false);
        //$this->Cell($w[1], 6,        date_format($date, "Y/m/d") . ' - 30/11/2016', 0, 0, 'C', false);

        $ttlamt1 = 0.00;

        $this->Cell($w[1], 6, $date1 . ' - 30/11/2016', 0, 0, 'C', false);
        $this->Cell($w[2], 6, '$' . number_format($detail_header['AMT'], 2), 0, 0, 'R', false);
        $this->Ln();
        $this->Ln(6);
        $ttlamt1 = $ttloverdue + $detail_header['AMT'];
        $this->Cell($w[0] + $w[1], 6, '', 0, 0, 'C', false);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[2], 6, '$' . number_format($ttlamt1, 2), 0, 0, 'R', false);
        $this->SetFont('cid0jp', '', 11);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();


        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();


        $this->SetFont('cid0jp', '', 11);


        $offset1 = 30;

        $this->Cell($w[0] + $w[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
        $this->Cell($w[2], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();


        $this->Cell($w[0] + $w[1], 5, 'FLAT ' . $unit . ',' . $floor . ' /F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'L', false);
        $this->Cell($w[2], 5, $detail_header['CODE'], 0, 0, 'R', false);
        $this->Ln();

        $this->Cell($w[0] + $w[1], 5, '', 0, 0, 'L', false);
        $this->Cell($w[2], 5, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);


        $this->Ln();
        $this->Cell($w[0] + $w[1], 5, '', 0, 0, 'L', false);
        $this->Cell($w[2], 5, '$' . number_format($detail_header['AMT'], 2), 0, 0, 'R', false);

        $this->Ln();
        $this->Cell($w[0] + $w[1], 5, '', 0, 0, 'L', false);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[2], 5, '$' . number_format($ttlamt1, 2), 0, 0, 'R', false);

        $this->SetFont('cid0jp', '', 11);

        //$this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        //$this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);




        $this->SetFont('helvetica', '', 8);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->write1DBarcode($detail_header['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');

//        //  foreach ($detail_detail as $row) {
//
//        $this->Cell($w[0], 6, '前期結欠', 'LR', 0, 'C', $fill);
//        $this->Cell($w[1], 6, ' ', 'LR', 0, 'C', $fill);
//        $this->Cell($w[2], 6, ' ', 'LR', 0, 'R', $fill);
//        $this->Cell($w[3], 6, 'HKD$' . number_format($detail_detail['P_OUTSTAND'], 2), 'LR', 0, 'R', $fill);
//
//        $this->Ln();
//        $this->Cell($w[0], 6, $detail_detail['INDATE'], 'LR', 0, 'C', $fill);
//        $this->Cell($w[1], 6, $detail_detail['CODE'], 'LR', 0, 'C', $fill);
//        $this->Cell($w[2], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 'LR', 0, 'R', $fill);
//        $this->Cell($w[3], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 'LR', 0, 'R', $fill);
//
//
//        $this->Ln();
//        $this->Cell($w[0] + $w[1] + $w[2], 7, '合計 Total', 1, 0, 'R', 1);
//        $this->Cell($w[3], 7, 'HKD$' . number_format($detail_detail['AMT'] + $detail_detail['P_OUTSTAND'], 2), 1, 0, 'R', 1);
//        //  $this->Cell($w[3], 6, ' ', 'LR', 0, 'C', $fill);
//
//        $this->Ln();
    }

    // Colored table


    public function Paymentreceipt($detail_detail, $detail_detail2, $detail_detail3) {

        $cellline = 0;
        $cellhight = 0;

        $this->SetFont('', 'B');
        $this->Write(0, '管理費繳付記錄', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '--正式收據 / Official Payment Receipt' . '        序號S/N:R' . $detail_detail['PAYMENTNO'], '', 0, 'L', true, 0, false, false, 0);

        // Colors, line width and bold font
        $this->SetFillColor(0, 150, 250);
        $this->SetTextColor(0);
        $this->SetLineWidth(0.3);
        $this->SetFont('');
        $this->Ln();

        $this->Cell(120, 7, '1.物業資料 Property Information', 1, 0, 'L', 1);
        $this->Ln();

        $this->Cell(65, $cellhight, '繳費日期/Payment Receive on', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, $detail_detail['INDATE'], $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '屋苑/Property', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, $detail_detail['BUILDING'], $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '物業詳細資料/Property Detail', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, 'CODE ' . $detail_detail['CODE'] . ',UNIT ' . $detail_detail['UNIT'] . ',BLOCK ', $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '住戶姓名 / Occupant', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, strtoupper($detail_detail['LASTNAME']) . ', ' . $detail_detail['FIRSTNAME'], $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '經手人 / Handled by', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '繳付當案編號 / Payment Reference No.', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
        $this->Ln();

        $this->Cell(65, $cellhight, '收據當案編號 / Receipt Reference No.', $cellline, 0, 'L', 0);
        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
        $this->Ln();


        // Colors, line width and bold font
        $this->SetFillColor(0, 150, 250);
        $this->SetTextColor(0);
        $this->SetLineWidth(0.3);
        $this->SetFont('');
        $this->Ln();
        $this->Cell(120, 7, '2.管理費繳付記錄 Payment Record(s)', 1, 0, 'L', 1);
        $this->Ln();

        // Colors, line width and bold font
        $this->SetFillColor(0, 150, 250);
        $this->SetTextColor(0);
        //$this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        // $detail_header = array('PARTICULARS', 'PERIOD', 'AMOUNT');

        $this->Ln();
        //  $w = array(40, 40, 30);
        //  $num_headers = count($detail_header);
        //  for ($i = 0; $i < $num_headers; ++$i) {
        $this->Cell(20, 7, '管理費月份', 1, 0, 'C', 1);
        $this->Cell(30, 7, '結單', 1, 0, 'C', 1);
        $this->Cell(30, 7, '備註', 1, 0, 'C', 1);
        $this->Cell(20, 7, '應付金額', 1, 0, 'C', 1);
        $this->Cell(20, 7, '繳付金額', 1, 0, 'C', 1);
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;

        foreach ($detail_detail2 as $row) {
            $this->Cell(20, 6, $row['MDATE'], 'LR', 0, 'C', $fill);
            $this->Cell(30, 6, $row['CODE'], 'LR', 0, 'C', $fill);
            $this->Cell(30, 6, '', 'LR', 0, 'C', $fill);
            $this->Cell(20, 6, '', 'LR', 0, 'C', $fill);
            $this->Cell(20, 6, number_format($row['AMT'], 2), 'LR', 0, 'R', $fill);
            $this->Ln();
        }



        //$fill = !$fill;
        //  }
        $this->Cell(120, 0, '', 'T');
        $this->Ln();

        $this->Cell(100, $cellhight, '應付脹項 / Total Due:', $cellline, 0, 'R', 0);
        $this->Cell(20, $cellhight, number_format($detail_detail3['P_OUTSTAND'], 2), $cellline, 0, 'R', 0);
        $this->Ln();

        $this->Cell(100, $cellhight, '繳付金額 / Amount Paid:', $cellline, 0, 'R', 0);
        $this->Cell(20, $cellhight, number_format($detail_detail['AMT'], 2), $cellline, 0, 'R', 0);
        $this->Ln();
        $this->Cell(100, $cellhight, '繳付方法 / Paid by:', $cellline, 0, 'R', 0);
        $this->Cell(20, $cellhight, $detail_detail['PAYTYPE'] === '0' ? 'Cheque' : 'Cash/Auotpay', $cellline, 0, 'R', 0);

        $this->Ln();
        $this->Cell(120, $cellhight, $detail_detail['CHEQNO'], $cellline, 0, 'R', 0);
        $this->Ln();
        $this->Ln();
        $this->Cell(120, $cellhight, '*** 多謝, 此收據 *** Thank You. End of Receipt ***', $cellline, 0, 'C', 0);
    }

    // Colored table
    public function outstanding_by_resident($header, $data) {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 10, 10, 10, 30, 30, 30, 30);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0.00;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['CODE'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['BLOCK'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row['UNIT'], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row['FLOOR'], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row['FIRSTNAME'], 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row['LASTNAME'], 'LR', 0, 'C', $fill);
            $this->Cell($w[6], 6, $row['TEL'], 'LR', 0, 'C', $fill);
            $this->Cell($w[7], 6, $row['P_OUTSTAND'], 'LR', 0, 'R', $fill);
            $amt = $amt + $row['P_OUTSTAND'];

            $this->Ln();
            $fill = !$fill;
        }


        $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[1], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[5], 6, '', 'LR', 0, 'C', $fill);
        $this->Cell($w[6], 6, 'Total Amount', 1, 0, 'R', $fill);
        $this->Cell($w[7], 6, $amt, 1, 0, 'R', 1);


        $this->Ln();


        $this->Cell(array_sum($w), 0, '', 'T');
    }

}
