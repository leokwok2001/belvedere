<?php

class Genmfree_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function update_genmfree() {
        $code = $this->input->post('code');
        $data = array(
            'RES_CODE' => $this->input->post('res_code'),
            'RES_UNIT' => $this->input->post('res_unit'),
            'RES_BLOCK' => $this->input->post('res_block'),
            'BAN_CODE' => $this->session->userdata('BAN_CODE'),
            'RES_FIRSTNAME' => $this->input->post('res_firstname'),
            'RES_LASTNAME' => $this->input->post('res_lastname'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'AMT' => $this->input->post('amt'),
            'MDATE' => $this->input->post('mdate')
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->update('B_MfreeStatment', $data);
    }

    public function get_genmfree_batch_detail_rtp($code = FALSE) {

        $this->db->select('*');
        $this->db->from('B_MfeeStatment_detail');
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));

        if ($code === FALSE) {

            $this->db->order_by("INDATE");
            return $this->db->get()->result_array();
        }
        $this->db->where('CODE', $code);
        return $this->db->get()->result_array();
    }

    public function get_genmfree_batch_rtp($code = FALSE) {


        if ($code === FALSE) {
            $cat = $this->input->post('cat');
            $mdate = $this->input->post('mdate');
            $porr = $this->input->post('porr');
            $res_code_from = $this->input->post('res_code_from');
            $res_code_to = $this->input->post('res_code_to');

            $allowautopay = $this->input->post('allowautopay');
            if ($cat === 'R') {
                $this->db->select('B_MfreeStatment.*');
                $this->db->from('B_MfreeStatment');
                $this->db->join('B_resident', 'B_resident.CODE = B_MfreeStatment.RES_CODE', 'left');
                $check1 = $this->input->post('chkblock');
                $tmpstr = "";
                if (!empty($check1)) {
                    foreach ($check1 as $chk1) {
                        $tmpstr = $tmpstr . "or  B_MfreeStatment.RES_BLOCK ='" . $chk1 . "' ";
                    }
                    $tmpstr = "  (" . substr($tmpstr, 2) . ")  ";
                    $this->db->Where($tmpstr, null, false);
                }
                if ($porr !== 'ALL') {
                    $this->db->Where('B_resident.PORR', $porr);
                }
                if ($allowautopay === 'YES') {
                    
                } else {
                    $this->db->Where('B_resident.PAYTYPE', 0);
                }
            } elseif ($cat === 'C') {
                $this->db->select('B_MfreeStatment.*');
                $this->db->from('B_MfreeStatment');
                $this->db->join('B_Driver', 'B_Driver.CARPARK = B_MfreeStatment.RES_CODE', 'left');
                $check2 = $this->input->post('chkbasement');
                $tmpstr2 = "";
                if (!empty($check2)) {
                    foreach ($check2 as $chk2) {
                        $tmpstr2 = $tmpstr2 . "or  LEFT(B_MfreeStatment.RES_CODE,2) ='B" . $chk2 . "' ";
                    }
                    $tmpstr2 = "  (" . substr($tmpstr2, 2) . ")  ";
                    $this->db->Where($tmpstr2, null, false);
                }
                $this->db->Where('B_Driver.ISPRINT', 0);
                if ($porr !== 'ALL') {
                    $this->db->Where('B_Driver.PORR', $porr);
                }
                if ($allowautopay === 'YES') {
                    
                } else {
                    $this->db->Where('B_Driver.PAYTYPE', 0);
                }
            }

            if (($res_code_from !== FALSE && $res_code_from !== '') && ($res_code_to !== FALSE && $res_code_to !== '')) {
                $this->db->Where(" (B_MfreeStatment.RES_CODE >= '$res_code_from' AND B_MfreeStatment.RES_CODE <= '$res_code_to') ", null, false);
            }




            $this->db->Where('SUBSTRING(B_MfreeStatment.INDATE,1,7)', $mdate);
            $this->db->Where('B_MfreeStatment.CAT', $cat);
            $this->db->where('B_MfreeStatment.BAN_CODE', $this->session->userdata('BAN_CODE'));
            $this->db->Where('B_MfreeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->order_by(" (B_MfreeStatment.RES_BLOCK*1), (B_MfreeStatment.RES_FLOOR*1), B_MfreeStatment.RES_UNIT,B_MfreeStatment.RES_CODE", "asc");
            return $this->db->get()->result_array();
        }


        // get data by $code

        $this->db->select('*');
        $this->db->from('B_MfreeStatment');
        $this->db->where('CODE', $code);
        return $this->db->get()->result_array();
    }

//    public function get_genmfree_batch_rtp($code = FALSE) {
//
//        $this->db->select('*');
//        $this->db->from('B_MfreeStatment');
//        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
//        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
//
//        if ($code === FALSE) {
//            $mdate = $this->input->post('mdate');
//            $this->db->Where('MDATE', $mdate);
//            $this->db->order_by('RES_CODE');
//            return $this->db->get()->result_array();
//        }
//        // get data by $code
//        $this->db->where('CODE', $code);
//        $this->db->order_by('RES_CODE');
//        return $this->db->get()->result_array();
//    }
//
    public function set_mfree_statment() {
        $this->load->helper('url');
        $tmpcode1 = $this->input->post('res_code');

        if (substr($tmpcode1, 0, 1) === 'B') {
            $cat = 'C';
        } else {
            $cat = 'R';
        }

        $year1 = substr($this->input->post('mdate'), 2, 2);
        $month1 = substr($this->input->post('mdate'), 5, 2);

        $data = array(
            'RES_CODE' => strtoupper($this->input->post('res_code')),
            'CODE' => strtoupper($this->input->post('res_code') . $year1 . $month1),
            'IS_PAID' => 0,
            'MDATE' => $this->input->post('mdate'),
            'INDATE' => $this->input->post('mdate'),
            'AMT' => $this->input->post('amt'),
            'CAT' => $cat,
            'BAN_CODE' => '001',
            'RES_TEL' => $this->input->post('tel'),
            'RES_FIRSTNAME' => $this->input->post('res_firstname'),
            'RES_LASTNAME' => '',
            'RES_BLOCK' => $this->input->post('res_block'),
            'RES_UNIT' => $this->input->post('res_unit'),
            'RES_FLOOR' => $this->input->post('res_floor'),
            'ADDRESS1' => $this->input->post('address1'),
            'ADDRESS2' => $this->input->post('address2'),
            'ADDRESS3' => $this->input->post('address3'),
            'ADDRESS4' => $this->input->post('address4'),
            'PAID_AMT' => 0
        );
        $this->db->insert('B_MfreeStatment', $data);
    }

//for  listing all the view data 
    public function get_mfree_statment_barcode($code = FALSE) {

//  $code= 'T103A01';
        if ($code !== FALSE) {
            $this->db->select('B_MfreeStatment.RES_CODE,'
                    . 'B_MfreeStatment.CODE,'
                    . 'B_MfreeStatment.IS_PAID,'
                    . 'B_MfreeStatment.MDATE,'
                    . 'B_MfreeStatment.AMT,'
                    . 'B_MfreeStatment.RES_FIRSTNAME AS FIRSTNAME,'
                    . 'B_MfreeStatment.RES_LASTNAME AS LASTNAME,'
                    . 'B_MfreeStatment.RES_BLOCK ,'
                    . 'B_MfreeStatment.RES_UNIT,'
                    . 'B_MfreeStatment.RES_FLOOR,'
                    . 'B_MfreeStatment.ADDRESS1,'
                    . 'B_MfreeStatment.ADDRESS2,'
                    . 'B_MfreeStatment.ADDRESS3,'
                    . 'B_MfreeStatment.ADDRESS4,'
                    . 'B_MfreeStatment.PAID_AMT'
            );
            $this->db->from('B_MfreeStatment');
            $this->db->where('B_MfreeStatment.BAN_CODE', $this->session->userdata('BAN_CODE'));
            $this->db->where('B_MfreeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->where('B_MfreeStatment.PAYMENTNO', '');
            $this->db->where('B_MfreeStatment.RES_CODE', $code);
            $this->db->order_by("B_MfreeStatment.RES_CODE", "desc");
            return $this->db->get()->result_array();
        }
    }

    public function get_ownerinfo($code = FALSE) {

//  $code= 'T103A01';
        if ($code !== FALSE) {
            $this->db->select('*');

            //substr(string,start,length)
            if (substr($code, 0, 1) === 'B') {
                $this->db->from('B_view_OwnerCarPark');
                $this->db->where('B_view_OwnerCarPark.BAN_CODE', $this->session->userdata('BAN_CODE'));
                $this->db->where('B_view_OwnerCarPark.CARPARK', $code);
            } ELSE {
                $this->db->from('B_view_Owner');
                $this->db->where('B_view_Owner.BAN_CODE', $this->session->userdata('BAN_CODE'));
                $this->db->where('B_view_Owner.CODE1', $code);
            }


            return $this->db->get()->result_array();
        }
    }

//for  listing all the view data 
    public function get_mfree_statment($code = FALSE) {

        $this->db->select('*');
        $this->db->from('B_MfreeStatment');
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $allnone = true;
        if ($code === FALSE) {
            $is_paid_status = $this->input->post('is_paid_status');
            $unit = $this->input->post('unit');
            $floor = $this->input->post('floor');
            $block = $this->input->post('block');
            $cat = $this->input->post('cat');


            if ($cat !== FALSE && $cat !== '') {
                $this->db->Where('CAT', $cat);
            }

            if ($is_paid_status !== FALSE && $is_paid_status !== '') {
                $this->db->Where('IS_PAID', $is_paid_status);
                $allnone = false;
            }

            if ($unit !== FALSE && $unit !== '') {
                $this->db->Where('RES_UNIT', $unit);
                $allnone = false;
            }

            if ($floor !== FALSE && $floor !== '') {
                $this->db->Where('RES_FLOOR', $floor);
                $allnone = false;
            }

            if ($block !== FALSE && $block !== '') {
                $this->db->Where('RES_BLOCK', $block);
                $allnone = false;
            }

            $this->db->order_by("INDATE", "DESC");


            if ($allnone === true) {
                return $this->db->get(0, 10)->result_array();
            } else {

                return $this->db->get()->result_array();
            }

//      return $this->db->get(0, 100)->result_array();
//   return $this->db->get()->result_array();
        }
        $this->db->where('CODE', $code);
//  $this->db->order_by("MDATE,CODE");
        return $this->db->get()->row_array();
    }

    public function get_mfree_statment_by_resident($code) {
        $this->db->select('*');
        $this->db->from('B_MfreeStatment');
        $this->db->Where('RES_CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $this->db->order_by("MDATE");
        return $this->db->get()->result_array();
    }

    public function get_mfree_statment_by_paymentno($code) {
        $this->db->select('*');
        $this->db->from('B_MfreeStatment');
        $this->db->Where('PAYMENTNO', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $this->db->order_by("MDATE");
        return $this->db->get()->result_array();
    }

//**********  BEGIN GENERATE STATMENT  ************//
    public function gen_mfree() {
        $mdate = $this->input->post('mdate');
        $cat = $this->input->post('cat');

        $tmpdate = substr(str_replace('-', '', $mdate), 2, 4);
// check the month has already generated  or not ?

        $this->load->helper('url');
        $this->db->select('count(*) as count1');
        $this->db->from('B_MfreeStatment');
        $this->db->Where('CAT', $cat);
        $this->db->Where('RIGHT(CODE,4)', $tmpdate);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('BAN_CODE', $this->session->userdata('BAN_CODE'));

        $tmp1 = $this->db->get()->row_array();
        if ($tmp1['count1'] > 0) {
//return FALSE;
//   echo "already have ";
            return '001';
        } else {


            $this->db->trans_start();
            $call_procedure = "CALL GEN_MFREE_NEW('" . $mdate . "','" . $this->session->userdata('BAN_CODE') . "' , '" . $cat . "')";
            $this->db->query($call_procedure);

            $call_procedure1 = "CALL GEN_AUOTPAY_PAYRECORD('" . $mdate . "','" . $this->session->userdata('BAN_CODE') . "','" . $this->session->userdata('LOGIN_NAME') . "','" . $cat . "')";
            $this->db->query($call_procedure1);
            $this->db->trans_complete();
            return 'success';
        }
    }

    public function delete_genmfree() {

        $code = $this->input->post('code');
        $data = array(
            'ISDELETE' => 1,
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->update('B_MfreeStatment', $data);
    }

}
