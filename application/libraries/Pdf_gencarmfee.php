<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf_gencarmfee extends TCPDF {

    function __construct() {
        parent::__construct();
    }

    // Colored table
    public function CarDebitnote($detail_header, $detail_detail) {

      
        $this->SetFont('helvetica', '', 9);

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
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        //   $this->Write(0, $detail_detail['RES_CODE'], '', 0, 'L', true, 0, false, false, 0);
        $this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 18, 0.4, $style, 'N');
//$this->write1DBarcode($detail_detail['RES_CODE'], 'C93', '', '', '', 18, 0.4, $style, 'N');
//
//             // print a message
//        $txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
//        $this->MultiCell(70, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);  
//            $this->MultiCell(20, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
////        $this->SetY(20);
        // CODE 93 - USS-93


        $this->SetFont('cid0jp', '', 9);
        // $this->Cell(0, 0,'管理費繳付通知 Management Fee Notification', 0, 1,'C');
        $this->writeHTML("<center><u>管理費繳付通知 Management Fee Notification</u></center>", true, false, false, false, 'C');
        $this->Ln();
        $this->writeHTML("<table><tr>
    <th><b>通訊地址 Mailing Address</b></th>
    <th><b>物業地址 Property Address</b></th>
  </tr>
  <tr><td>" . $detail_detail['ADDRESS1'] . "<BR>"
                . $detail_detail['ADDRESS2'] . "<BR>"
                . $detail_detail['ADDRESS3'] . "<BR>" .
                "</td>" .
                "<td>" . $detail_detail['RES_CODE'] . "</td>
  </tr></table>", true, false, false, false, 'L');

        //    $this->setBarcode($detail_detail['RES_CODE']);
        //
        $this->SetFont('cid0jp', '', 9);
//        $this->SetFont('', 'B');
//        $this->Write(0, 'TO 客戶 :', '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, 'UNIT 單位 :' . $detail_detail['CODE'], '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, 'FLOOR 樓層 :' . $detail_detail['RES_FLOOR'], '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, 'BLOCK 座數 :' . $detail_detail['RES_BLOCK'], '', 0, 'L', true, 0, false, false, 0);
//        $this->Write(0, 'BELVEDERE GARDEN PHASE 3 ', '', 0, 'L', true, 0, false, false, 0);

        $this->Ln();
        /* TCPDF::Cell	(
          $w,
          $h = 0,
          $txt = “,
          $border = 0,
          $ln = 0,
          $align = “,
          $fill = false,
          $link = “,
          $stretch = 0,
          $ignore_min_height = false,
          $calign = ’T’,
          $valign = ’M’
          ) */



        // Header
        // $detail_header = array('PARTICULARS', 'PERIOD', 'AMOUNT');

        $w = array(30, 35, 30, 30);

        $date = $detail_detail['INDATE'];
        $date1 = str_replace('-', '/', $date);
        $tomorrow = date('Y-m-d', strtotime($date1 . "+14 days"));



        $this->Write(0, '結帳日期 Closing Date: ' . $tomorrow, '', 0, 'R', true, 0, false, false, 0);

        $this->Ln();

        // Colors, line width and bold font
        $this->SetFillColor(0, 200, 250);
        $this->SetTextColor(0);
        //$this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');


        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '1.管理費繳付資料 Management Fee Information', 1, 0, 'L', 1);

        $this->Ln();

        // Colors, line width and bold font
        $this->SetFillColor(0, 150, 250);
        $this->SetTextColor(0);
        //$this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');


        $num_headers = count($detail_header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $detail_header[$i], 1, 0, 'C', 1);
        }


        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;

        //  foreach ($detail_detail as $row) {

        $this->Cell($w[0], 6, '前期結欠', 'LR', 0, 'C', $fill);
        $this->Cell($w[1], 6, ' ', 'LR', 0, 'C', $fill);
        $this->Cell($w[2], 6, ' ', 'LR', 0, 'R', $fill);
        $this->Cell($w[3], 6, 'HKD$' . number_format($detail_detail['P_OUTSTAND'], 2), 'LR', 0, 'R', $fill);

        $this->Ln();
        $this->Cell($w[0], 6, $detail_detail['INDATE'], 'LR', 0, 'C', $fill);
        $this->Cell($w[1], 6, $detail_detail['CODE'], 'LR', 0, 'C', $fill);
        $this->Cell($w[2], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 'LR', 0, 'R', $fill);
        $this->Cell($w[3], 6, 'HKD$' . number_format($detail_detail['AMT'], 2), 'LR', 0, 'R', $fill);


        $this->Ln();
        $this->Cell($w[0] + $w[1] + $w[2], 7, '合計 Total', 1, 0, 'R', 1);
        $this->Cell($w[3], 7, 'HKD$' . number_format($detail_detail['AMT'] + $detail_detail['P_OUTSTAND'], 2), 1, 0, 'R', 1);
        //  $this->Cell($w[3], 6, ' ', 'LR', 0, 'C', $fill);

        $this->Ln();



        //$fill = !$fill;
        //  }
        $this->Cell(array_sum($w), 0, '', 'T');


        $this->Ln();
        // Colors, line width and bold font
        $this->SetFillColor(0, 200, 250);
        $this->SetTextColor(0);
        //$this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '2.支票抬頭 Cheque made payable to ', 1, 0, 'L', 1);

        $this->Ln();

        $this->writeHTML("麗城花園業主立案法團", true, false, false, false, 'C');
        $this->writeHTML("The Incorporated Owners of Belvedere Garden Phase3", true, false, false, false, 'C');
        // Colors, line width and bold font
        $this->SetFillColor(0, 200, 250);
        $this->SetTextColor(0);
        //$this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        $this->Cell($w[0] + $w[1] + $w[2] + $w[3], 7, '3.繳費注意事項 Payment Instruction ', 1, 0, 'L', 1);

        $this->Ln();
        $this->SetFillColor(255, 255, 255);
        $this->SetFont('cid0jp', '', 6);
        $this->SetTextColor(50, 50, 50);

