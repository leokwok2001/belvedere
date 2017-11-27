<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_carpaymentreceipt extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Colored table
    public function Carpaymentreceipt($detail_detail, $detail_detail2, $detail_detail3) {

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

}
