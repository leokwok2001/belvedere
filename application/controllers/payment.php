<?php

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('payment_model');
        $this->load->model('genmfree_model');
        //   $this->load->model('outstanding_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {
        $page = 'view';
        if (!file_exists(APPPATH . 'views//payment//' . $page . '.php')) {
            show_404();
        }

        $case = $this->input->post('function');
        switch ($case) {
            case "confirmall":
                $chk1 = $this->input->post('chk1');
                foreach ($chk1 as $check) {
                    $this->payment_model->set_payrecord_by_manu2($check, 'TRUE');
                    // echo $check;
                }
                redirect('/payment/view/', 'refresh');
                break;

            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['payment'] = $this->payment_model->get_payrecord();
                $this->load->view('payment/view', $data);
                $this->load->view('footer');
        }
    }

    public function edit($key = FALSE) {
        $page = 'edit';
        if (!file_exists(APPPATH . 'views//payment//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "print":
                $code = $this->input->post('seq');
                redirect('/paymentreceipts/create_pdf_single/' . $code, 'refresh');
                break;
            case "back":
                redirect('/payment/view/', 'refresh');
                break;
            case "update":
                $this->payment_model->update_payrecord();
                redirect('/payment/view/', 'refresh');
                break;
            case "delete":
                //  $code = $this->input->post('seq');
                //  $this->db->delete('B_PayRecord', array('PAYMENTNO' => $code));
                $this->payment_model->delete_payrecord();
                redirect('/payment/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['payment'] = $this->payment_model->get_payrecord($key);
                // $data['outstanding'] = $this->outstanding_model->get_uptodaybalance($data['payment']['CODE']);
                $this->load->view('payment/edit', $data);
                $this->load->view('footer');
        }
    }

    public function update_status($code = FALSE, $TrueFalse = FALSE) {
        $this->payment_model->set_payrecord_by_manu($code, $TrueFalse);
        redirect('/genmfree/view/', 'refresh');
    }

    public function update_status2($code = FALSE, $TrueFalse = FALSE) {
        $this->payment_model->set_payrecord_by_manu2($code, $TrueFalse);
        redirect('/payment/view/', 'refresh');
    }

//    public function confirm_all_payment() {
//        $this->payment_model->set_payrecord_confirm_all();
//        redirect('/payment/view/', 'refresh');
//    }

    public function unpresent_cheque($paymentno = false) {
        $this->payment_model->set_unpresentcheque($paymentno);
        redirect('/payment/view/', 'refresh');
    }

    public function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//payment//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
           $this->form_validation->set_rules('code2', 'code2', 'required');
        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('payment/create');
                $this->load->view('footer');
            } else {

                $this->payment_model->set_payrecord_barcode();  //   insert payment record to tables
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('payment/create');
                $this->load->view('footer');
            }
        } else {
            //redirect('/payment/view/', 'refresh');
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('payment/create');
            $this->load->view('footer');
        }
    }

}

?>
