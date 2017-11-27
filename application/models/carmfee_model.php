<?php

class Carmfee_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_carmfee($seq = FALSE) {
        // get all data

        $this->db->select('*');
        $this->db->from('B_Car_manfree');
        $this->db->Where('B_Car_manfree.ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('ISDELETE', 0);

        if ($seq === FALSE) {

            $this->db->order_by("SEQ");
            return $this->db->get()->result_array();
        }

        // get data by $code
        $this->db->Where('B_Car_manfree.SEQ', $seq);
        $this->db->order_by("B_Car_manfree.SEQ");
        return $this->db->get()->row_array();
    }

    public function delete_carmfee() {

        $seq = $this->input->post('seq');
        $data = array(
            'ISDELETE' => 1,
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_Car_manfree', $data);
    }

    public function get_carmfee_rpt() {
        // get all data
        $this->db->select('SEQ,FEE,EFF_DATE,CARPARK');
        $this->db->from('B_Car_manfree');
        $this->db->Where('ISDELETE', 0);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("SEQ");
        return $this->db->get()->result_array();
    }

    public function set_carmfee() {
        $this->load->helper('url');
        $data = array(
        
            'FEE' => $this->input->post('fee'),
            'EFF_DATE' => $this->input->post('eff_date'),
            'CREATEDATE' => date("Y-m-d"),
            'ISDELETE' => 0,
            'CARPARK' =>'NIL',
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->insert('B_Car_manfree', $data);
    }

    public function update_carmfee() {
        $seq = $this->input->post('seq');
        $data = array(
            'FEE' => $this->input->post('fee'),
            'EFF_DATE' => $this->input->post('eff_date'),
            'MODIFYDATE' => date("Y-m-d"),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('SEQ', $seq);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_Car_manfree', $data);
    }

}
