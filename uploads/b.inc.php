<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
require_once "../application/libraries/phpexcel/Classes/PHPExcel.php"; 

// Create new PHPExcel object
echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();



// Create a first sheet, representing sales data
echo date('H:i:s') , " Add some data" , EOL;
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:E2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:E3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:E4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:E5');

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Belvedere Garden III(Residence');
$objPHPExcel->getActiveSheet()->setCellValue('A2', '住宅[己付款發票]');
$objPHPExcel->getActiveSheet()->setCellValue('A3', '31/10/2016 至 31/10/2016');
$objPHPExcel->getActiveSheet()->setCellValue('A4', '');
$objPHPExcel->getActiveSheet()->setCellValue('A5', '入數戶口  039-747-0-002011-1');


//$objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m'),date('d'),date('Y')) ));
$objPHPExcel->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
//$objPHPExcel->getActiveSheet()->setCellValue('E1', '#12566');
$objPHPExcel->getActiveSheet()->setCellValue('A7', '單位');
$objPHPExcel->getActiveSheet()->setCellValue('B7', '管理費月份');
$objPHPExcel->getActiveSheet()->setCellValue('C7', '付款金額');
$objPHPExcel->getActiveSheet()->setCellValue('D7', '銀行號碼');
$objPHPExcel->getActiveSheet()->setCellValue('E7', '支票號');


// for loop

$objPHPExcel->getActiveSheet()->setCellValue('A8', '1001');
$objPHPExcel->getActiveSheet()->setCellValue('B8', 'PHP for dummies');
$objPHPExcel->getActiveSheet()->setCellValue('C8', '20');
$objPHPExcel->getActiveSheet()->setCellValue('D8', '1');
$objPHPExcel->getActiveSheet()->setCellValue('E8', '0');



$styleThickBrownBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_MEDIUM
		),
	),
);
$objPHPExcel->getActiveSheet()->getStyle('A7')->applyFromArray($styleThickBrownBorderOutline);
$objPHPExcel->getActiveSheet()->getStyle('B10')->applyFromArray($styleThickBrownBorderOutline);


// end for loop


$objPHPExcel->getActiveSheet()->setCellValue('D12', '支票數量:');
$objPHPExcel->getActiveSheet()->setCellValue('E12', '0');

$objPHPExcel->getActiveSheet()->setCellValue('D13', '總金額:');
$objPHPExcel->getActiveSheet()->setCellValue('E13', '0');

// Set column widths
echo date('H:i:s') , " Set column widths" , EOL;
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);

// Set fonts
echo date('H:i:s') , " Set fonts" , EOL;
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getStyle('D13')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('E13')->getFont()->setBold(true);


// Set thin black border outline around column
echo date('H:i:s') , " Set thin black border outline around column" , EOL;
$styleThinBlackBorderOutline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => 'FF000000'),
		),
	),
);

$objPHPExcel->getActiveSheet()->getStyle('A4:E10')->applyFromArray($styleThinBlackBorderOutline);


// Set page orientation and size
echo date('H:i:s') , " Set page orientation and size" , EOL;
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Rename first worksheet
echo date('H:i:s') , " Rename first worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Invoice');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
