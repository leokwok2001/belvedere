<?php
// Home 單位管理 單位-管理費設定

class Mfree extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //   $this->lang->load('message','chinese');
        $this->load->model('mfree_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function view() {

        $page = 'view';
        if (!file_exists(APPPATH . 'views//mfree//' . $page . '.php')) {
            show_404();
        }
        $this->load->view('header');
        $this->load->view('menu');
        $data['mfree'] = $this->mfree_model->get_mfree();
        $this->load->view('mfree/view', $data);
        $this->load->view('footer');
    }

    public function edit($seq = FALSE) {

        $page = 'edit';
        if (!file_exists(APPPATH . 'views//mfree//' . $page . '.php')) {
            show_404();
        }
        $case = $this->input->post('function');
        switch ($case) {
            case "back":
                redirect('/mfree/view/', 'refresh');
                break;
            case "update":
                $this->mfree_model->update_mfree();
                redirect('/mfree/view/', 'refresh');
                break;
            case "delete":
                //$seq = $this->input->post('seq');
                //  $this->db->delete('B_ResManFree', array('SEQ' => $seq));
                $this->mfree_model->delete_mfree();
                redirect('/mfree/view/', 'refresh');
                break;
            default:
                $this->load->view('header');
                $this->load->view('menu');
                $data['mfree'] = $this->mfree_model->get_mfree($seq);
                $this->load->view('mfree/edit', $data);
                $this->load->view('footer');
        }
    }

    public function create() {
        $page = 'create';
        if (!file_exists(APPPATH . 'views//mfree//' . $page . '.php')) {
            show_404();
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('unit', 'unit', 'required');
        $this->form_validation->set_rules('free', 'free', 'required');
        $this->form_validation->set_rules('eff_date', 'building', 'required');
        if ($this->input->post('function') !== 'back') {
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('header');
                $this->load->view('menu');
                $this->load->view('mfree/create');
                $this->load->view('footer');
            } else {
                $this->mfree_model->set_mfree();
                redirect('/mfree/view/', 'refresh');
            }
        } else {
            redirect('/mfree/view/', 'refresh');
        }
    }

}

?>
