<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Genmanfee_batch_rpt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf_genmanfee");
        $this->load->model('genmanfee_model');
    }

    public function create_pdf($code = FALSE) {
        $case = $this->input->post('function');
        if ($case == 'back') {
            redirect('/genmanfee/view/', 'refresh');
        }



        $pdf = new Pdf_genmanfee(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        $_PDF_MARGIN_LEFT = 5;
                //$_PDF_MARGIN_TOP = 8;   for tray 1
        $_PDF_MARGIN_TOP = 8;
        $_PDF_MARGIN_RIGHT = 10;
        $_PDF_MARGIN_BOTTOM = 5;
        $_PDF_IMAGE_SCALE_RATIO = 1.25;
        $pdf->SetMargins($_PDF_MARGIN_LEFT, $_PDF_MARGIN_TOP, $_PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(TRUE, $_PDF_MARGIN_BOTTOM);
        $pdf->setImageScale($_PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
// ---------------------------------------------------------
        $cat = $this->input->post('cat');
        $data1 = $this->genmanfee_model->get_genmanfee_batch_rtp($code);
        $pdf->SetFont('cid0jp', '', 10);
        $pdf->setFontSubsetting(false);

        if ($code === FALSE) {
            foreach ($data1 as $key => $value) {
                $pdf->AddPage('P', 'A4');
                if ($cat === 'R') {
                    $pdf->DebitnoteCRS($value);
                } elseif ($cat === 'C') {
                    $pdf->DebitnoteCRS_CARPARK($value);
                }
            }
        } else {

            $pdf->AddPage('P', 'A4');

            foreach ($data1 as $key => $value) {

                if (substr($code, 4, 1) === 'B') {
                    $pdf->DebitnoteCRS_CARPARK($value);
                } else {
                    $pdf->DebitnoteCRS($value);
                }
            }
        }






        ob_end_clean();

//        if ($cat === 'R') {
        $pdf->Output('debitnote_CRS.pdf', 'I');
//        } elseif ($cat === 'C') {
//            $pdf->Output('debitnote_CRS_CARPARK.pdf', 'I');
//        }
    }

}

?>