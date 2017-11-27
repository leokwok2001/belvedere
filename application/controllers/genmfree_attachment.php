<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Genmfree_attachment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("Pdf_genmfee_attach");
        $this->load->model('genmfree_model');
    }

    public function create_pdf($code = FALSE) {
        $case = $this->input->post('function');
        if ($case == 'back') {
            redirect('/genmfree/view/', 'refresh');
        }

        $pdf = new Pdf_genmfee_attach(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
     //   $pdf->SetAutoPageBreak(TRUE, $_PDF_MARGIN_BOTTOM);
        $pdf->setImageScale($_PDF_IMAGE_SCALE_RATIO);

        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $data1 = $this->genmfree_model->get_genmfree_batch_rtp($code);

        $cat = $this->input->post('cat');
        if ($code === FALSE) {
            foreach ($data1 as $key => $value) {

                if ($cat === 'R') {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    if (count($data_detail) > 6) {
                        $pdf->AddPage('P', 'A4');
                        $pdf->Debitnote_attach($value, $data_detail);
                    }
                } elseif ($cat === 'C') {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    if (count($data_detail) > 6) {
                        $pdf->AddPage('P', 'A4');
                        $pdf->DebitnoteCarpark_attach($value, $data_detail);
                    }
                }
            }
        } else {
            $pdf->AddPage('P', 'A4');
            foreach ($data1 as $key => $value) {
                if (substr($code, 0, 1) === 'B') {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    if (count($data_detail) > 6) {
                        $pdf->DebitnoteCarpark_attach($value, $data_detail);
                    }
                } else {
                    $data_detail = $this->genmfree_model->get_genmfree_batch_detail_rtp($value['CODE']);
                    if (count($data_detail) > 6) {
                        $pdf->Debitnote_attach($value, $data_detail);
                    }
                }
            }
        }

        ob_end_clean();
        $pdf->Output('debitnote_attachlist.pdf', 'I');
    }

}

?>