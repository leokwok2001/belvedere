<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_paymentreceipt extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    // Page footer
    public function Footer() {
        // do nothing
    }

    public function Paymentreceipt($detail_detail) {


        $this->Ln(4);

        // set cell padding
        $this->setCellPaddings(1, 1, 0, 0, 0);

// set cell margins
        $this->setCellMargins(1, 1, 0, 0, 0);


        //     $txt1 = $detail_detail['NAME1'];
        $txt2 = $detail_detail['ADDRESS1'];
        $txt3 = $detail_detail['ADDRESS2'];
        $txt4 = $detail_detail['ADDRESS3'];
        $txt5 = $detail_detail['ADDRESS4'];
        $receiptno = $detail_detail['PAYMENTNO'];
        $date = date_create($detail_detail['INDATE']);
        $date1 = date_format($date, "Y-M-d");
        $block = $detail_detail['RES_BLOCK'];
        $floor = $detail_detail['RES_FLOOR'];
        $unit = $detail_detail['RES_UNIT'];
        $charge_desc = '管理費 Management Fee';
        $amt = number_format($detail_detail['AMT'], 2);
        $chequeno = $detail_detail['CHEQNO'];
        $code = $detail_detail['CODE'];
        $paytype = $detail_detail['PAYTYPE']; 
        
        $this->SetFont('cid0jp', '', 11);
        $this->MultiCell(65, 5, $txt2 . "\n" . $txt3 . "\n" . $txt4 . "\n" . $txt5, 0, 'L', 0, 0, '', '', true);
        $this->SetFont('cid0jp', '', 16);
        $this->MultiCell(55, 5, '正式收據' . "\n" . "OFFICIAL RECEIPT", 0, 'C', 0, 0, '', '', true);
        $this->SetFont('cid0jp', '', 10);
        $this->MultiCell(55, 5, "Receipt No.: " . $receiptno . "\n" . "Date:  " . $date1, 0, 'R', 0, 1, '', '', true);

//        $this->MultiCell(20, 5, "Receipt No.:", 1, 'R', 0, 1, '', '', true);
//        $this->MultiCell(20, 5, $receiptno, 1, 'R', 0, 1, '', '', true);
        $this->Ln(17);
        $this->SetFont('cid0jp', '', 9);
        $this->MultiCell(40, 5, "茲收到" . "\n" . "\n" . "Received from", 0, 'L', 0, 0, '', '', true);

        $this->SetFont('cid0jp', '', 13);

        if (substr($code, 0, 1) !== 'B') {
            $this->MultiCell(110, 5, "麗城花園第三期第 $block 座 $floor 樓 $unit" . "\n" . "Unit $unit, Block $block, $floor/F , Belvedere Garden Phase 3", 1, 'C', 0, 0, '', '', true);
        } else {
            $this->SetFont('cid0jp', '', 10);
            $basement1 = substr($code, 0, 2);
            //  $basement2 = substr($code, 1, 1);
            $basementno = substr($code, 3, 3);
            $this->MultiCell(120, 5, "麗城花園第三期$basement1 層$basementno 號車位" . "\n" .
                    "Car Parking Space No. $basementno on Basement " . substr($basement1, 1, 1) . " of Belvedere Garden Phase 3", 1, 'C', 0, 0, '', '', true);
            // "Car Parking Space No. $basementno on Basement $basement2 of Belvedere Garden Phase 3
        }
        $this->SetFont('cid0jp', '', 9);

        $this->Ln(14);
        //       $this->Cell(65, 0, '繳付以下 In payment of:', 0, 0, 'L', 0);
        //  $this->Ln(16);
        $this->MultiCell(40, 5, "繳付以下 In payment of:", 0, 'L', 0, 0, '', '', true);
        $this->Ln();
        $this->Cell(185, 0, '', 'T');

        $this->Ln();
        $this->SetFont('cid0jp', '', 13);

        $this->MultiCell(150, 5, $charge_desc, 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(35, 5, "$" . $amt, 0, 'R', 0, 0, '', '', true);
        $this->SetFont('cid0jp', '', 9);
        $this->Ln(12);
        $this->Cell(185, 0, '', 'T');

        $this->Ln(1);
        $this->SetFont('cid0jp', '', 13);
        $this->MultiCell(150, 5, "總金額 The sum of ", 0, 'R', 0, 0, '', '', true);
        $this->MultiCell(35, 5, "$" . $amt, 1, 'R', 0, 0, '', '', true);

        $this->SetFont('cid0jp', '', 8);
        $this->Ln();

        $this->MultiCell(29, 4, "收款賬戶 Payable to", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(2, 4, ":", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(40, 4, "麗城花園第三期業主立案法團", 0, 'L', 0, 0, '', '', true);


        $this->Ln(4);
        $this->MultiCell(29, 4, "", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(2, 4, "", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(100, 4, "The Incorporated Owners of Belvedere Garden Phase 3", 0, 'L', 0, 0, '', '', true);

        
                /**&&**/
        
        $paytypestr =( $paytype='1' ? "自動轉帳 Autopay" : "支票 Cheque" );
        
        
        $this->Ln(4);
        $this->MultiCell(29, 4, "支付方式 Payment by", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(2, 4, ":", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(100, 4, $paytypestr, 0, 'L', 0, 0, '', '', true);

        $this->Ln(4);
        $this->MultiCell(29, 4, "支票號碼 Cheque no.", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(2, 4, ":", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(88, 4, $chequeno, 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(50, 4, "麗城花園第三期管理處", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->MultiCell(120, 4, '', 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(100, 4, " Management Office of Belvedere Garden Phase 3", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->MultiCell(100, 4, "備註 Remark :", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->MultiCell(100, 4, "1. 交來支票收妥作實．", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->MultiCell(100, 4, "  Cheques are subject to bank clearance.", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
        $this->MultiCell(121, 4, "2.此收據屬電腦編印，無需簽署．", 0, 'L', 0, 0, '', '', true);

        $this->Ln(4);
        $this->MultiCell(121, 4, "  This is a computer generated printout and no signature is required.", 0, 'L', 0, 0, '', '', true);
        $this->Cell(60, 0, '', 'B');
        //     $this->Ln(3);
        $this->Ln(4);
        $this->MultiCell(121, 4, "", 0, 'L', 0, 0, '', '', true);
        $this->MultiCell(60, 4, "管理處蓋章 Chop of Management Office", 0, 'L', 0, 0, '', '', true);

//        $this->Ln(4);
// set color for background
        //      $this->SetFillColor(220, 255, 220);
//TCPDF::MultiCell	(	 	
//                     $w,
// 	$h,
// 	$txt,
// 	$border = 0,
// 	$align = ‘J’,
// 	$fill = false,
// 	$ln = 1,
// 	$x = “,
// 	$y = “,
// 	$reseth = true,
// 	$stretch = 0,
// 	$ishtml = false,
// 	$autopadding = true,
// 	$maxh = 0,
// 	$valign = ’T’,
// 	$fitcell = false 
//)		
//        
//// Vertical alignment
//        $this->MultiCell(40, 30, '[VERTICAL ALIGNMENT - TOP] ' . $txt . "\n" . $txt2, 1, 'J', 1, 1, '', '', true, 0, false, true, 40, 'T');
//        $this->MultiCell(50, 30, '[VERTICAL ALIGNMENT - MIDDLE] ' . $txt, 0, 'J', 1, 1, '', '', true, 0, false, true, 40, 'T');
//        $this->MultiCell(40, 30, '[VERTICAL ALIGNMENT - BOTTOM] ' . $txt, 0, 'J', 1, 1, '', '', true, 0, false, true, 40, 'T');
//        $this->Ln(4);
//
//        $cellline = 0;
//        $cellhight = 0;
//
//        $this->SetFillColor(0, 150, 250);
//        $this->SetTextColor(0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('');
//        $this->Ln();
//
//        //     $this->Cell(120, 7, '1.物業資料 Property Information', 1, 0, 'L', 0);
//        // Colors, line width and bold font
//        $this->SetFillColor(0, 150, 250);
//        $this->SetTextColor(0);
//        $this->SetLineWidth(0.3);
//        $this->SetFont('');
//        $this->Ln();
//
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
//
//        if (substr($detail_detail['CODE'], 0, 1) !== 'B') {
//            $this->Cell(55, $cellhight, $detail_detail['CODE'] . '  --    Block ' . $detail_detail['BLOCK'] . ' Floor ' . $detail_detail['FLOOR'] . ' Unit ' . $detail_detail['UNIT'], $cellline, 0, 'L', 0);
//        } else {
//            $this->Cell(55, $cellhight, $detail_detail['CODE'], $cellline, 0, 'L', 0);
//        }
//
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '業主姓名 / Owner', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, strtoupper($detail_detail['NAME1']) . ', ' . $detail_detail['NAME2'], $cellline, 0, 'L', 0);
//        $this->Ln();
//
//        $this->Cell(65, $cellhight, '經手人 / Handled by', $cellline, 0, 'L', 0);
//        $this->Cell(55, $cellhight, $detail_detail['CREATEBY'], $cellline, 0, 'L', 0);
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
//
//        $this->Ln();
//
//        $this->Cell(20, 7, '管理費月份', 1, 0, 'C', 1);
//        $this->Cell(30, 7, '結單', 1, 0, 'C', 1);
//        $this->Cell(95, 7, '備註', 1, 0, 'C', 1);
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
//            $this->Cell(20, 6, $row['BILLDATE'], 'LR', 0, 'C', $fill);
//            $this->Cell(30, 6, $row['CODE'], 'LR', 0, 'C', $fill);
//            $this->Cell(95, 6, '綜合修葺繳費', 'LR', 0, 'C', $fill);
//            $this->Cell(20, 6, number_format($row['AMT'], 2), 'LR', 0, 'R', $fill);
//            $this->Cell(20, 6, number_format($row['AMT'], 2), 'LR', 0, 'R', $fill);
//            $this->Ln();
//        }
//
//
//
//        //$fill = !$fill;
//        //  }
//        $this->Cell(185, 0, '', 'T');
//        $this->Ln();
//
//        $this->Cell(165, $cellhight, '應付脹項 / Total Due:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, number_format($detail_detail['AMT'], 2), $cellline, 0, 'R', 0);
//        $this->Ln();
//
//        $this->Cell(165, $cellhight, '繳付金額 / Amount Paid:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, number_format($detail_detail['AMT'], 2), $cellline, 0, 'R', 0);
//        $this->Ln();
//        $this->Cell(165, $cellhight, '繳付方法 / Paid by:', $cellline, 0, 'R', 0);
//        $this->Cell(20, $cellhight, $detail_detail['PAYTYPE'] === '0' ? 'Cheque' : 'Cash/Auotpay', $cellline, 0, 'R', 0);
//
//        $this->Ln();
//        $this->Cell(120, $cellhight, $detail_detail['CHEQNO'], $cellline, 0, 'R', 0);
//        $this->Ln();
//        $this->Ln();
//        $this->Cell(120, $cellhight, '*** 多謝, 此收據 *** Thank You. End of Receipt ***', $cellline, 0, 'C', 0);
    }

}
