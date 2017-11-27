<?php

class Owner_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_owner($code = FALSE) {
        // get all data
        if ($code === FALSE) {
            $code = $this->input->post('code');
            
            $unit = $this->input->post('unit');
            $floor = $this->input->post('floor');
            $block = $this->input->post('block');
            $this->db->select('B_view_Owner.CODE,'
                    . 'B_view_Owner.NAME1,'
                    . 'B_view_Owner.NAME2,'
                    . 'B_view_Owner.NAME3,'
                    . 'B_view_Owner.CNAME1,'
                    . 'B_view_Owner.CNAME2,'
                    . 'B_view_Owner.CNAME3,'
                    . 'B_view_Owner.TEL,'
                    . 'B_view_Owner.TEL1,'
                    . 'B_view_Owner.TEL2,'
                    . 'B_view_Owner.TEL3,'
                    . 'B_view_Owner.ADDRESS1,'
                    . 'B_view_Owner.ADDRESS2,'
                    . 'B_view_Owner.ADDRESS3,'
                    . 'B_view_Owner.ADDRESS4,'
                    . 'B_view_Owner.BAN_CODE,'
                    . 'B_view_Owner.PHOTO1,'
                    . 'B_view_Owner.EMAIL,'
                    . 'B_view_Owner.REMARKS,'       
                    . 'B_view_Owner.POST,'
                    . 'B_view_Owner.CODE1,'
                    . 'B_view_Owner.FLOOR1,'
                    . 'B_view_Owner.BLOCK1,'
                    . 'B_view_Owner.UNIT1'
            );
            $this->db->from('B_view_Owner');
        //    $this->db->join('B_resident', 'B_resident.OWNERCODE = B_Owner.CODE', 'left');
            if ($code !== FALSE && $code !== '') {
                $this->db->Where('B_view_Owner.CODE', $code);
            }
            
     
            if ($unit !== FALSE && $unit !== '') {
                $this->db->Where('B_view_Owner.UNIT1', $unit);
            }

            if ($floor !== FALSE && $floor !== '') {
                $this->db->Where('B_view_Owner.FLOOR1', $floor);
            }

            if ($block !== FALSE && $block !== '') {
                $this->db->Where('B_view_Owner.BLOCK1', $block);
            }
            
            
            
            $this->db->where('B_view_Owner.BAN_CODE', $this->session->userdata("BAN_CODE"));
            $this->db->order_by('B_view_Owner.CODE');
            return $this->db->get()->result_array();
        }
        $this->db->select('*');
        $this->db->from('B_view_Owner');
        //$this->db->Where('B_view_Owner.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('B_view_Owner.CODE', $code);
        $this->db->where('B_view_Owner.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->order_by("B_view_Owner.CODE");
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
        $this->db->insert('B_Owner', $data);
    }

    public function delete_owner() {
        $code = $this->input->post('code');
        $data = array(
            'DELETEDATE' => date("Y-m-d h:i:s"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('B_Owner.CODE', $code);
        $this->db->Where('B_Owner.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_Owner.BAN_CODE', $this->session->userdata("BAN_CODE"));
        $this->db->update('B_Owner', $data);
    }

    public function update_owner() {
        $code = $this->input->post('code');
        $data = array(
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
        $this->db->update('B_Owner', $data);
    }

}
