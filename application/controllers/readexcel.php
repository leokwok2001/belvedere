<?php

class Readexcel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('payment_model');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('csvreader');
    }

    function readExcel() {

        $result = $this->csvreader->parse_file('uploads/Test.csv'); //path to csv file

        $data['csvData'] = $result;

        $this->payment_model->set_payrecord_batch($data['csvData']);

        redirect('/payment/view/', 'refresh');
        // echo print_r($data);
        //  $this->load->view('view_csv', $data);
    }

    function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//readexcel//' . $page . '.php')) {
            show_404();
        }

        //$this->load->library('form_validation');
        //$this->form_validation->set_rules('userfile', 'Userfile', 'required');

        if ($this->input->post('function') !== 'back') {

            if (!empty($_FILES['userfile']['name'])) {
                $aa = $this->upload_files();
                $this->readExcel();
            } else {
                $aa = "";
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('readexcel/create');
                $this->load->view('footer');
            }
        } else {
            redirect('/payment/view/', 'refresh');
        }
    }

    private function upload_files() {
        $csvfilepath = '';
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'csv';
        $config['overwrite'] = 1;
        $config['file_name'] = 'Test.csv';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            $file_info = $this->upload->data();
            $csvfilepath = "uploads/" . $file_info['file_name'];
        }

        //return URL . $config['upload_path'] . "/" . str_replace(".jpg", "_.jpg", $config['file_name']);
        return URL . $csvfilepath;
    }

}

?>
