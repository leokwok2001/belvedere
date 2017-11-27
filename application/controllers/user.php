<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //   $this->lang->load('message','chinese');
        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function login() {

        $page = 'login';
        if (!file_exists(APPPATH . 'views//user//' . $page . '.php')) {
            show_404();
        }

        $this->load->view('user/login');
    }

    public function check_login() {
        $data['user'] = $this->user_model->get_user();
        if (empty($data['user'])) {
            redirect('/user/login/', 'refresh');
        } else {
            $this->session->set_userdata("LOGIN_NAME", $data['user']['USERNAME']);
            $this->session->set_userdata("BAN_CODE", $data['user']['BAN_CODE']);
            redirect('/resident/view/', 'refresh');
        }
    }

    public function logout() {

       //$this->session->sess_destroy();
       
       $this->session->destroy();
        redirect('/user/login/', 'refresh');
    }

}

?>
