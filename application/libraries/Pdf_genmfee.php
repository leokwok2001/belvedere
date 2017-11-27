<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_genmfee extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function Debitnote($detail_header, $data_detail) {


        $this->SetFont('helvetica', '', 8);

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
        //    $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        //********************************************
        $this->Ln(8);   /// new adjest   ok 
//******************************************** 

        $date = date_create($detail_header['INDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);



        $this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);

//********************************************        
        $this->Ln(1);   /// new adjest   ok 
//********************************************        
        //     $this->SetFont('Arial','',11);
        $this->Write(0, '            ' . $detail_header['RES_FIRSTNAME'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '            ' . $detail_header['ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);

        $block = $detail_header['RES_BLOCK'];
        $floor = $detail_header['RES_FLOOR'];
        $unit = $detail_header['RES_UNIT'];

        $K = array(125, 50);

        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS2'], 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);

        if ($detail_header['RES_CODE'] == 'SHOP') {
            $this->Cell($K[1], 5, '麗城花園第三期商場', 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'C', false);
        }

        $this->SetFont('cid0jp', '', 11);
        $this->Ln(5);


        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS3'], 0, 0, 'L', false);

        if ($detail_header['RES_CODE'] == 'SHOP') {
            $this->Cell($K[1], 5, 'Belvedere Garden Phase 3 Shopping Mall', 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, 'Flat ' . $unit . ', ' . $floor . '/F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'C', false);
        }
        $this->Ln();
        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS4'], 0, 0, 'L', false);



        $w = array(120, 40, 25);


        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln(8);

        $this->SetTextColor(0);
        $this->SetLineWidth('');
        // $ttloverdue1 = 0.00;
        $ttloverdue = 0.00;
        $line = 0;
        $i = count($data_detail);
        if (count($data_detail) > 6) {

            foreach ($data_detail as $key => $val) {
                $ttloverdue = $ttloverdue + $val['AMT'];
            }

            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
            $this->Cell($w[1], 6, "前期結欠( $i )張單,請看附件", 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
            $this->Ln(5);
            //$this->Ln(5);

            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '', 0, 0, 'L', false);
            $this->Cell($w[1], 6, "Please see attachment", 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '', 0, 0, 'R', false);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
        } else {
            foreach ($data_detail as $key => $val) {
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
                $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);
                $ttloverdue = $ttloverdue + $val['AMT'];
                $line = $line + 1;
                $this->Ln(5);
            }

            for ($i = 1; $i <= (6 - $line); $i++) {
                $this->Cell(18, 6, '', 0, 0, 'R', false);
                $this->Ln(5);
            }
        }
        $this->Ln(2);

        $this->Ln();
        $time = strtotime($detail_header['INDATE']);
        $month = date("m", $time);
        $year = date("Y", $time);

        $date1 = $year . '-' . $month . '-01';

        $tmp2 = str_replace('-', '/', $date1);
        $tomorrow1 = date('Y-m-d', strtotime($tmp2 . "+1 months"));


        $tomorrow2 = date('Y-m-d', strtotime($tomorrow1 . "-1 days"));
        // echo $tomorrow2;
        $this->Cell(16, 6, '', 0, 0, 'L', false);
        $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
        //$this->Cell($w[1], 6,        date_format($date, "Y/m/d") . ' - 30/11/2016', 0, 0, 'C', false);
//
        $ttlamt1 = 0.00;
//
        $this->Cell($w[1], 6, $date1 . ' to ' . $tomorrow2, 0, 0, 'C', false);
        $this->Cell($w[2] + 5, 6, '$' . number_format($detail_header['AMT'], 2), 0, 0, 'R', false);
        $this->Ln();
        //$this->Ln(6);
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
//
//
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln(6);
//
//
        $this->SetFont('cid0jp', '', 11);
//
//
        $offset1 = 30;
//

        if ($detail_header['RES_CODE'] == 'SHOP') {
            $this->Cell(5, 5, '', 0, 0, 'L', false);
            $this->Cell($w[0] + $w[1] - 5, 5, '麗城花園第三期商場', 0, 0, 'L', false);
        } else {
            $this->Cell(5, 5, '', 0, 0, 'L', false);
            $this->Cell($w[0] + $w[1] - 5, 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
        }

        //$this->Cell($w[0] + $w[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
        $this->Cell($w[2], 5 - 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();

        if ($detail_header['RES_CODE'] == 'SHOP') {
            $this->Cell(5, 5, '', 0, 0, 'L', false);
            $this->Cell($w[0] + $w[1] - 5, 5, 'Belvedere Garden Phase 3 Shopping Mall', 0, 0, 'L', false);
        } else {
            $this->Cell(5, 5, '', 0, 0, 'L', false);
            $this->Cell($w[0] + $w[1] - 5, 5, 'Flat ' . $unit . ', ' . $floor . '/F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'L', false);
        }

        //$this->Cell($w[0] + $w[1], 5, 'FLAT ' . $unit . ',' . $floor . ' /F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'L', false);
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
        $this->SetFont('helvetica', '', 8);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->write1DBarcode($detail_header['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
    }

    public function DebitnoteCarpark($detail_header, $data_detail) {


        $this->SetFont('helvetica', '', 8);

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
        //    $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        //********************************************
        $this->Ln(8);   /// new adjest   ok 
//******************************************** 

        $date = date_create($detail_header['INDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);



        $this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);

//********************************************        
        $this->Ln(1);   /// new adjest   ok 
//********************************************        
        //     $this->SetFont('Arial','',11);
        $this->Write(0, '            ' . $detail_header['RES_FIRSTNAME'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '            ' . $detail_header['ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);

        //   $block = $detail_header['RES_BLOCK'];
        //   $floor = $detail_header['RES_FLOOR'];
        ///  $unit = $detail_header['RES_UNIT'];

        $basement1 = substr($detail_header['RES_CODE'], 0, 2);
        $basement2 = substr($detail_header['RES_CODE'], 1, 1);
        $basementno = substr($detail_header['RES_CODE'], 3, 3);

//        if ($detail_detail['RES_CODE'] == 'B1-CAR' || $detail_detail['RES_CODE'] == 'B2-CAR') {
//            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層車位", 0, 0, 'C', false);
//        } else {
//            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層$basementno 號車位", 0, 0, 'C', false);
//        }





        $K = array(125, 50);

        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS2'], 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);

        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層車位", 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層$basementno 號車位", 0, 0, 'C', false);
        }

        $this->SetFont('cid0jp', '', 11);
        $this->Ln(5);


        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS3'], 0, 0, 'L', false);
        $this->SetFont('cid0jp', '', 7);
        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
            $this->Cell($K[1], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
        } else {
            $this->Cell($K[1], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
        }
        $this->SetFont('cid0jp', '', 11);
        $this->Ln();
        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS4'], 0, 0, 'L', false);



        $w = array(120, 40, 25);


        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln(8);

        $this->SetTextColor(0);
        $this->SetLineWidth('');

        $ttloverdue = 0.00;
        $line = 0;
//        foreach ($data_detail as $key => $val) {
//            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
//            $this->Cell($w[0] - 20, 6, '管理費 ', 0, 0, 'L', false);
//            $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
//            $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);
//            $ttloverdue = $ttloverdue + $val['AMT'];
//            $line = $line + 1;
//            $this->Ln(5);
//        }
//
//        for ($i = 1; $i <= (6 - $line); $i++) {
//            $this->Cell(18, 6, '', 0, 0, 'R', false);
//            $this->Ln(5);
//        }

        $i = count($data_detail);

        if (count($data_detail) > 6) {

            foreach ($data_detail as $key => $val) {
                $ttloverdue = $ttloverdue + $val['AMT'];
            }

            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
            $this->Cell($w[1], 6, "前期結欠( $i )張單,請看附件", 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
            $this->Ln(5);
            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '', 0, 0, 'L', false);
            $this->Cell($w[1], 6, "Please see attachment", 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '', 0, 0, 'R', false);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
            $this->Ln(5);
        } else {
            foreach ($data_detail as $key => $val) {
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
                $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);
                $ttloverdue = $ttloverdue + $val['AMT'];
                $line = $line + 1;
                $this->Ln(5);
            }

            for ($i = 1; $i <= (6 - $line); $i++) {
                $this->Cell(18, 6, '', 0, 0, 'R', false);
                $this->Ln(5);
            }
        }


        $this->Ln(2);

        $this->Ln();
        $time = strtotime($detail_header['INDATE']);
        $month = date("m", $time);
        $year = date("Y", $time);

        $date1 = $year . '-' . $month . '-01';

        $tmp2 = str_replace('-', '/', $date1);
        $tomorrow1 = date('Y-m-d', strtotime($tmp2 . "+1 months"));


        $tomorrow2 = date('Y-m-d', strtotime($tomorrow1 . "-1 days"));
        // echo $tomorrow2;
        $this->Cell(16, 6, '', 0, 0, 'L', false);
        $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
        //$this->Cell($w[1], 6,        date_format($date, "Y/m/d") . ' - 30/11/2016', 0, 0, 'C', false);
//
        $ttlamt1 = 0.00;
//
        $this->Cell($w[1], 6, $date1 . ' to ' . $tomorrow2, 0, 0, 'C', false);
        $this->Cell($w[2] + 5, 6, '$' . number_format($detail_header['AMT'], 2), 0, 0, 'R', false);
        $this->Ln();
        //$this->Ln(6);
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
        $this->Ln(6);
        $this->SetFont('cid0jp', '', 11);
        $offset1 = 30;
//
//                $this->SetFont('cid0jp', '', 7);
//        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
//            $this->Cell($K[1], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
//        } else {
//            $this->Cell($K[1], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
//        }
//        $this->SetFont('cid0jp', '', 11);
//        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
//            $this->Cell($w[0] + $w[1], 5, '麗城花園第三期商場', 0, 0, 'L', false);
//        } else {
//            $this->Cell($w[0] + $w[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
//        }

        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
            $this->Cell($w[0] + $w[1], 5, "麗城花園第三期$basement1 層車位", 0, 0, 'L', false);
        } else {
            $this->Cell($w[0] + $w[1], 5, "麗城花園第三期$basement1 層$basementno 號車位", 0, 0, 'L', false);
        }

        //$this->Cell($w[0] + $w[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
        $this->Cell($w[2], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();
        $this->SetFont('cid0jp', '', 8);
        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
            $this->Cell($w[0] + $w[1], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'L', false);   /// english
        } else {
            $this->Cell($w[0] + $w[1], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'L', false);   /// english
        }
        $this->SetFont('cid0jp', '', 11);
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
        $this->SetFont('helvetica', '', 8);
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->write1DBarcode($detail_header['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
    }

//    public function Paymentreceipt($detail_detail, $detail_detail2, $detail_detail3) {
//
//        $cellline = 0;
//        $cellhight = 0;
//
//        $this->SetFont('', 'B');
//        $this->Write(0, '管理費繳付記錄', '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, '--正式收據 / Official Payment Receipt' . '        序號S/N:R' . $detail_detail['PAYMENTNO'], '', 0, 'L', true, 0, false, false, 0);
//
//        // Colors, line width and bold font
//        $this->SetFillColor(0, 150, 250);
//        $this->SetTextColor(0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('');
//        $this->Ln();
//
//        $this->Cell(120, 7, '1.物業資料 Property Information', 1, 0, 'L', 1);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '繳費日期/Payment Receive on', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, $detail_detail['INDATE'], $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '屋苑/Property', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, $detail_detail['BUILDING'], $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '物業詳細資料/Property Detail', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, 'CODE ' . $detail_detail['CODE'] . ',UNIT ' . $detail_detail['UNIT'] . ',BLOCK ', $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '住戶姓名 / Occupant', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, strtoupper($detail_detail['LASTNAME']) . ', ' . $detail_detail['FIRSTNAME'], $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '經手人 / Handled by', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '繳付當案編號 / Payment Reference No.', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '收據當案編號 / Receipt Reference No.', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, '', $cellline, 0, 'L', 0);
//        $this->Ln();
//
//
//        // Colors, line width and bold font
//        $this->SetFillColor(0, 150, 250);
//        $this->SetTextColor(0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('');
//        $this->Ln();
//        $this->Cell(120, 7, '2.管理費繳付記錄 Payment Record(s)', 1, 0, 'L', 1);
//        $this->Ln();
//
//        // Colors, line width and bold font
//        $this->SetFillColor(0, 150, 250);
//        $this->SetTextColor(0);
//        //$this->SetDrawColor(0, 0, 0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('', 'B');
//        // Header
//        // $detail_header = array('PARTICULARS', 'PERIOD', 'AMOUNT');
//
//        $this->Ln();
//        //  $w = array(40, 40, 30);
//        //  $num_headers = count($detail_header);
//        //  for ($i = 0; $i < $num_headers; ++$i) {
//        $this->Cell(20, 7, '管理費月份', 1, 0, 'C', 1);
//        $this->Cell(30, 7, '結單', 1, 0, 'C', 1);
//        $this->Cell(30, 7, '備註', 1, 0, 'C', 1);
//        $this->Cell(20, 7, '應付金額', 1, 0, 'C', 1);
//        $this->Cell(20, 7, '繳付金額', 1, 0, 'C', 1);
//        $this->Ln();
//
//        // Color and font restoration
//        $this->SetFillColor(224, 235, 255);
//        $this->SetTextColor(0);
//        $this->SetFont('');
//
//        // Data
//        $fill = 0;
//
//        foreach ($detail_detail2 as $row) {
//            $this->Cell(20, 6, $row['MDATE'], 'LR', 0, 'C', $fill);
//            $this->Cell(30, 6, $row['CODE'], 'LR', 0, 'C', $fill);
//            $this->Cell(30, 6, '', 'LR', 0, 'C', $fill);
//            $this->Cell(20, 6, '', 'LR', 0, 'C', $fill);
//            $this->Cell(20, 6, number_format($row['AMT'], 2), 'LR', 0, 'R', $fill);
//            $this->Ln();
//        }
//
//
//
//        //$fill = !$fill;
//        //  }
//        $this->Cell(120, 0, '', 'T');
//        $this->Ln();
//
//        $this->Cell(100, $cellhight, '應付脹項 / Total Due:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, number_format($detail_detail3['P_OUTSTAND'], 2), $cellline, 0, 'R', 0);
//        $this->Ln();
//
//        $this->Cell(100, $cellhight, '繳付金額 / Amount Paid:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, number_format($detail_detail['AMT'], 2), $cellline, 0, 'R', 0);
//        $this->Ln();
//        $this->Cell(100, $cellhight, '繳付方法 / Paid by:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, $detail_detail['PAYTYPE'] === '0' ? 'Cheque' : 'Cash/Auotpay', $cellline, 0, 'R', 0);
//
//        $this->Ln();
//        $this->Cell(120, $cellhight, $detail_detail['CHEQNO'], $cellline, 0, 'R', 0);
//        $this->Ln();
//        $this->Ln();
//        $this->Cell(120, $cellhight, '*** 多謝, 此收據 *** Thank You. End of Receipt ***', $cellline, 0, 'C', 0);
//    }
    // Colored table
//    public function outstanding_by_resident($header, $data) {
//        // Colors, line width and bold font
//        $this->SetFillColor(255, 0, 0);
//        $this->SetTextColor(255);
//        $this->SetDrawColor(128, 0, 0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('', 'B');
//        // Header
//        $w = array(10, 10, 10, 10, 30, 30, 30, 30);
//        $num_headers = count($header);
//        for ($i = 0; $i < $num_headers; ++$i) {
//            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
//        }
//        $this->Ln();
//        // Color and font restoration
//        $this->SetFillColor(224, 235, 255);
//        $this->SetTextColor(0);
//        $this->SetFont('');
//        // Data
//        $fill = 0.00;
//        foreach ($data as $row) {
//            $this->Cell($w[0], 6, $row['CODE'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[1], 6, $row['BLOCK'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[2], 6, $row['UNIT'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[3], 6, $row['FLOOR'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[4], 6, $row['FIRSTNAME'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[5], 6, $row['LASTNAME'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[6], 6, $row['TEL'], 'LR', 0, 'C', $fill);
//            $this->Cell($w[7], 6, $row['P_OUTSTAND'], 'LR', 0, 'R', $fill);
//            $amt = $amt + $row['P_OUTSTAND'];
//
//            $this->Ln();
//            $fill = !$fill;
//        }
//
//
//        $this->Cell($w[0], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[1], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[2], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[3], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[4], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[5], 6, '', 'LR', 0, 'C', $fill);
//        $this->Cell($w[6], 6, 'Total Amount', 1, 0, 'R', $fill);
//        $this->Cell($w[7], 6, $amt, 1, 0, 'R', 1);
//
//
//        $this->Ln();
//
//
//        $this->Cell(array_sum($w), 0, '', 'T');
//    }
}
