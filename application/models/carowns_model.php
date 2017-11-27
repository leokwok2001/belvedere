<?php

class Carowns_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_carowns($locations = FALSE) {
        // get all data

        $this->db->select('*');
        $this->db->from('B_CarOwns');
        $this->db->Where('B_CarOwns.ISDELETE', 0);
        $this->db->where('B_CarOwns.BAN_CODE', $this->session->userdata("BAN_CODE"));
        if ($locations === FALSE) {
            $this->db->order_by("LOCATIONS");
            return $this->db->get()->result_array();
        }
        // get data by $code
        $this->db->Where('B_CarOwns.LOCATIONS', $locations);
        return $this->db->get()->row_array();
    }

    public function get_carowns_resident($code = FALSE) {

        $this->db->select('*');
        $this->db->from('B_CarOwns');
        $this->db->Where('CODE', $code);  /* key */
        $this->db->Where('ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("LOCATIONS");
        return $this->db->get()->result_array();
    }

    public function get_carowns_by_owner($ownercode = FALSE) {

        $this->db->select('*');
        $this->db->from('B_CarOwns');
        $this->db->Where('OWNERCODE', $ownercode);  /* key */
        $this->db->Where('ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("LOCATIONS");
        return $this->db->get()->result_array();
    }

    public function set_carowns() {
        $this->load->helper('url');
        $this->db->select('count(*) as count1');
        $this->db->from('B_CarOwns');
        $this->db->Where('LOCATIONS', $this->input->post('locations'));
        $this->db->Where('ISDELETE', 0);
        $this->db->Where('BAN_CODE', $this->session->userdata('BAN_CODE'));

        $tmp1 = $this->db->get()->row_array();
        if ($tmp1['count1'] > 0) {
            return FALSE;
        }

        $data = array('LOCATIONS' => $this->input->post('locations'),
            'CREATEDATE' => date("Y-m-d"),
            'ISDELETE' => 0,
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE"),
            'OWNERCODE' => $this->input->post('code')
        );
        $this->db->insert('B_CarOwns', $data);
        return TRUE;
    }

    public function update_carowns() {
        $seq = $this->input->post('seq');
        $data = array(
            'LOCATIONS' => $this->input->post('locations'),
            'MODIFYDATE' => date("Y-m-d"),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_CarOwns', $data);
    }

    public function delete_carowns() {
        $seq = $this->input->post('seq');
        $data = array(
            'ISDELETE' => 1,
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_CarOwns', $data);
    }

}
