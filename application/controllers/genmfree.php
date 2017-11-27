<?php

class Genmfree extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('genmfree_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {

        $page = 'view';
        if (!file_exists(APPPATH . 'views//genmfree//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $data['genmfree'] = $this->genmfree_model->get_mfree_statment();
        //$data['Type'] = $Type;
//        
        $this->load->view('genmfree/view', $data);
        $this->load->view('footer');
    }

    public function edit($key = FALSE) {
        $page = 'edit';
        if (!file_exists(APPPATH . 'views//genmfree//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "print":
                //echo $key;
                $code = $this->input->post('code');
                redirect('/genmfree_batch_rpt/create_pdf/' . $code, 'refresh');
                break;
            case "payrecord_create";
                $key = $this->input->post('code');
                redirect('/payment/create_copy/' . $key, 'refresh');
                break;
            case "back":
                redirect('/genmfree/view/', 'refresh');
                break;
            case "update":
                $this->genmfree_model->update_genmfree();
                redirect('/genmfree/view/', 'refresh');
                break;
            case "delete":
                $this->genmfree_model->delete_genmfree();
                redirect('/genmfree/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['genmfree'] = $this->genmfree_model->get_mfree_statment($key);
                $this->load->view('genmfree/edit', $data);
                $this->load->view('footer');
        }
    }

    public function manu() {
        $page = 'manu';
        if (!file_exists(APPPATH . 'views//genmfree//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('mdate', 'mdate', 'required');
        $this->form_validation->set_rules('res_code', 'res_code', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header');
            $this->load->view('menu');
            $this->load->view('genmfree/manu');
            $this->load->view('footer');
        } else {
            $this->genmfree_model->set_mfree_statment();
            redirect('/genmfree/manu/', 'refresh');
        }
    }

    public function locadownerinfo() {
        header('Content-type: application/json');
        $code1 = $this->input->post('code1');
        // $code1 ='116C';
        $data['ownerinfo'] = $this->genmfree_model->get_ownerinfo($code1);
        if (!empty($data['ownerinfo'])) {
            echo json_encode($data['ownerinfo']);
        } else {
            echo 'empty!';
        }
    }

    function attachment() {
        $page = 'attachment';
        if (!file_exists(APPPATH . 'views//genmfree//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $this->load->view('genmfree/attachment');
        $this->load->view('footer');
    }

    function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//genmfree//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "back":
                redirect('/genmfree/view/', 'refresh');
                break;
            case "print":
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('genmfree/genmfree_batch_rpt');
                $this->load->view('footer');
                break;
            default:
                $this->load->library('form_validation');
                $this->form_validation->set_rules('mdate', 'mdate', 'required');
                if ($this->form_validation->run() === FALSE) {
                    $this->load->view('header');
                    $this->load->view('menu');
                    $this->load->view('genmfree/create');
                    $this->load->view('footer');
                } else {
                    $data['error'] = $this->genmfree_model->gen_mfree();
                    if ($data['error'] == '001') {
                        //redirect('/genmfree/create/',$data );
                        $this->load->view('header');
                        $this->load->view('menu');
                        $this->load->view('genmfree/create', $data);
                        $this->load->view('footer');
                    } else {
                        redirect('/genmfree/view/', 'refresh');
                    }
                }
        }
    }

}

?>
