<?php

class Resident extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('resident_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view($page = 'view') {
        if (!file_exists(APPPATH . 'views//resident//' . $page . '.php')) {
            show_404();
        }

        $this->load->view('header');
        $this->load->view('menu');
        $data['resident'] = $this->resident_model->get_resident();
        $this->load->view('resident/view', $data);
        $this->load->view('footer');
    }

    public function unlink($code = FALSE, $ownercode = FALSE) {
        $this->resident_model->remove_propertyowner($code);
        redirect('/owner/edit/' . $ownercode, 'refresh');
    }

    public function edit($code = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//resident//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {

            case "payrecord_create";
                $key = $this->input->post('code');
                redirect('/resident/create_copy/' . $key, 'refresh');
                break;
            case "back":
                redirect('/resident/view/', 'refresh');
                break;

            case "update":
                $this->resident_model->update_resident();
                redirect('/resident/view/', 'refresh');
                break;
            case "delete":
                $this->resident_model->delete_resident();
                redirect('/resident/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['resident'] = $this->resident_model->get_resident($code);
          //      $data['genmfree'] = $this->genmfree_model->get_mfree_statment_by_resident($code);
         //       $data['payment'] = $this->payment_model->get_payrecord_resident($code);
         //      $data['outstanding'] = $this->outstanding_model->get_uptodaybalance($code);
            //    $data['carowns'] = $this->carowns_model->get_carowns_resident($code);
                $this->load->view('resident/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create($page = 'create') {

        if (!file_exists(APPPATH . 'views//resident//' . $page . '.php')) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('code', 'code', 'required');
        $this->form_validation->set_rules('name1', 'name1', 'required');
        $this->form_validation->set_rules('name2', 'name2', 'required');
        $this->form_validation->set_rules('tel', 'tel', 'required');
        $this->form_validation->set_rules('block', 'block', 'required');
        $this->form_validation->set_rules('unit', 'unit', 'required');
        $this->form_validation->set_rules('floor', 'floor', 'required');
        $this->form_validation->set_rules('building', 'building', 'required');

        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('resident/create');
                $this->load->view('footer');
            } else {

                if (!empty($_FILES['userfile']['name'])) {
                    $aa = $this->upload_files();
                } else {
                    $aa = "";
                }

                // print_r($_FILES['userfile']);
                //   $aa=$this->upload_files();
                $this->resident_model->set_resident($aa);
                redirect('/resident/view/', 'refresh');
            }
        } else {
            redirect('/resident/view/', 'refresh');
        }
    }

    public function create_copy($seq = FALSE) {

        $page = 'create_copy';
        if (!file_exists(APPPATH . 'views//resident//' . $page . '.php')) {
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


                $this->load->view('resident/create_copy', $data);
                $this->load->view('footer');
            } else {
                $this->payment_model->set_payrecord();
                redirect('/resident/view/', 'refresh');
            }
        } else {
            redirect('/resident/view/', 'refresh');
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
