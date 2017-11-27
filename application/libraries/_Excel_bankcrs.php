<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once dirname(__FILE__) . '/php-excel/php-excel.class.php';

class Excel_bankcrs extends Excel_XML {

    function __construct() {
        parent::__construct();
    }

    public function BankCRS($data, $total, $datestr) {
        //    $ta[];
        
        
        $row1 = array(
            1 => array('', '', 'Belvedere Garden III(Residence)'));

        $row2 = array(
            1 => array('', '', '住宅[己付款發票]'));

        $row3 = array(
            1 => array('', '', $datestr));

        $row4 = array(
            1 => array('', '', '入數戶口 012-666-1-034561-9'));
        $row5 = array(
            1 => array(''));


        $row6 = array(
            1 => array('單位', '維修費月份', '付款金額', '銀行號碼', '支票號碼'));

        $chquecount = 0;
        $tmp1 = '';
        $count=0;
        foreach ($data as $value) {


//            if (substr($value['CODE'], 0, 1) !== 'B') {
            
        //array_unshift($value, $count);
           $ta[] =  $value;
         //    $ta[] =  array_unshift($value, $count);
//            }

            if ($value['CHEQNO'] !== $tmp1) {
                $chquecount = $chquecount + 1;
            } else {
                
            }

            $tmp1 = $value['CHEQNO'];
            //$count++;
        }

        
       // print_r($ta);

//$ta[] =array_unshift($ta, 1);
        $row7 = array(
            1 => array('', '', '', '總支票數量', $chquecount));

        $row8 = array(
            1 => array('', '', '', '總支票金額', $total));



        $xls = new Excel_XML('UTF-8', false, 'My Test Sheet');
        $xls->addArray($row1);
        $xls->addArray($row2);
        $xls->addArray($row3);
        $xls->addArray($row4);
        $xls->addArray($row5);
        $xls->addArray($row6);
        //     print_r($data);
        $xls->addArray($ta);
        $xls->addArray($row5);
        $xls->addArray($row7);
        $xls->addArray($row8);
        $xls->generateXML('my-test');
        //     echo "test!";
    }

}
