<?php

class Owner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('owner_model');
        $this->load->model('resident_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view($page = 'view') {
        if (!file_exists(APPPATH . 'views//owner//' . $page . '.php')) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('menu');
        $data['owner'] = $this->owner_model->get_owner();
        $this->load->view('owner/view', $data);
        $this->load->view('footer');
    }

    public function edit($code = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//owner//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {

            case "back":
                redirect('/owner/view/', 'refresh');
                break;
            case "update":
                $this->owner_model->update_owner();
                redirect('/owner/view/', 'refresh');
                break;
            case "delete":
                $this->owner_model->delete_owner();
                redirect('/owner/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['owner'] = $this->owner_model->get_owner($code);
                $data['resident'] = $this->resident_model->get_resident_by_owner($code);
             //   $data['carpark'] = $this->carpark_model->get_carpark_by_owner($code);
                $this->load->view('owner/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create($page = 'create') {

        if (!file_exists(APPPATH . 'views//owner//' . $page . '.php')) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('name1', 'name1', 'required');
        $this->form_validation->set_rules('tel', 'tel', 'required');

        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('owner/create');
                $this->load->view('footer');
            } else {

                if (!empty($_FILES['userfile']['name'])) {
                    $aa = $this->upload_files();
                } else {
                    $aa = "";
                }

                $this->owner_model->set_owner($aa);
                redirect('/owner/view/', 'refresh');
            }
        } else {
            redirect('/owner/view/', 'refresh');
        }
    }

    private function upload_files() {
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = 1;
        $config['file_name'] = uniqid('belvedere', true) . '.jpg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        return URL . $config['upload_path'] . "/" . str_replace(".jpg", "_.jpg", $config['file_name']);
    }

}

?>
