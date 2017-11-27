<?php

class Ownercarpark_driver  extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('driver_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function create($code = FALSE) {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//ownercarpark_driver//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $data['code'] = $code;
                $data['error'] = '';
                $this->load->view('ownercarpark_driver/create', $data);
                $this->load->view('footer');
            } else {
                $code = $this->input->post('code');
                if ($this->driver_model->set_carparkowner() == FALSE) {
                    $this->load->view('header');
                    $this->load->view('menu');
                    $data['code'] = $code;
                    $data['error'] = 'existing properity code';
                    $this->load->view('ownercarpark_driver/create', $data);
                    $this->load->view('footer');
     
                } else {
                    redirect('/ownercarpark/edit/' . $code, 'refresh');
                }
            }
        } else {
            $code = $this->input->post('code');
              redirect('/ownercarpark/edit/' . $code, 'refresh');
        }
    }



}

?>
