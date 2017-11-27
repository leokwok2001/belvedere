<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_genmanfee extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    // Colored table
    public function DebitnoteCRS($detail_detail) {

        $this->SetFont('helvetica', '', 8);
//繳費期限:2016年11月16日至2017年2月28日，逾期需增繳附加費
        $word1 = '繳費期限:<u>2016</u>年<u>12</u>月<u>1</u>日 至 <u>2017</u>年<u>2</u>月<u>28</u>日，逾期需增繳附加費 。';
        $word2 = 'Payment Period : <u>1</u>-<u>12</u>-<u>2016</u> to <u>28</u>-<u>2</u>-<u>2017</u>, additional fee will be charged if overdue.';

        $word3 = '<u>2017</u>年<u>3</u>月<u>1</u>日至<u>2017</u>年<u>4</u>月<u>30</u>日繳交，加 5 %附加費';
        $word4 = 'Additional fee 5% will be charged if you pay on <u>1</u>-<u>3</u>-<u>2017</u> to <u>30</u>-<u>4</u>-<u>2017</u>';

        $word5 = '<u>2017</u>年<u>5</u>月<u>1</u>日至<u>2017</u>年<u>6</u>月<u>30</u>日繳交，加 10%附加費';
        $word6 = 'Additional fee 10% will be charged if you pay on <u>1</u>-<u>5</u>-<u>2017</u> to <u>30</u>-<u>6</u>-<u>2017</u>';

        $word7 = '*** <u>2017</u>年<u>6</u>月<u>30</u>日仍未繳交，將會採取法律行動。***';
        $word8 = '*** Necessary legal action will be initiated after <u>30</u>-<u>6</u>-<u>2017</u>. ***';
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

        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');

        $this->SetFont('cid0jp', '', 11);

        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        //    $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        //********************************************
        $this->Ln(3);   /// new adjest   ok 
//******************************************** 

        $date = date_create($detail_detail['BILLDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);



        $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);

//********************************************        
        $this->Ln(1);   /// new adjest   ok 
//********************************************        
        //     $this->SetFont('Arial','',11);
        $this->Write(0, '            ' . $detail_detail['OWNER_NAME1'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '            ' . $detail_detail['OWNER_ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);

        $block = $detail_detail['BLOCK'];
        $floor = $detail_detail['FLOOR'];
        $unit = $detail_detail['UNIT'];

        $K = array(125, 50);

        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS2'], 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);

        if ($detail_detail['RES_CODE'] == 'SHOP') {
            $this->Cell($K[1], 5, '麗城花園第三期商場', 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, '麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'C', false);
        }

        $this->SetFont('cid0jp', '', 11);
        $this->Ln();


        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS3'], 0, 0, 'L', false);

        if ($detail_detail['RES_CODE'] == 'SHOP') {
            $this->Cell($K[1], 5, 'Belvedere Garden Phase 3 Shopping Mall', 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, 'Flat ' . $unit . ', ' . $floor . '/F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'C', false);
        }
        $this->Ln();
        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS4'], 0, 0, 'L', false);

        //$w = array(80, 30, 30, 30, 25); ORG
//$w = array(80, 26, 26, 30, 33);

        if ($detail_detail['RES_CODE'] == 'SHOP') {
            $w = array(81, 28, 29, 28, 29);
        } ELSE {
            $w = array(80, 30, 30, 30, 25);
        }

        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->Ln(4);


        $this->SetTextColor(0);
        $this->SetLineWidth('');

        $this->Cell($w[0], 6, '', 0, 0, 'L', false);
        $this->Cell($w[1], 6, $detail_detail['EACH_SHARE'], 0, 0, 'C', false);
        $this->Cell($w[2], 6, number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'C', false);
        $this->Cell($w[3], 6, number_format($detail_detail['EACH_SHARE'], 0) . ' x ' . number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'L', false);
        $this->Cell($w[4], 6, 'HK$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);

        $this->Ln();
        $this->Ln();
        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[4], 7, 'HK$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
        $this->Ln(8);
        $this->SetFont('cid0jp', '', 9);

//        $this->Ln(5);
//        $this->Cell($ln1, 7, '', 0, 0, 'L', false);
//        $this->Cell($ln1+$ln2, 7, $word1, 0, 0, 'L', false);
//        $this->Ln(4);
//        $this->Cell($ln1, 7, '', 0, 0, 'L', false);
//        $this->Cell($ln1+$ln2, 7, $word2, 0, 0, 'L', false);

        $y = $this->getY();
        $this->writeHTMLCell(6, '', '', $y, '', 0, 0, 0, true, 'J', true);   // space 
        $this->writeHTMLCell(180, '', '', '', $word1, 0, 0, 0, true, 'J', true);
        $this->Ln();
        $y = $this->getY();
        $this->writeHTMLCell(6, '', '', $y, '', 0, 0, 0, true, 'J', true);   // space 
        $this->writeHTMLCell(180, '', '', '', $word2, 0, 0, 0, true, 'J', true);

        $this->Ln();
        $this->Ln();
        $this->Ln();


        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word3, 0, 0, 0, true, 'R', true);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(195, '', '', $y, 'HKD$' . number_format($detail_detail['AMT'] * 1.05, 2), 0, 0, 0, true, 'R', true);
        $this->Ln();
        $this->SetFont('cid0jp', '', 9);
        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word4, 0, 0, 0, true, 'R', true);
        $this->Ln(6);

        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word5, 0, 0, 0, true, 'R', true);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(195, '', '', $y, 'HKD$' . number_format($detail_detail['AMT'] * 1.10, 2), 0, 0, 0, true, 'R', true);
        $this->Ln();
        $this->SetFont('cid0jp', '', 9);
        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word6, 0, 0, 0, true, 'R', true);

        $this->Ln(6);

        $y = $this->getY();

        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(200, '', '', $y, $word7, 0, 0, 0, true, 'C', true);
        $this->Ln();
        $y = $this->getY();
        $this->SetFont('cid0jp', '', 11);
        $this->writeHTMLCell(200, '', '', $y, $word8, 0, 0, 0, true, 'C', true);


        for ($i = 0; $i <= 14; $i++) {

            $this->Ln();
        }
        //     $this->Ln(6);

        $this->Ln(5);

//        $w = array(145, 50);
//        $this->Cell($w[0], 5, '   麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室', 0, 0, 'L', false);
//        $date = date_create($detail_detail['BILLDATE']);
//        $this->Cell($w[1], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
//        $this->Ln();
//        $this->Cell($w[0], 5, '   Flat ' . $unit . ',' . $floor . ' /F Block ' . $block . ', Belvedere Garden Phase 3', 0, 0, 'L', false);
//        $this->Cell($w[1], 5, $detail_detail['CODE'], 0, 0, 'R', false);
//        $this->Ln();
//        $this->Cell($w[0], 5, '', 0, 0, 'L', false);
//        $this->SetFont('cid0jp', 'B', 11, '', 'false');
//        $this->Cell($w[1], 5, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
//        $this->SetFont('cid0jp', '', 11);
        $w = array(145, 50);
        $this->Cell($w[0], 5, "  ", 0, 0, 'L', false);
        $date = date_create($detail_detail['BILLDATE']);
        $this->Cell($w[1], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();


        //'   麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室';


        if ($detail_detail['RES_CODE'] == 'SHOP') {

            $this->Cell($w[0], 5, "  麗城花園第三期商場", 0, 0, 'L', false);
        } else {

            $this->Cell($w[0], 5, "  麗城花園第三期第  $block  座  $floor  樓  $unit  室 ", 0, 0, 'L', false);
        }
        $this->Cell($w[1], 5, $detail_detail['CODE'], 0, 0, 'R', false);
        $this->Ln();

        $this->SetFont('cid0jp', '', 9);

        if ($detail_detail['RES_CODE'] == 'SHOP') {
            $this->Cell($w[0], 5, "  Belvedere Garden Phase 3 Shopping Mall", 0, 0, 'L', false);
        } else {
            $this->Cell($w[0], 5, "  Flat  $unit, " . $floor . "/F Block   $block   Belvedere Garden Phase 3", 0, 0, 'L', false);
        }

        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[1], 5, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
        $this->SetFont('cid0jp', '', 11);




        $this->SetFont('helvetica', '', 8);

        $this->Ln();
        $this->Ln();
        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
    }

    public function DebitnoteCRS_CARPARK($detail_detail) {



        $this->SetFont('helvetica', '', 8);
//繳費期限:2016年11月16日至2017年2月28日，逾期需增繳附加費
        $word1 = '繳費期限:<u>2016</u>年<u>12</u>月<u>1</u>日 至 <u>2017</u>年<u>2</u>月<u>28</u>日，逾期需增繳附加費 。';
        $word2 = 'Payment Period : <u>1</u>-<u>12</u>-<u>2016</u> to <u>28</u>-<u>2</u>-<u>2017</u>, additional fee will be charged if overdue.';

        $word3 = '<u>2017</u>年<u>3</u>月<u>1</u>日至<u>2017</u>年<u>4</u>月<u>30</u>日繳交，加 5 %附加費';
        $word4 = 'Additional fee 5% will be charged if you pay on <u>1</u>-<u>3</u>-<u>2017</u> to <u>30</u>-<u>4</u>-<u>2017</u>';

        $word5 = '<u>2017</u>年<u>5</u>月<u>1</u>日至<u>2017</u>年<u>6</u>月<u>30</u>日繳交，加 10%附加費';
        $word6 = 'Additional fee 10% will be charged if you pay on <u>1</u>-<u>5</u>-<u>2017</u> to <u>30</u>-<u>6</u>-<u>2017</u>';

        $word7 = '*** <u>2017</u>年<u>6</u>月<u>30</u>日仍未繳交，將會採取法律行動。***';
        $word8 = '*** Necessary legal action will be initiated after <u>30</u>-<u>6</u>-<u>2017</u>. ***';
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

        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');

        $this->SetFont('cid0jp', '', 11);

        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        //     $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);  original
//********************************************
        $this->Ln(3);   /// new adjest   ok 的s
//********************************************

        $date = date_create($detail_detail['BILLDATE']);
        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);

//********************************************        
        $this->Ln(2);   /// new adjest   ok 的s
//********************************************        
        //     $this->SetFont('Arial','',11);
        $this->Write(0, '            ' . $detail_detail['OWNER_NAME1'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '            ' . $detail_detail['OWNER_ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);

//        $block = $detail_detail['BLOCK'];
//        $floor = $detail_detail['FLOOR'];
//        $unit = $detail_detail['UNIT'];

        $K = array(125, 50);
        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS2'], 0, 0, 'L', false);



        $basement1 = substr($detail_detail['RES_CODE'], 0, 2);
        $basement2 = substr($detail_detail['RES_CODE'], 1, 1);
        $basementno = substr($detail_detail['RES_CODE'], 3, 3);
        // $this->Cell($w[0], 5, "麗城花園第三期 $basement1 層 $basementno 號車位", 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);


        if ($detail_detail['RES_CODE'] == 'B1-CAR' || $detail_detail['RES_CODE'] == 'B2-CAR') {
            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層車位", 0, 0, 'C', false);
        } else {
            $this->Cell($K[1], 5, "麗城花園第三期$basement1 層$basementno 號車位", 0, 0, 'C', false);
        }
        $this->SetFont('cid0jp', '', 11);
        $this->Ln();

        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS3'], 0, 0, 'L', false);
        $this->SetFont('cid0jp', '', 7);

        if ($detail_detail['RES_CODE'] == 'B1-CAR' || $detail_detail['RES_CODE'] == 'B2-CAR') {
            $this->Cell($K[1], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
        } else {
            $this->Cell($K[1], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'C', false);   /// english
        }

//
        //
        $this->Ln();   //adj
        $this->Cell($K[0], 5, '            ' . $detail_detail['OWNER_ADDRESS4'], 0, 0, 'L', false);
        //$this->Cell($w[0], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'L', false);
        $this->SetFont('cid0jp', '', 11);
        $w = array(80, 30, 30, 30, 25);



        //       $this->Ln();   adj
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->Ln(4);


        $this->SetTextColor(0);
        $this->SetLineWidth('');

        $this->Cell($w[0], 6, '', 0, 0, 'L', false);
        $this->Cell($w[1], 6, $detail_detail['EACH_SHARE'], 0, 0, 'C', false);
        $this->Cell($w[2], 6, number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'C', false);
        $this->Cell($w[3], 6, number_format($detail_detail['EACH_SHARE'], 0) . ' x ' . number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'L', false);
        $this->Cell($w[4], 6, 'HK$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);

        $this->Ln();
        $this->Ln();
        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[4], 7, 'HK$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
        $this->Ln(8);
        $this->SetFont('cid0jp', '', 9);

//        $this->Ln(5);
//        $this->Cell($ln1, 7, '', 0, 0, 'L', false);
//        $this->Cell($ln1+$ln2, 7, $word1, 0, 0, 'L', false);
//        $this->Ln(4);
//        $this->Cell($ln1, 7, '', 0, 0, 'L', false);
//        $this->Cell($ln1+$ln2, 7, $word2, 0, 0, 'L', false);

        $y = $this->getY();
        $this->writeHTMLCell(6, '', '', $y, '', 0, 0, 0, true, 'J', true);   // space 
        $this->writeHTMLCell(180, '', '', '', $word1, 0, 0, 0, true, 'J', true);
        $this->Ln();
        $y = $this->getY();
        $this->writeHTMLCell(6, '', '', $y, '', 0, 0, 0, true, 'J', true);   // space 
        $this->writeHTMLCell(180, '', '', '', $word2, 0, 0, 0, true, 'J', true);

        $this->Ln();
        $this->Ln();
        $this->Ln();


        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word3, 0, 0, 0, true, 'R', true);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(195, '', '', $y, 'HKD$' . number_format($detail_detail['AMT'] * 1.05, 2), 0, 0, 0, true, 'R', true);
        $this->Ln();
        $this->SetFont('cid0jp', '', 9);
        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word4, 0, 0, 0, true, 'R', true);
        //   $this->Ln(8);
        $this->Ln(6);
        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word5, 0, 0, 0, true, 'R', true);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(195, '', '', $y, 'HKD$' . number_format($detail_detail['AMT'] * 1.10, 2), 0, 0, 0, true, 'R', true);
        $this->Ln();
        $this->SetFont('cid0jp', '', 9);
        $y = $this->getY();
        $this->writeHTMLCell(150, '', '', $y, $word6, 0, 0, 0, true, 'R', true);

        $this->Ln(6);

        $y = $this->getY();

        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->writeHTMLCell(200, '', '', $y, $word7, 0, 0, 0, true, 'C', true);
        $this->Ln();
        $y = $this->getY();
        $this->SetFont('cid0jp', '', 11);
        $this->writeHTMLCell(200, '', '', $y, $word8, 0, 0, 0, true, 'C', true);


        for ($i = 0; $i <= 14; $i++) {

            $this->Ln();
        }
        $this->Ln(4);

//*************************  Payment Slip **************************
        $w = array(145, 50);
        $this->Cell($w[0], 5, "  ", 0, 0, 'L', false);
        $date = date_create($detail_detail['BILLDATE']);
        $this->Cell($w[1], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();


        //'   麗城花園第三期第' . $block . '座' . $floor . '樓' . $unit . '室';


        if ($detail_detail['RES_CODE'] == 'B1-CAR' || $detail_detail['RES_CODE'] == 'B2-CAR') {
            $this->Cell($w[0], 5, "麗城花園第三期 $basement1 層", 0, 0, 'L', false);
        } else {
            $this->Cell($w[0], 5, "麗城花園第三期 $basement1 層 $basementno 號車位", 0, 0, 'L', false);
        }

        //$this->Cell($w[0], 5, "麗城花園第三期 $basement1 層 $basementno 號車位", 0, 0, 'L', false);
        $this->Cell($w[1], 5, $detail_detail['CODE'], 0, 0, 'R', false);
        $this->Ln();

        $this->SetFont('cid0jp', '', 9);
        
                if ($detail_detail['RES_CODE'] == 'B1-CAR' || $detail_detail['RES_CODE'] == 'B2-CAR') {
        $this->Cell($w[0], 5, "Car Parking Space  on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'L', false);
                } else {
                    $this->Cell($w[0], 5, "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3", 0, 0, 'L', false);
                    
                }
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[1], 5, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
        $this->SetFont('cid0jp', '', 11);




        $this->SetFont('helvetica', '', 8);

        $this->Ln();
        $this->Ln();
        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
    }

    // Colored table
//    public function DebitnoteCRS_CARPARK($detail_detail) {
//
//        $this->SetFont('helvetica', '', 8);
//
//// define barcode style
//        $style = array(
//            'position' => 'R',
//            'align' => 'C',
//            'stretch' => false,
//            'fitwidth' => true,
//            'cellfitalign' => '',
//            'border' => true,
//            'hpadding' => 'auto',
//            'vpadding' => 'auto',
//            'fgcolor' => array(0, 0, 0),
//            'bgcolor' => false, //array(255,255,255),
//            'text' => false,
//            'font' => 'helvetica',
//            'fontsize' => 8,
//            'stretchtext' => 4
//        );
//
//        $this->write1DBarcode($detail_detail['CARPARK'], 'C93', '', '', '', 10, 0.4, $style, 'N');
//
//        $this->SetFont('cid0jp', '', 11);
//
//        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//
//
//        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//
//        $date = date_create($detail_detail['BILLDATE']);
//
//        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
//        $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);
//
//        //     $this->SetFont('Arial','',11);
//        $this->Write(0, $detail_detail['OWNER_ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, $detail_detail['OWNER_ADDRESS2'], '', 0, 'L', true, 0, false, false, 0);
//
////        $block = $detail_detail['BLOCK'];
//        //      $floor = $detail_detail['FLOOR'];
//        //    $unit = $detail_detail['UNIT'];
//
//        $K = array(125, 50);
//        $this->Cell($K[0], 5, $detail_detail['OWNER_ADDRESS3'], 0, 0, 'L', false);
//
//        $this->SetFont('cid0jp', '', 14);
//        $this->Cell($K[1], 5, $detail_detail['CARPARK'], 0, 0, 'C', false);
//        $this->SetFont('cid0jp', '', 11);
//        $this->Ln();
//
//
//        $this->Cell($K[0], 5, $detail_detail['OWNER_ADDRESS4'], 0, 0, 'L', false);
//        $this->Cell($K[1], 5, ' ', 0, 0, 'C', false);
//
//
//        $w = array(80, 30, 30, 30, 25);
//
//
//
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//
//        $this->Ln();
//
//
//        $this->SetTextColor(0);
//        $this->SetLineWidth('');
//
//        $this->Cell($w[0], 6, '', 0, 0, 'L', false);
//        $this->Cell($w[1], 6, $detail_detail['EACH_SHARE'], 0, 0, 'C', false);
//        $this->Cell($w[2], 6, number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'C', false);
//        $this->Cell($w[3], 6, number_format($detail_detail['EACH_SHARE'], 0) . ' x ' . number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'L', false);
//        $this->Cell($w[4], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
//
//        $this->Ln();
//        $this->Ln();
//        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
//
//        $this->SetFont('cid0jp', 'B', 11, '', 'false');
//        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
//
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//
//        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
//        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'] * 1.05, 2), 0, 0, 'R', false);
//        $this->Ln();
//
//
//        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
//        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'] * 1.15, 2), 0, 0, 'R', false);
//        $this->SetFont('cid0jp', '', 11);
//
//        // space after receipts part
//        for ($i = 0; $i <= 12; $i++) {
//
//            $this->Ln();
//        }
//        $this->Ln(6);
//        //
//        
//        
//        $w = array(145, 50);
//        $this->Cell($w[0], 5, $detail_detail['CARPARK'], 0, 0, 'L', false);
//
//
//     //   $date = date_create($detail_detail['BILLDATE']);
//        $this->Cell($w[1], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
//        $this->Ln();
//
//
//
//        $this->Cell($w[0], 5, ' ', 0, 0, 'L', false);
//        $this->Cell($w[1], 5, $detail_detail['CODE'], 0, 0, 'R', false);
//        $this->Ln();
//        $this->Cell($w[0], 5, '', 0, 0, 'L', false);
//        $this->SetFont('cid0jp', 'B', 11, '', 'false');
//        $this->Cell($w[1], 5, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
//        $this->SetFont('cid0jp', '', 11);
//        //       $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);
//        // RECEIPTS
//        //$this->Write(0, $detail_detail['BILLDATE'], '', 0, 'R', true, 0, false, false, 0);
//        // $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);
//        //    $this->Write(0, 'HKD$' . number_format($detail_detail['AMT'], 2), '', 0, 'R', true, 0, false, false, 0);
//
//        $this->SetFont('helvetica', '', 8);
//
//        $this->Ln();
//        $this->Ln();
//        $this->Ln();
//
//        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
//    }
}
