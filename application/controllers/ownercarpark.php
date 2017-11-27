<?php

class Ownercarpark extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ownercarpark_model');
        $this->load->model('driver_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view($page = 'view') {
        if (!file_exists(APPPATH . 'views//ownercarpark//' . $page . '.php')) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('menu');
        $data['ownercarpark'] = $this->ownercarpark_model->get_owner();
        $this->load->view('ownercarpark/view', $data);
        $this->load->view('footer');
    }

    public function edit($code = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//ownercarpark//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {

            case "back":
                redirect('/ownercarpark/view/', 'refresh');
                break;
            case "update":
                $this->ownercarpark_model->update_owner();
                redirect('/ownercarpark/view/', 'refresh');
                break;
            case "delete":
                $this->ownercarpark_model->delete_owner();
                redirect('/ownercarpark/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['ownercarpark'] = $this->ownercarpark_model->get_owner($code);
                $data['carpark'] = $this->driver_model->get_carpark_by_owner($code);
                $this->load->view('ownercarpark/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create($page = 'create') {

        if (!file_exists(APPPATH . 'views//ownercarpark//' . $page . '.php')) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('name1', 'name1', 'required');


        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('ownercarpark/create');
                $this->load->view('footer');
            } else {

                if (!empty($_FILES['userfile']['name'])) {
                    $aa = $this->upload_files();
                } else {
                    $aa = "";
                }

                $this->ownercarpark_model->set_owner($aa);
                redirect('/ownercarpark/view/', 'refresh');
            }
        } else {
            redirect('/ownercarpark/view/', 'refresh');
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
