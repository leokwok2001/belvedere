<?php

class Outstanding_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_outstanding_rpt($case = false) {


        switch ($case) {

            case 'BLOCK':
                $this->db->select('BLOCK,SUM(P_OUTSTAND) AS P_OUTSTAND');
                $this->db->from('B_view_uptodaybalance');
                $this->db->group_by('BLOCK');

                break;
            default:

                $this->db->select('CODE,BLOCK,UNIT,FLOOR,NAME1,NAME2,TEL,P_OUTSTAND');
                $this->db->from('B_view_uptodaybalance');
                $this->db->order_by("BLOCK,UNIT,FLOOR");
        }

        return $this->db->get()->result_array();
    }

    public function get_uptodaybalance($code = false) {

        $this->db->select('*');
        $this->db->from('B_view_uptodaybalance');
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("CODE");
        //  $this->db->where('B_view_uptodaybalance.BAN_CODE', $this->session->userdata("BAN_CODE"));
        //$query = $this->db->get_where('B_view_uptodaybalance', array('CODE' => $code));
        return $this->db->get()->row_array();
    }

}
