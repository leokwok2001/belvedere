<?php

class carmfee extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('carmfee_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {

        $page = 'view';
        if (!file_exists(APPPATH . 'views//carmfee//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $data['carmfee'] = $this->carmfee_model->get_carmfee();
        $this->load->view('carmfee/view', $data);
        $this->load->view('footer');
    }

    public function edit($seq = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//carmfee//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "back":
                redirect('/carmfee/view/', 'refresh');
                break;
            case "update":
                $this->carmfee_model->update_carmfee();
                redirect('/carmfee/view/', 'refresh');
                break;
            case "delete":
                
                $this->carmfee_model->delete_carmfee();
                redirect('/carmfee/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['carmfee'] = $this->carmfee_model->get_carmfee($seq);
                $this->load->view('carmfee/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//carmfee//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('fee', 'fee', 'required');
        $this->form_validation->set_rules('eff_date', 'building', 'required');
        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('carmfee/create');
                $this->load->view('footer');
            } else {
                $this->carmfee_model->set_carmfee();
                redirect('/carmfee/view/', 'refresh');
            }
        } else {
            redirect('/carmfee/view/', 'refresh');
        }
    }

}

?>
