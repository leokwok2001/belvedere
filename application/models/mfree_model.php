<?php

class Mfree_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_mfree($seq = FALSE) {
        // get all data

        $this->db->select('*');
        $this->db->from('B_ResManFree');
        $this->db->Where('B_ResManFree.ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->Where('ISDELETE', 0);

        if ($seq === FALSE) {

            $this->db->order_by("SEQ");
            return $this->db->get()->result_array();
        }

        // get data by $code


        
        $this->db->Where('B_ResManFree.SEQ', $seq);
        $this->db->order_by("B_ResManFree.SEQ");
        return $this->db->get()->row_array();
    }

    public function delete_mfree() {

        $seq = $this->input->post('seq');
        $data = array(
            'ISDELETE' => 1,
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_ResManFree', $data);
    }

    public function get_mfree_rpt() {
        // get all data
        $this->db->select('SEQ,UNIT,FEE,EFF_DATE');
        $this->db->from('B_ResManFree');
        $this->db->Where('ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("SEQ");
        return $this->db->get()->result_array();
    }

    public function set_mfree() {
        $this->load->helper('url');
        $data = array(
            'UNIT' => $this->input->post('unit'),
            'FEE' => $this->input->post('free'),
            'DESCRIPTION' => $this->input->post('description'),
            'EFF_DATE' => $this->input->post('eff_date'),
            'CREATEDATE' => date("Y-m-d"),
            'ISDELETE' => 0,
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->insert('B_ResManFree', $data);
    }

    public function update_mfree() {
        $seq = $this->input->post('seq');
        $data = array(
            'UNIT' => $this->input->post('unit'),
            'FEE' => $this->input->post('free'),
            'DESCRIPTION' => $this->input->post('description'),
            'EFF_DATE' => $this->input->post('eff_date'),
            'MODIFYDATE' => date("Y-m-d"),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_ResManFree', $data);
    }

}
