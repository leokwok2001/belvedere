<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_gencarmanfee extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    // Colored table
    public function DebitnoteCRS($detail_detail) {

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

        $this->write1DBarcode($detail_detail['CARPARK'], 'C93', '', '', '', 10, 0.4, $style, 'N');

        $this->SetFont('cid0jp', '', 11);

        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);


        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

        $date = date_create($detail_detail['BILLDATE']);

        $this->Write(0, date_format($date, "Y-M-d"), '', 0, 'R', true, 0, false, false, 0);
        $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);

        //     $this->SetFont('Arial','',11);
        $this->Write(0, $detail_detail['OWNER_ADDRESS1'], '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, $detail_detail['OWNER_ADDRESS2'], '', 0, 'L', true, 0, false, false, 0);

//        $block = $detail_detail['BLOCK'];
        //      $floor = $detail_detail['FLOOR'];
        //    $unit = $detail_detail['UNIT'];

        $K = array(125, 50);
        $this->Cell($K[0], 5, $detail_detail['OWNER_ADDRESS3'], 0, 0, 'L', false);

        $this->SetFont('cid0jp', '', 14);
        $this->Cell($K[1], 5, $detail_detail['CARPARK'], 0, 0, 'C', false);
        $this->SetFont('cid0jp', '', 11);
        $this->Ln();


        $this->Cell($K[0], 5, $detail_detail['OWNER_ADDRESS4'], 0, 0, 'L', false);
        $this->Cell($K[1], 5, ' ', 0, 0, 'C', false);


        $w = array(80, 30, 30, 30, 25);



        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->Ln();


        $this->SetTextColor(0);
        $this->SetLineWidth('');

        $this->Cell($w[0], 6, '', 0, 0, 'L', false);
        $this->Cell($w[1], 6, $detail_detail['EACH_SHARE'], 0, 0, 'C', false);
        $this->Cell($w[2], 6, number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'C', false);
        $this->Cell($w[3], 6, number_format($detail_detail['EACH_SHARE'], 0) . ' x ' . number_format($detail_detail['SHARE_UNIT'], 0), 0, 0, 'L', false);
        $this->Cell($w[4], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);

        $this->Ln();
        $this->Ln();
        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);

        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);

        $this->Ln();
        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'] * 1.05, 2), 0, 0, 'R', false);
        $this->Ln();


        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '', 0, 0, 'L', false);
        $this->Cell($w[4], 7, 'HKD$' . number_format($detail_detail['AMT'] * 1.15, 2), 0, 0, 'R', false);
        $this->SetFont('cid0jp', '', 11);

        // space after receipts part
        for ($i = 0; $i <= 12; $i++) {

            $this->Ln();
        }
        $this->Ln(6);
        //
        
        
        $w = array(145, 50);
        $this->Cell($w[0], 5, $detail_detail['CARPARK'], 0, 0, 'L', false);


     //   $date = date_create($detail_detail['BILLDATE']);
        $this->Cell($w[1], 5, date_format($date, "Y-M-d"), 0, 0, 'R', false);
        $this->Ln();



        $this->Cell($w[0], 5, ' ', 0, 0, 'L', false);
        $this->Cell($w[1], 5, $detail_detail['CODE'], 0, 0, 'R', false);
        $this->Ln();
        $this->Cell($w[0], 5, '', 0, 0, 'L', false);
        $this->SetFont('cid0jp', 'B', 11, '', 'false');
        $this->Cell($w[1], 5, 'HKD$' . number_format($detail_detail['AMT'], 2), 0, 0, 'R', false);
        $this->SetFont('cid0jp', '', 11);
        //       $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);
        // RECEIPTS
        //$this->Write(0, $detail_detail['BILLDATE'], '', 0, 'R', true, 0, false, false, 0);
        // $this->Write(0, $detail_detail['CODE'], '', 0, 'R', true, 0, false, false, 0);
        //    $this->Write(0, 'HKD$' . number_format($detail_detail['AMT'], 2), '', 0, 'R', true, 0, false, false, 0);

        $this->SetFont('helvetica', '', 8);

        $this->Ln();
        $this->Ln();
        $this->Ln();

        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 10, 0.4, $style, 'N');
    }

}
