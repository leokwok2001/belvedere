<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_genmfee_attach extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function DrawHeader2($detail_header,  $no_page, $total_page) {
        $this->SetFont('cid0jp', '', 11);
        $this->Write(0, 'Page ' . " $no_page / $total_page ", '', 0, 'R', true, 0, false, false, 0);
        $date = date_create($detail_header['INDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        $this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);
//********************************************        
        $this->Ln(1);   /// new adjest   ok 
//********************************************        
        //     $this->SetFont('Arial','',11);
        $this->Write(0, '            ' . $detail_header['RES_FIRSTNAME'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '            ' . $detail_header['ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);
        $basement1 = substr($detail_header['RES_CODE'], 0, 2);
        $basement2 = substr($detail_header['RES_CODE'], 1, 1);
        $basementno = substr($detail_header['RES_CODE'], 3, 3);
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

        $this->Ln(8);
        $this->Cell(16, 6, ' ', 0, 0, 'C', false);
        $this->Cell(170, 6, '管理費單附件 Attachment ', 1, 0, 'C', false);
        $this->Ln(8);
    }

    public function DrawHeader1($detail_header,  $no_page, $total_page) {
        $this->SetFont('cid0jp', '', 11);

        $this->Write(0, 'Page ' . " $no_page / $total_page ", '', 0, 'R', true, 0, false, false, 0);
        $date = date_create($detail_header['INDATE']);
        $this->Write(0, '發單日期' . ' : ' . date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        $this->Write(0, '通知書編號' . ' :     ' . $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);
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

        $this->Ln(8);
        $this->Cell(16, 6, ' ', 0, 0, 'C', false);
        $this->Cell(170, 6, '管理費單附件 Attachment', 1, 0, 'C', false);
        $this->Ln(8);
    }

    public function Debitnote_attach($detail_header, $data_detail) {
        $w = array(120, 40, 25);
        $x = 0;

        foreach ($data_detail as $key => $val) {
            $x = $x + 1;
        }

        $total_page = ceil($x / 42);
        $no_page = 1;
        $this->DrawHeader1($detail_header, $no_page, $total_page);
        $this->SetTextColor(0);
        $this->SetLineWidth('');
        $ttloverdue = 0.00;

        foreach ($data_detail as $key => $val) {
            $ttloverdue = $ttloverdue + $val['AMT'];
            $num_pages = $this->getNumPages();
            $this->startTransaction();

            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
            $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);
            $this->Ln(5);

            if ($key == ($x - 1)) {
                $this->Ln();
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, ' ', 0, 0, 'L', false);
                $this->Cell($w[1], 6, '前單結餘總金額 Amount', 0, 0, 'R', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
            }


            if ($num_pages < $this->getNumPages()) {
                $this->rollbackTransaction(true);
                $this->AddPage();
                $no_page = $no_page + 1;
                $this->DrawHeader1($detail_header, $no_page, $total_page);
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
                $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);
                $this->Ln(5);

                if ($key == ($x - 1)) {
                    $this->Ln();
                    $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                    $this->Cell($w[0] - 20, 6, ' ', 0, 0, 'L', false);
                    $this->Cell($w[1], 6, '前單結餘總金額 Amount', 0, 0, 'R', false);
                    $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
                }
            } else {
                $this->commitTransaction();
            }
        }
    }

    public function DebitnoteCarpark_attach($detail_header, $data_detail) {
//        $this->SetFont('cid0jp', '', 11);
//        $date = date_create($detail_header['INDATE']);
//        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
//        $this->Write(0, $detail_header['CODE'], '', 0, 'R', true, 0, false, false, 0);
////********************************************        
//        $this->Ln(1);   /// new adjest   ok 
////********************************************        
//        //     $this->SetFont('Arial','',11);
//        $this->Write(0, '            ' . $detail_header['RES_FIRSTNAME'], '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, '            ' . $detail_header['ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);
//        $basement1 = substr($detail_header['RES_CODE'], 0, 2);
//        $basement2 = substr($detail_header['RES_CODE'], 1, 1);
//        $basementno = substr($detail_header['RES_CODE'], 3, 3);
//        $K = array(125, 50);
//        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS2'], 0, 0, 'L', false);
//        $this->SetFont('cid0jp', '', 14);
//        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
//            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層車位", 0, 0, 'C', false);
//        } else {
//            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層$basementno 號車位", 0, 0, 'C', false);
//        }
//        $this->SetFont('cid0jp', '', 11);
//        $this->Ln(5);
//        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS3'], 0, 0, 'L', false);
//        $this->SetFont('cid0jp', '', 7);
//        if ($detail_header['RES_CODE'] == 'B1-CAR' || $detail_header['RES_CODE'] == 'B2-CAR') {
//            $this->Cell($K[1], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
//        } else {
//            $this->Cell($K[1], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
//        }
//        $this->SetFont('cid0jp', '', 11);
//        $this->Ln();
//        $this->Cell($K[0], 5, '            ' . $detail_header['ADDRESS4'], 0, 0, 'L', false);
//        $w = array(120, 40, 25);
//        $this->Ln(8);

        $w = array(120, 40, 25);
        $x = 0;
        foreach ($data_detail as $key => $val) {
            $x = $x + 1;
        }


        $total_page = ceil($x / 41);
        $no_page = 1;
        $this->DrawHeader2($detail_header, $no_page, $total_page);


        $this->SetTextColor(0);
        $this->SetLineWidth('');
        $ttloverdue = 0.00;

        foreach ($data_detail as $key => $val) {
            $ttloverdue = $ttloverdue + $val['AMT'];

            $num_pages = $this->getNumPages();
            $this->startTransaction();

            $this->Cell(16, 6, ' ', 0, 0, 'C', false);
            $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
            $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
            $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);

            $this->Ln(5);

            if ($key == ($x - 1)) {
                $this->Ln();
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, ' ', 0, 0, 'L', false);
                $this->Cell($w[1], 6, '前單結餘總金額 Amount', 0, 0, 'R', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
            }


            if ($num_pages < $this->getNumPages()) {
                $this->rollbackTransaction(true);
                $this->AddPage();
                $no_page = $no_page + 1;
                //Draw the header.
                //   $this->DrawHeader1($detail_header, $data_detail, $no_page);
                $this->DrawHeader2($detail_header, $no_page, $total_page);
                //Re-do the row.
                $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                $this->Cell($w[0] - 20, 6, '管理費 Management Fee', 0, 0, 'L', false);
                $this->Cell($w[1], 6, $val['FROMDATE'] . " to " . $val['TODATE'], 0, 0, 'C', false);
                $this->Cell($w[2] + 5, 6, '$' . number_format($val['AMT'], 2), 0, 0, 'R', false);

                $this->Ln(5);

                if ($key == ($x - 1)) {
                    $this->Ln();
                    $this->Cell(16, 6, ' ', 0, 0, 'C', false);
                    $this->Cell($w[0] - 20, 6, ' ', 0, 0, 'L', false);
                    $this->Cell($w[1], 6, '前單結餘總金額 Amount', 0, 0, 'R', false);
                    $this->Cell($w[2] + 5, 6, '$' . number_format($ttloverdue, 2), 0, 0, 'R', false);
                }
            } else {
                //Otherwise we are fine with this row, discard undo history.

                $this->commitTransaction();
            }
        }
    }

}
