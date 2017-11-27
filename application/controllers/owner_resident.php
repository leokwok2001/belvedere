<?php

class Owner_resident  extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('resident_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function create($code = FALSE) {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//owner_resident//' . $page . '.php')) {
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
                $this->load->view('owner_resident/create', $data);
                $this->load->view('footer');
            } else {
                $code = $this->input->post('code');
                if ($this->resident_model->set_propertyowner() == FALSE) {
                    $this->load->view('header');
                    $this->load->view('menu');
                    $data['code'] = $code;
                    $data['error'] = 'existing properity code';
                    $this->load->view('owner_resident/create', $data);
                    $this->load->view('footer');
     
                } else {
                    redirect('/owner/edit/' . $code, 'refresh');
                }
            }
        } else {
            $code = $this->input->post('code');
              redirect('/owner/edit/' . $code, 'refresh');
        }
    }

    public function edit($propertycode = FALSE) {
        $page = 'edit';
        if (!file_exists(APPPATH . 'views//owner//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "back":
                $code = $this->input->post('code');
                redirect('/owner/edit/' . $code, 'refresh');
                break;
            case "update":
                $this->carowns_model->update_carowns();
                $code = $this->input->post('code');
                redirect('/owner/edit/' . $code, 'refresh');
                break;
            case "delete":
                $this->carowns_model->delete_carowns();
                $code = $this->input->post('code');
                redirect('/owner/edit/' . $code, 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['property'] = $this->resident_model->get_resident($propertycode);
                $this->load->view('owner_resident/edit', $data);
                $this->load->view('footer');
        }
    }

}

?>
