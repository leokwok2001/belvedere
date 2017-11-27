<?php

class Driver extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('driver_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view($page = 'view') {
        if (!file_exists(APPPATH . 'views//driver//' . $page . '.php')) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('menu');
        $data['driver'] = $this->driver_model->get_driver();
        $this->load->view('driver/view', $data);
        $this->load->view('footer');
    }

    public function unlink($code = FALSE, $ownercode = FALSE) {
        $this->driver_model->remove_carparkowner($code);
       
        redirect('/ownercarpark/edit/' . $ownercode, 'refresh');
    }

    public function edit($code = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//driver//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {

            case "payrecord_create";
                $key = $this->input->post('code');
                redirect('/driver/create_copy/' . $key, 'refresh');
                break;
            case "back":
                redirect('/driver/view/', 'refresh');
                break;

            case "update":
                $this->driver_model->update_driver();
                redirect('/driver/view/', 'refresh');
                break;
            case "delete":
                $this->driver_model->delete_driver();
                redirect('/driver/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['driver'] = $this->driver_model->get_driver($code);
    
                $this->load->view('driver/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create($page = 'create') {

        if (!file_exists(APPPATH . 'views//driver//' . $page . '.php')) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('name1', 'name1', 'required');


        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('driver/create');
                $this->load->view('footer');
            } else {

                if (!empty($_FILES['userfile']['name'])) {
                    $aa = $this->upload_files();
                } else {
                    $aa = "";
                }

                // print_r($_FILES['userfile']);
                //   $aa=$this->upload_files();
                $this->driver_model->set_driver($aa);
                redirect('/driver/view/', 'refresh');
            }
        } else {
            redirect('/driver/view/', 'refresh');
        }
    }

    public function create_copy($seq = FALSE) {

        $page = 'create_copy';
        if (!file_exists(APPPATH . 'views//driver//' . $page . '.php')) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');

        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $data['outstanding'] = $this->outstanding_model->get_uptodaybalance($seq);
                $data['payment'] = array("CODE" => $seq);
                //$this->input->post('code')


                $this->load->view('driver/create_copy', $data);
                $this->load->view('footer');
            } else {
                $this->payment_model->set_payrecord();
                redirect('/driver/view/', 'refresh');
            }
        } else {
            redirect('/driver/view/', 'refresh');
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
