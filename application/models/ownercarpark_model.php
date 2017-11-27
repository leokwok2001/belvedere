<?php

class Ownercarpark_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_owner($code = FALSE) {
        // get all data
        if ($code === FALSE) {
            $code = $this->input->post('code');
            $basement_1 = $this->input->post('basement_1');
            $basement_2 = $this->input->post('basement_2');

            $this->db->select('B_view_OwnerCarPark.CODE,'
                    . 'B_view_OwnerCarPark.NAME1,'
                    . 'B_view_OwnerCarPark.NAME2,'
                    . 'B_view_OwnerCarPark.NAME3,'
                    . 'B_view_OwnerCarPark.CNAME1,'
                    . 'B_view_OwnerCarPark.CNAME2,'
                    . 'B_view_OwnerCarPark.CNAME3,'
                    . 'B_view_OwnerCarPark.TEL,'
                    . 'B_view_OwnerCarPark.TEL1,'
                    . 'B_view_OwnerCarPark.TEL2,'
                    . 'B_view_OwnerCarPark.TEL3,'
                    . 'B_view_OwnerCarPark.ADDRESS1,'
                    . 'B_view_OwnerCarPark.ADDRESS2,'
                    . 'B_view_OwnerCarPark.ADDRESS3,'
                    . 'B_view_OwnerCarPark.ADDRESS4,'
                    . 'B_view_OwnerCarPark.BAN_CODE,'
                    . 'B_view_OwnerCarPark.PHOTO1,'
                    . 'B_view_OwnerCarPark.EMAIL,'
                    . 'B_view_OwnerCarPark.REMARKS,'
                    . 'B_view_OwnerCarPark.POST,'
                    . 'B_view_OwnerCarPark.CARPARK,'
                    . 'B_view_OwnerCarPark.NAME11,'
                    . 'B_view_OwnerCarPark.NAME22,'
                    . 'B_view_OwnerCarPark.TEL11,'
                    . 'B_view_OwnerCarPark.ADDRESS11,'
                    . 'B_view_OwnerCarPark.ADDRESS22,'
                    . 'B_view_OwnerCarPark.ADDRESS33,'
                    . 'B_view_OwnerCarPark.ADDRESS44'
            );
            $this->db->from('B_view_OwnerCarPark');
            if ($code !== FALSE && $code !== '') {
                $this->db->Where('B_view_OwnerCarPark.CODE', $code);
            }

            if ($basement_1 !== FALSE && $basement_1 !== '') {
                $this->db->Where('SUBSTRING(B_view_OwnerCarPark.CARPARK,1,2)', $basement_1);
            }

            if ($basement_2 !== FALSE && $basement_2 !== '') {
                $this->db->Where('SUBSTRING(B_view_OwnerCarPark.CARPARK,4,3)', $basement_2);
            }


            $this->db->where('B_view_OwnerCarPark.BAN_CODE', $this->session->userdata("BAN_CODE"));
            $this->db->order_by('B_view_OwnerCarPark.CODE');
            return $this->db->get()->result_array();
        }
        $this->db->select('*');
        $this->db->from('B_view_OwnerCarPark');

        $this->db->Where('B_view_OwnerCarPark.CODE', $code);
        $this->db->where('B_view_OwnerCarPark.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("B_view_OwnerCarPark.CODE");
        return $this->db->get()->row_array();
    }

    public function set_owner($photo1) {
        $this->load->helper('url');
        $data = array(
            'CODE' => $this->input->post('code'),
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'NAME3' => $this->input->post('name3'),
            'CNAME1' => $this->input->post('cname1'),
            'CNAME2' => $this->input->post('cname2'),
            'CNAME3' => $this->input->post('cname3'),
            'TEL' => $this->input->post('tel'),
            'TEL1' => $this->input->post('tel1'),
            'TEL2' => $this->input->post('tel2'),
            'TEL3' => $this->input->post('tel3'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'PHOTO1' => $photo1,
            'EMAIL' => $this->input->post('email'),
            'REMARKS' => $this->input->post('remarks'),
            'POST' => $this->input->post('post'),
            'CREATEDATE' => date("Y-m-d"),
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->insert('B_OwnerCarPark', $data);
    }

    public function delete_owner() {
        $code = $this->input->post('code');
        $data = array(
            'DELETEDATE' => date("Y-m-d h:i:s"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('B_OwnerCarPark.CODE', $code);
        $this->db->Where('B_OwnerCarPark.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_OwnerCarPark.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_OwnerCarPark', $data);
    }

    public function update_owner() {
        $code = $this->input->post('code');
        $data = array(
            'CARPARK' => $this->input->post('code'),
            'NAME1' => $this->input->post('name1'),
            'NAME2' => $this->input->post('name2'),
            'NAME3' => $this->input->post('name3'),
            'CNAME1' => $this->input->post('cname1'),
            'CNAME2' => $this->input->post('cname2'),
            'CNAME3' => $this->input->post('cname3'),
            'TEL' => $this->input->post('tel'),
            'TEL1' => $this->input->post('tel1'),
            'TEL2' => $this->input->post('tel2'),
            'TEL3' => $this->input->post('tel3'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'EMAIL' => $this->input->post('email'),
            'REMARKS' => $this->input->post('remarks'),
            'POST' => $this->input->post('post'),
            'MODIFYDATE' => date("Y-m-d"),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => $this->session->userdata("BAN_CODE")
        );
        $this->db->where('CODE', $code);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_OwnerCarPark', $data);
    }

}
