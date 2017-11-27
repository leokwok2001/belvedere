<?php

class Comm_man_payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('comm_man_payment_model');
        $this->load->model('genmanfee_model');
       // $this->load->model('gencarmanfee_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {
        $page = 'view';
        if (!file_exists(APPPATH . 'views//comm_man_payment//' . $page . '.php')) {
            show_404();
        }
        //   echo $type;
        $this->load->view('header');
        $this->load->view('menu');
        $data['payment'] = $this->comm_man_payment_model->get_payrecord();

        $this->load->view('comm_man_payment/view', $data);
        $this->load->view('footer');
    }

    public function edit($key = FALSE) {
        $page = 'edit';
        if (!file_exists(APPPATH . 'views//comm_man_payment//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "print":

                      $code = $this->input->post('seq');
                     //redirect('/paymentreceipt_comm/create_pdf/' . $code, 'refresh');
                     
                      redirect('/comm_man_paymentreceipts/create_pdf_single/' . $code, 'refresh');
                break;

            case "back":
                redirect('/comm_man_payment/view/', 'refresh');
                break;
            case "update":
                $this->comm_man_payment_model->update_payrecord();
                redirect('/comm_man_payment/view/', 'refresh');
                break;
            case "delete":
                //  $code = $this->input->post('seq');
                //  $this->db->delete('B_PayRecord', array('PAYMENTNO' => $code));

                $this->comm_man_payment_model->delete_payrecord();
                redirect('/comm_man_payment/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['comm_man_payment'] = $this->comm_man_payment_model->get_payrecord($key);
                //        $data['outstanding'] = $this->outstanding_model->get_uptodaybalance($data['payment']['CODE']);
                $this->load->view('comm_man_payment/edit', $data);
                $this->load->view('footer');
        }
    }

//    public function update_status($code = FALSE, $TrueFalse = FALSE) {
//        $this->comm_man_payment_model->set_payrecord_by_manu($code, $TrueFalse);
//        redirect('/genmanfee/view/', 'refresh');
//    }

    public function update_status2($code = FALSE, $TrueFalse = FALSE) {
        $this->comm_man_payment_model->set_payrecord_by_manu2($code, $TrueFalse);
        redirect('/comm_man_payment/view/', 'refresh');
    }

    public function unpresent_cheque($paymentno = false,$type=false) {
        $this->comm_man_payment_model->set_unpresentcheque($paymentno ,$type);
        redirect('/comm_man_payment/view/', 'refresh');
    }

    public function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//comm_man_payment//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('bankacno', 'bankacno', 'required');
        
        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('comm_man_payment/create');
                $this->load->view('footer');
            } else {

                $this->comm_man_payment_model->set_payrecord_barcode();
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('comm_man_payment/create');
                $this->load->view('footer');
            }
        } else {
            //redirect('/payment/view/', 'refresh');
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('comm_man_payment/create');
            $this->load->view('footer');
        }
    }


}

?>
