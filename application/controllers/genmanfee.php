<?php

class Genmanfee extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('genmanfee_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {

        $page = 'view';
        if (!file_exists(APPPATH . 'views//genmanfee//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $data['genmanfee'] = $this->genmanfee_model->get_manfee_statment();
        $this->load->view('genmanfee/view', $data);
        $this->load->view('footer');
    }

    public function edit($key = FALSE) {
       $page = 'edit';
        if (!file_exists(APPPATH . 'views//genmanfee//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "print":
                //echo $key;
                $code = $this->input->post('code');
                redirect('/genmanfee_batch_rpt/create_pdf/' . $code, 'refresh');
                break;
            case "payrecord_create";
                $key = $this->input->post('code');
                redirect('/payment/create_copy/' . $key, 'refresh');
                break;
            case "back":
                redirect('/genmanfee/view/', 'refresh');
                break;
            case "update":
                $this->genmanfee_model->update_genmanfee();
                redirect('/genmanfee/view/', 'refresh');
                break;
            case "delete":
                 $this->genmanfee_model->delete_genmanfee();
                redirect('/genmanfee/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['genmanfee'] = $this->genmanfee_model->get_manfee_statment($key);
                $this->load->view('genmanfee/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//genmanfee//' . $page . '.php')) {
            show_404();
        }

        $case = $this->input->post('function');
        switch ($case) {
            case "back":
                redirect('/genmanfee/view/', 'refresh');
                break;

            case "print":
                
                        
                
              $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('genmanfee/genmanfee_batch_rpt');
               $this->load->view('footer');
                        
                break;
            default:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('indate', 'indate', 'required');
                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('header');
                    $this->load->view('menu');
                    $this->load->view('genmanfee/create');
                    $this->load->view('footer');
                } else {
                    $this->genmanfee_model->gen_manfee();
                    redirect('/genmanfee/view/', 'refresh');
                }
        }
    }
}

?>
