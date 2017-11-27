<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//require_once dirname(__FILE__) . '/php-excel/php-excel.class.php';
class Comm_bank_excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library("Excel_bankcrs1");
        $this->load->model('comm_man_payment_model');
        $this->load->model('payment_model');
    }

    public function create() {

        $mdate1 = $this->input->post('date1');
        $mdate2 = $this->input->post('date2');
       $bankacno = $this->input->post('bankacno');
        $datefromto = $mdate1 . ' 至' . $mdate2;
        $data['payment'] = $this->comm_man_payment_model->get_payrecord_bank_excel();
        $xls = new Excel_bankcrs1();
        $xls->BankCRS($data['payment'], $datefromto, 'NIL',$bankacno);
    }

    public function mfeecreate() {
        $cat1 = $this->input->post('cat1');
        $bankacno = $this->input->post('bankacno');
        $mdate1 = $this->input->post('date1');
        $mdate2 = $this->input->post('date2');
        $datefromto = $mdate1 . ' 至' . $mdate2;
        $data['payment'] = $this->payment_model->get_payrecord_bank_excel();
        $xls = new Excel_bankcrs1();
        $xls->BankMfee($data['payment'], $datefromto, $cat1, $bankacno);
    }

    public function mfeeview() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//mfee_bank_excel//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('mfee_bank_excel/create');
        $this->load->view('footer');
    }

    public function view() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//comm_bank_excel//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        //   $data['genmanfee'] = $this->genmanfee_model->get_manfee_statment();
        $this->load->view('comm_bank_excel/create');
        $this->load->view('footer');
    }

}

?>