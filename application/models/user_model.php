<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_user() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->select('*');
        $this->db->from('B_User');
       // $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->where('USERNAME', $username);
        $this->db->where('PASSWORD', $password);
        return $this->db->get()->row_array();
    }

}
