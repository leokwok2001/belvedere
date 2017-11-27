<?php

class Resident_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_resident($code = FALSE) {
        // get all data
        if ($code === FALSE) {

            $code = $this->input->post('code');
            $unit = $this->input->post('unit');
            $floor = $this->input->post('floor');
            $block = $this->input->post('block');
            $outstand = $this->input->post('outstand');
            $this->db->select('B_view_resident.CODE,'
                    . 'B_view_resident.NAME1,'
                    . 'B_view_resident.NAME2,'
                    . 'B_view_resident.BLOCK,'
                      . 'B_view_resident.TEL,'
                    . 'B_view_resident.UNIT,'
                    . 'B_view_resident.FLOOR,'
                    . 'B_view_resident.BUILDING,'
                    . 'B_view_resident.BAN_CODE,'
                    . 'B_view_resident.PHOTO1,'
                    . 'B_view_resident.EMAIL,'
                    . 'B_view_resident.PAYTYPE,'
                    . 'B_view_resident.CODE11,'
                    . 'B_view_resident.NAME11,'
                    . 'B_view_resident.NAME22,'
                    . 'B_view_resident.NAME33,'
                    . 'B_view_resident.CNAME11,'
                    . 'B_view_resident.CNAME22,'
                    . 'B_view_resident.CNAME33,'
                    . 'B_view_resident.TEL11,'
                    . 'B_view_resident.TEL22,'
                    . 'B_view_resident.TEL33,'
                    . 'B_view_resident.TEL44'
            );
            $this->db->from('B_view_resident');

            if ($code !== FALSE && $code !== '') {
                $this->db->Where('B_view_resident.CODE', $code);
            }

            if ($unit !== FALSE && $unit !== '') {
                $this->db->Where('B_view_resident.UNIT', $unit);
            }

            if ($floor !== FALSE && $floor !== '') {
                $this->db->Where('B_view_resident.FLOOR', $floor);
            }

            if ($block !== FALSE && $block !== '') {
                $this->db->Where('B_view_resident.BLOCK', $block);
            }

           /* if ($outstand !== FALSE && $outstand !== '') {
                $this->db->Where('B_view_uptodaybalance.P_OUTSTAND >=', $outstand);
            }*/


            //$this->db->Where('B_view_resident.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->where('B_view_resident.BAN_CODE', $this->session->userdata("BAN_CODE"));
            $this->db->order_by('B_view_resident.CODE');
            return $this->db->get()->result_array();
        }

        $this->db->select('*');
        $this->db->from('B_view_resident');
     
        $this->db->Where('B_view_resident.CODE', $code);
        $this->db->where('B_view_resident.BAN_CODE', $this->session->userdata("BAN_CODE"));

        $this->db->order_by("B_view_resident.CODE");
        return $this->db->get()->row_array();
    }

    public function get_resident_by_owner($ownercode = FALSE) {
        // get  data by owner code
        $this->db->select('*');
        $this->db->from('B_resident');
        $this->db->Where('B_resident.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('B_resident.OWNERCODE', $ownercode);
        $this->db->where('B_resident.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("B_resident.CODE");
        return $this->db->get()->result_array();
    }

    public function get_resident_rpt() {

        // get all data

        $this->db->select('CODE,NAME1,NAME2,TEL');
        $this->db->from('B_resident');
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->Where('B_resident.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->order_by("CODE");
        return $this->db->get()->result_array();
    }

    public function remove_propertyowner($code = false) {

        $data = array(
            'OWNERCODE' => ''
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_resident', $data);
    }

    public function set_propertyowner() {
        $this->db->select('count(*) as count1');
        $this->db->from('B_resident');
        $this->db->Where('CODE', $this->input->post('propertycode'));
        $this->db->Where("OWNERCODE !=''");
        $this->db->Where('B_resident.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $tmp1 = $this->db->get()->row_array();
        if ($tmp1['count1'] > 0) {
            return FALSE;
        }

        $data = array('OWNERCODE' => $this->input->post('code')
        );
        $code = $this->input->post('propertycode');
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
            $this->db->Where('B_resident.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_resident', $data);
        return TRUE;
    }

    public function set_resident($photo1) {
        $this->load->helper('url');
        $data = array(
            'CODE' => $this->input->post('code'),
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'TEL' => $this->input->post('tel'),
            'BLOCK' => $this->input->post('block'),
            'UNIT' => $this->input->post('unit'),
            'FLOOR' => $this->input->post('floor'),
            'BUILDING' => $this->input->post('building'),
            'PHOTO1' => $photo1,
            'EMAIL' => $this->input->post('email'),
            'PAYTYPE' => $this->input->post('paytype'),
            'CREATEDATE' => date("Y-m-d"),
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->insert('B_resident', $data);
    }

    public function delete_resident() {
        $code = $this->input->post('code');
        $data = array(
            'DELETEDATE' => date("Y-m-d h:i:s"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('CODE', $code);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_resident', $data);


    }

    public function update_resident() {
        $code = $this->input->post('code');
        $data = array(
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'TEL' => $this->input->post('tel'),
            'BLOCK' => $this->input->post('block'),
            'UNIT' => $this->input->post('unit'),
            'FLOOR' => $this->input->post('floor'),
            'BUILDING' => $this->input->post('building'),
            'EMAIL' => $this->input->post('email'),
            'PAYTYPE' => $this->input->post('paytype'),
            'MODIFYDATE' => date("Y-m-d"),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
         $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_resident', $data);
    }

}
