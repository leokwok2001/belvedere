<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Genmfree_batch_rpt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf_genmfee");
//        $this->load->library("Pdf_genmfee_attach");
        $this->load->model('genmfree_model');
    }

    public function create_pdf($code = FALSE) {
        $case = $this->input->post('function');
        if ($case == 'back') {
            redirect('/genmfree/view/', 'refresh');
        }

        $pdf = new Pdf_genmfee(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $_PDF_MARGIN_LEFT = 5;
        $_PDF_MARGIN_TOP = 8;
        $_PDF_MARGIN_RIGHT = 15;
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
// set font
////// data loading
        $data1 = $this->genmfree_model->get_genmfree_batch_rtp($code);

        //print_r($data1);
        //  print_r($data1[0]);
        $cat = $this->input->post('cat');
        //     $pdf->SetFont('cid0jp', '', 10);
        //  $pdf->setFontSubsetting(false);


        if ($code === FALSE) {
            foreach ($data1 as $key => $value) {
                $pdf->AddPage('P', 'A4');
                if ($cat === 'R') {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    $pdf->Debitnote($value, $data_detail);
//                    $pdf->AddPage('P', 'A4');
//                    $pdf->Debitnote_attach($value, $data_detail);
                } elseif ($cat === 'C') {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    $pdf->DebitnoteCarpark($value, $data_detail);
                }



                // print attachpage 
            }
        } else {

            $pdf->AddPage('P', 'A4');

//          $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($data1['CODE']);
//           $pdf->Debitnote($value, $data_detail);
            foreach ($data1 as $key => $value) {

                if (substr($code, 0, 1) === 'B') {
                    // do car  $pdf->DebitnoteCRS_CARPARK($value);
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    $pdf->DebitnoteCarpark($value, $data_detail);
                } else {
                    //  $pdf->DebitnoteCRS($value);
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    $pdf->Debitnote($value, $data_detail);
//                    $pdf->AddPage('P', 'A4');
//                    $pdf->Debitnote_attach($value, $data_detail);
                    
                }
            }
        }





//
//        foreach ($data1 as $key => $value) {
//            $pdf->AddPage('P', 'A4');
//            //      echo $value['INDATE'];
//            $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
//            //print_r($data_detail);
//            $pdf->Debitnote($value, $data_detail);
//        }
//
        // $is_multiarray = 0;
//        foreach ($data1 as $v) {
//            if (is_array($v)) {
//                $is_multiarray = 1;
//            } else {
//
//                $is_multiarray = 0;
//            }
//        }
//        IF ($is_multiarray === 1) {
//            foreach ($data1 as $key => $value) {
//                $pdf->AddPage('P', 'A4');
//
//
//                $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
//
//
//                //print_r($data_detail);
//                    $pdf->Debitnote( $value,$data_detail);
//            }
//        } else {
//            $pdf->AddPage('P', 'A4');
//
//
//            $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($data1['CODE']);
//            $pdf->Debitnote( $data1,$data_detail);
//
//            //print_r($data_detail);
//        }




        ob_end_clean();
////// ---------------------------------------------------------
////// close and output PDF document
        $pdf->Output('debitnote.pdf', 'I');
//////============================================================+
////// END OF FILE
//////============================================================+
    }

}

?>