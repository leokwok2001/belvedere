<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Outstanding_rpt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf");
        $this->load->model('outstanding_model');
    }

    public function create_pdf($case = FALSE) {

// create new PDF document

        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('leo kwok');
        $pdf->SetTitle('Resident A/R Report');
        $pdf->SetSubject('Resident A/R Report');
//        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
// set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' -Resident A/R Report', PDF_HEADER_STRING . '-print date: ' . date("Y-m-d"));

// set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------
// set font
        $pdf->SetFont('cid0jp', '', 10);        //這個應該也可以
// add a page
        $pdf->AddPage();

// column titles
        $header = array('Code', 'Block', 'Unit', 'Floor', 'Firstname', 'Lastname', 'Tel', 'Outstanding');

// data loading
        $data1 = $this->outstanding_model->get_outstanding_rpt($case);

        //print_r($data1);
// print colored table
        $pdf->outstanding_by_resident($header, $data1);
        ob_end_clean();
// ---------------------------------------------------------
// close and output PDF document
        $pdf->Output('outsanding.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
    }

}

?>