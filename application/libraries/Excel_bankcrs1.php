<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include "Classes/PHPExcel.php"; 
//require_once "Classes/PHPExcel.php"; 
//require_once "Classes/PHPExcel/IOFactory.php";
//include dirname(__FILE__) . '/phpexcel/Classes/PHPExcel.php';

require_once dirname(__FILE__) . '/phpexcel/Classes/PHPExcel.php';
require_once dirname(__FILE__) . '/phpexcel/Classes/PHPExcel/IOFactory.php';

class Excel_bankcrs1 {

    public function BankCRS($data, $datestr, $cat1,$bankacno) {


        $title1 = '住宅[已付款發票]';
        $title2 = '入數戶口 '. $bankacno;


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C1', 'Belvedere Garden III(Residenncexx)')
                ->setCellValue('C2', $title1)
                ->setCellValue('C3', $datestr)
                ->setCellValue('C5', $title2);


// Rename worksheet
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A7', '#')
                ->setCellValue('B7', '單位')
                ->setCellValue('C7', '管理費月份')
                ->setCellValue('D7', '付款金額')
                ->setCellValue('E7', '銀行號碼')
                ->setCellValue('F7', '支票號碼')
        ;

        $chquecount = 0;
        $tmp1 = '';
        //   $count = 0;
        $total = 0;
        $i = 8;
        foreach ($data as $value) {

            if ($value['CHEQNO'] !== $tmp1) {
                $chquecount = $chquecount + 1;
            } else {
                
            }

            $tmp1 = $value['CHEQNO'];

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $i - 7)
                    ->setCellValue('B' . $i, $value['CODE'])
                    ->setCellValue('C' . $i, $value['PERIOD'])
                    ->setCellValue('D' . $i, number_format($value['AMT'], 2))
                    ->setCellValue('E' . $i, "'" . $value['BANKNO'])
                    ->setCellValue('F' . $i, "'" . $value['CHEQNO'])

            ;
            $total = $total + $value['AMT'];
            $i++;
        }

        $i = $i + 2;

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '總支票數量')
                ->setCellValue('F' . $i, $chquecount);
        $i = $i + 1;

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '總支票金額')
                ->setCellValue('F' . $i, number_format($total, 2));

        $objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="bankexcel.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_clean();
        $objWriter->save('php://output');
        exit;
    }

    public function BankMfee($data, $datestr, $cat1,$bankacno) {

$title2 = '入數戶口'.$bankacno;

        if ($cat1 === 'R') {
            $title0 = 'Belvedere Garden III(Residennce)';
            $title1 = '住宅[已付款發票]';
            // $title1 = $cat1;
            
        } else {
            $title0 = 'Belvedere Garden III(Carpark)';
            $title1 = '停車場[已付款發票]';
            
        }
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C1', $title0)
                ->setCellValue('C2', $title1)
                ->setCellValue('C3', $datestr)
                ->setCellValue('C5', $title2);
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A7', '#')
                ->setCellValue('B7', '單位')
                ->setCellValue('C7', '管理費月份')
                ->setCellValue('D7', '付款金額')
                ->setCellValue('E7', '銀行號碼')
                ->setCellValue('F7', '支票號碼');
        $chquecount = 0;
        $tmp1 = '';
        $total = 0;
        $i = 8;
        foreach ($data as $value) {
            if ($value['CHEQNO'] !== $tmp1) {
                $chquecount = $chquecount + 1;
            } else {
                
            }
            $tmp1 = $value['CHEQNO'];
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $i, $i - 7)
                    ->setCellValue('B' . $i, $value['CODE'])
                    ->setCellValue('C' . $i, $value['PERIOD'])
                    ->setCellValue('D' . $i, number_format($value['AMT'], 2))
                    ->setCellValue('E' . $i, "'" . $value['BANKNO'])
                    ->setCellValue('F' . $i, "'" . $value['CHEQNO']);
            $total = $total + $value['AMT'];
            $i++;
        }
        $i = $i + 2;

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '總支票數量')
                ->setCellValue('F' . $i, $chquecount);
        $i = $i + 1;

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('E' . $i, '總支票金額')
                ->setCellValue('F' . $i, number_format($total, 2));
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="bankexcel.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        ob_clean();
        $objWriter->save('php://output');
        exit;
    }

}
