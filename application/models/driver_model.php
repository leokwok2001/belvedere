<?php

class Driver_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_driver($code = FALSE) {
        // get all data
        if ($code === FALSE) {
            $code = $this->input->post('code');
            $basement_1 = $this->input->post('basement_1');
            $basement_2 = $this->input->post('basement_2');
            $this->db->select('B_view_Driver.OWNERCODE,'
                    . 'B_view_Driver.CARPARK,'
                    . 'B_view_Driver.NAME1,'
                    . 'B_view_Driver.NAME2,'
                    . 'B_view_Driver.CNAME1,'
                    . 'B_view_Driver.CNAME2,'
                    . 'B_view_Driver.TEL,'
                    . 'B_view_Driver.ADDRESS1,'
                    . 'B_view_Driver.ADDRESS2,'
                    . 'B_view_Driver.ADDRESS3,'
                    . 'B_view_Driver.ADDRESS4,'
                    . 'B_view_Driver.BAN_CODE,'
                    . 'B_view_Driver.EMAIL,'
                    . 'B_view_Driver.PAYTYPE,'
                    . 'B_view_Driver.PAYREF,'
                    . 'B_view_Driver.NAME11,'
                    . 'B_view_Driver.NAME22,'
                    . 'B_view_Driver.NAME33,'
                    . 'B_view_Driver.TEL11,'
                    . 'B_view_Driver.TEL22,'
                    . 'B_view_Driver.TEL33,'
                    . 'B_view_Driver.TEL44,'
                    . 'B_view_Driver.ISPRINT'
            );
            $this->db->from('B_view_Driver');
            if ($code !== FALSE && $code !== '') {
                $this->db->Where('B_view_Driver.CARPARK', $code);
            }

            if ($basement_1 !== FALSE && $basement_1 !== '') {
                $this->db->Where('SUBSTRING(B_view_Driver.CARPARK,1,2)', $basement_1);
            }

            if ($basement_2 !== FALSE && $basement_2 !== '') {
                $this->db->Where('SUBSTRING(B_view_Driver.CARPARK,4,3)', $basement_2);
            }

            $this->db->where('B_view_Driver.BAN_CODE', $this->session->userdata("BAN_CODE"));
            $this->db->order_by('B_view_Driver.CARPARK');
            return $this->db->get()->result_array();
        }

        $this->db->select('*');
        $this->db->from('B_view_Driver');
        $this->db->Where('B_view_Driver.CARPARK', $code);
        $this->db->where('B_view_Driver.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("B_view_Driver.CARPARK");
        return $this->db->get()->row_array();
    }

    public function get_carpark_by_owner($ownercode = FALSE) {
        // get  data by owner code
        $this->db->select('*');
        $this->db->from('B_Driver');
        $this->db->Where('B_Driver.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('B_Driver.OWNERCODE', $ownercode);
        $this->db->where('B_Driver.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("B_Driver.OWNERCODE");
        return $this->db->get()->result_array();
    }

    public function remove_carparkowner($code = false) {
        $data = array(
            'OWNERCODE' => ''
        );
        $this->db->where('CARPARK', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_Driver', $data);
    }

    public function set_carparkowner() {
        $this->db->select('count(*) as count1');
        $this->db->from('B_Driver');
        $this->db->Where('CARPARK', $this->input->post('propertycode'));
        $this->db->Where("OWNERCODE !=''");
        $this->db->Where('B_Driver.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $tmp1 = $this->db->get()->row_array();
        if ($tmp1['count1'] > 0) {
            return FALSE;
        }

        $data = array('OWNERCODE' => $this->input->post('code')
        );
        $code = $this->input->post('propertycode');
        $this->db->where('CARPARK', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->Where('B_Driver.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_Driver', $data);
        return TRUE;
    }

    public function set_driver() {
        $this->load->helper('url');


        $data = array(
            'CARPARK' => $this->input->post('code'),
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'CNAME1' => $this->input->post('cname1'),
            'CNAME2' => $this->input->post('cname2'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'REMARKS' => $this->input->post('remarks'),
            'TEL' => $this->input->post('tel'),
            'EMAIL' => $this->input->post('email'),
            'PAYTYPE' => $this->input->post('paytype'),
            'PAYREF' => $this->input->post('payref'),
            'ISPRINT' => $this->input->post('isprint'),
            'CREATEDATE' => date("Y-m-d"),
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->insert('B_Driver', $data);
    }

    public function delete_driver() {
        $code = $this->input->post('code');
        $data = array(
            'DELETEDATE' => date("Y-m-d h:i:s"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('CARPARK', $code);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_Driver', $data);
    }

    public function update_driver() {
        $code = $this->input->post('code');
        $data = array(
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'CNAME1' => $this->input->post('cname1'),
            'CNAME2' => $this->input->post('cname2'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'REMARKS' => $this->input->post('remarks'),
            'TEL' => $this->input->post('tel'),
            'EMAIL' => $this->input->post('email'),
            'PAYTYPE' => $this->input->post('paytype'),
            'PAYREF' => $this->input->post('payref'),
            'MODIFYDATE' => date("Y-m-d"),
            'ISPRINT' => $this->input->post('isprint'),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('CARPARK', $code);
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_Driver', $data);
    }

}
