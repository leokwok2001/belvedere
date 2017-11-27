<?php

//require_once dirname(__FILE__) . '/php-excel/php-excel.class.php';
class Comm_man_paymentreceipts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library("Pdf_manpaymentreceipt");
        $this->load->model('comm_man_payment_model');
    }

    
        public function create_pdf_single($code = FALSE) {
        $case = $this->input->post('function');
        if ($case == 'back') {
            redirect('/comm_man_payment/view/', 'refresh');
        }

        $PDF_HEADER_LOGO = 'icon.jpg';
        $PDF_HEADER_LOGO_WIDTH = 100;
        $PDF_PAGE_FORMAT = 'A4';
        $PDF_PAGE_ORIENTATION = 'P';
        $PDF_CREATOR = 'TCPDF';
        $PDF_UNIT = 'mm';
        $PDF_MARGIN_HEADER = 5;
        $PDF_MARGIN_FOOTER = 5;
        $PDF_MARGIN_TOP = 16;
        $PDF_MARGIN_BOTTOM = 5;
        $PDF_MARGIN_LEFT = 10;
        $PDF_MARGIN_RIGHT = 10;
        $PDF_FONT_NAME_MAIN = 'helvetica';
        $PDF_FONT_SIZE_MAIN = 10;
        $PDF_FONT_NAME_DATA = 'helvetica';
        $PDF_FONT_SIZE_DATA = 8;
        $PDF_FONT_MONOSPACED = 'courier';
        $PDF_IMAGE_SCALE_RATIO = 1.25;
        $pdf = new Pdf_manpaymentreceipt($PDF_PAGE_ORIENTATION, $PDF_UNIT, $PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator($PDF_CREATOR);
        $pdf->SetAuthor('leo kwok');
        $pdf->SetTitle('管理費繳付記錄');
        $pdf->SetSubject('--正式收據 / Official Payment Receipt');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData(
        $PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, '', '', Array(255, 255, 255), Array(255, 255, 255));
        $pdf->setHeaderFont(Array($PDF_FONT_NAME_MAIN, '', $PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array($PDF_FONT_NAME_DATA, '', $PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont($PDF_FONT_MONOSPACED);
        $pdf->SetMargins($PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, $PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin($PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin($PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, $PDF_MARGIN_BOTTOM);
        $pdf->setImageScale($PDF_IMAGE_SCALE_RATIO);
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->SetFont('cid0jp', '', 10);
        $data1 = $this->comm_man_payment_model->get_paymentreceipt($code);

        $pdf->AddPage('L', 'A5');
        $pdf->Paymentreceipt($data1[0]);
        ob_end_clean();

        $pdf->Output('paymentreceipt1.pdf', 'I');

    }
    
    
    
    
    public function create_pdf($code = FALSE) {
        $case = $this->input->post('function');
        if ($case == 'back') {
            redirect('/comm_man_payment/view/', 'refresh');
        }

        $PDF_HEADER_LOGO = 'icon.jpg';
        $PDF_HEADER_LOGO_WIDTH = 100;
        $PDF_PAGE_FORMAT = 'A4';
        $PDF_PAGE_ORIENTATION = 'P';
        $PDF_CREATOR = 'TCPDF';
        $PDF_UNIT = 'mm';
        $PDF_MARGIN_HEADER = 5;
        $PDF_MARGIN_FOOTER = 5;
        $PDF_MARGIN_TOP = 16;
        $PDF_MARGIN_BOTTOM = 5;
        $PDF_MARGIN_LEFT = 10;
        $PDF_MARGIN_RIGHT = 10;
        $PDF_FONT_NAME_MAIN = 'helvetica';
        $PDF_FONT_SIZE_MAIN = 10;
        $PDF_FONT_NAME_DATA = 'helvetica';
        $PDF_FONT_SIZE_DATA = 8;
        $PDF_FONT_MONOSPACED = 'courier';
        $PDF_IMAGE_SCALE_RATIO = 1.25;


        $pdf = new Pdf_manpaymentreceipt($PDF_PAGE_ORIENTATION, $PDF_UNIT, $PDF_PAGE_FORMAT, true, 'UTF-8', false);
//////// set document information
        $pdf->SetCreator($PDF_CREATOR);
        $pdf->SetAuthor('leo kwok');
        $pdf->SetTitle('管理費繳付記錄');
        $pdf->SetSubject('--正式收據 / Official Payment Receipt');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

//////// set default header data
        $pdf->SetHeaderData(
                $PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, '', '', Array(255, 255, 255), Array(255, 255, 255));

//////// set header and footer fonts
        $pdf->setHeaderFont(Array($PDF_FONT_NAME_MAIN, '', $PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array($PDF_FONT_NAME_DATA, '', $PDF_FONT_SIZE_DATA));

//////// set default monospaced font
        $pdf->SetDefaultMonospacedFont($PDF_FONT_MONOSPACED);

//////// set margins
        $pdf->SetMargins($PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, $PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin($PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin($PDF_MARGIN_FOOTER);

//////// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, $PDF_MARGIN_BOTTOM);
//////// set image scale factor
        $pdf->setImageScale($PDF_IMAGE_SCALE_RATIO);

//////// set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('cid0jp', '', 10);
        $data1 = $this->comm_man_payment_model->get_paymentreceipt($code);
        foreach ($data1 as $key => $value) {
            $pdf->AddPage('L', 'A5');
            $pdf->Paymentreceipt($value);
        }
        ob_end_clean();
        $pdf->Output('paymentreceipt2.pdf', 'I');
    }


    public function view() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//comm_man_paymentreceipts//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('comm_man_paymentreceipts/create');
        $this->load->view('footer');
    }

}

?>