//Write ($h, $txt, $link=“, $fill=false, $align=”, $ln=false, $stretch=0, $firstline=false, $firstblock=false, $maxh=0, $wadj=0, $margin=“)

$this->Ln();
        $this->Write(0, '甲,收到此通知單後。請附夾此單以支票形式交回管理處或每座大堂道見收集箱。', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'Please settle your account with this demand note by cheque at managment office or lobby collection box.', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '乙,因保安理由,本處只接受支票或自動轉賬形式付款,歡迎閣下到管理處索取自動轉賬申請表。', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'For security reason, cheque payment is preferred, you are welcomed to use bank autopay service. Applicatoin form are available at managment office.', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, '丙,根據大廈規定,管理費須於當月上旬繳付,逾期需加付由當月首日起計算之利息每月每日元$5元及1000元手續費。', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'According to Deed to mutual Covenant, managment fee should be paid in the early-month, interest on sush amount in arrears calculated at the rate of $5 for each $100 and a collection charge for the sum of $1000 for wich it remains upaid.', '', 0, 'L', true, 0, false, false, 0);

        $this->Write(0, '丁,敬請盡快繳交,否則將會採取法律行動。', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'Please settle the managment fee as soon as possible, otherwire , Solicitors will be instructed to procced with necessary legal action.', '', 0, 'L', true, 0, false, false, 0);

        $this->Write(0, '戊,如閣下已繳交上述費用,請不用理會此通知書。', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'The demand note can be ignored if the payment has been settled.', '', 0, 'L', true, 0, false, false, 0);
        $this->Ln();

        $this->SetFillColor(255, 255, 255);
        $this->SetFont('cid0jp', '', 5);
        $this->SetTextColor(50, 50, 50);
        $this->Write(0, '***電腦出單無須簽署***', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'No singature is required as this part is a computer generated notification.', '', 0, 'L', true, 0, false, false, 0);
        $this->Ln();

$this->Ln();
        $this->Write(0, '麗城花園第三期管理處|新界荃灣青山道625號麗城花園第三期第三座平台', '', 0, 'L', true, 0, false, false, 0);
        $this->Write(0, 'BG3 Managment Office|Poltium Block 3,Belvedere Garden Phase 3,625 Castle Park Road,Tseung Wan,N.T 電話 Tel:24987292 傳真 Fax:24167070', '', 0, 'L', true, 0, false, false, 0);
 
    }

}
