<?php

class Genmanfee_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function update_genmanfee() {
        $code = $this->input->post('code');
        $data = array(
            'RES_CODE' => $this->input->post('res_code'),
            'UNIT' => $this->input->post('res_unit'),
            'BLOCK' => $this->input->post('res_block'),
            'BAN_CODE' => $this->session->userdata('BAN_CODE'),
            'OWNER_NAME1' => $this->input->post('res_name1'),
            'OWNER_NAME2' => $this->input->post('res_name2'),
            'OWNER_ADDRESS1' => $this->input->post('address1'),
            'OWNER_ADDRESS2' => $this->input->post('address2'),
            'OWNER_ADDRESS3' => $this->input->post('address3'),
            'OWNER_ADDRESS4' => $this->input->post('address4'),
            'AMT' => $this->input->post('amt'),
            'BILLDATE' => $this->input->post('billdate')
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->update('B_ManfeeStatment', $data);
    }

    public function get_genmanfee_batch_rtp($code = FALSE) {



        if ($code === FALSE) {
            $mdate = $this->input->post('mdate');
            $cat = $this->input->post('cat');
            $porr = $this->input->post('porr');

            if ($cat === 'R') {
                $this->db->select('B_ManfeeStatment.*');
                $this->db->from('B_ManfeeStatment');
                $this->db->join('B_resident', 'B_resident.CODE = B_ManfeeStatment.RES_CODE', 'left');
                $check1 = $this->input->post('chkblock');

                $tmpstr = "";



                if (!empty($check1)) {
                    foreach ($check1 as $chk1) {
                        //$this->db->or_where('BLOCK', $chk1);
                        $tmpstr = $tmpstr . "or  B_ManfeeStatment.BLOCK ='" . $chk1 . "' ";
                    }
                    $tmpstr = "  (" . substr($tmpstr, 2) . ")  ";
                    $this->db->Where($tmpstr, null, false);
                }

                if ($porr !== 'ALL') {
                    $this->db->Where('B_resident.PORR', $porr);
                }
            } elseif ($cat === 'C') {


                $this->db->select('B_ManfeeStatment.*');
                $this->db->from('B_ManfeeStatment');
                $this->db->join('B_Driver', 'B_Driver.CARPARK = B_ManfeeStatment.RES_CODE', 'left');


                $check2 = $this->input->post('chkbasement');
                $tmpstr2 = "";

                if (!empty($check2)) {
                    foreach ($check2 as $chk2) {
                        //$this->db->or_where('BLOCK', $chk1);
                        $tmpstr2 = $tmpstr2 . "or  LEFT(B_ManfeeStatment.RES_CODE,2) ='B" . $chk2 . "' ";
                    }
                    $tmpstr2 = "  (" . substr($tmpstr2, 2) . ")  ";
                    $this->db->Where($tmpstr2, null, false);
                }

                $this->db->Where('B_Driver.ISPRINT', 0);

                if ($porr !== 'ALL') {
                    $this->db->Where('B_Driver.PORR', $porr);
                }
            }


            $this->db->Where('SUBSTRING(B_ManfeeStatment.BILLDATE,1,7)', $mdate);
            $this->db->Where('B_ManfeeStatment.CAT', $cat);
            $this->db->where('B_ManfeeStatment.BAN_CODE', $this->session->userdata('BAN_CODE'));
            $this->db->Where('B_ManfeeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->order_by(" (B_ManfeeStatment.BLOCK*1), (B_ManfeeStatment.FLOOR*1), B_ManfeeStatment.UNIT,B_ManfeeStatment.CARPARK", "asc");
            return $this->db->get()->result_array();
        }

        // get data by $code

        $this->db->select('*');
        $this->db->from('B_ManfeeStatment');
        $this->db->where('CODE', $code);
        return $this->db->get()->result_array();
    }

    //for  listing all the view data 
    public function get_manfee_statment_barcode($code = FALSE) {
        //$code ='101A';
        if ($code !== FALSE) {
            $this->db->select('B_ManfeeStatment.RES_CODE,'
                    . 'B_ManfeeStatment.CODE,'
                    . 'B_ManfeeStatment.IS_PAID,'
                    . 'B_ManfeeStatment.BILLDATE AS MDATE,'
                    . 'B_ManfeeStatment.AMT,'
                    . 'B_ManfeeStatment.OWNER_NAME1 ,'
                    . 'B_ManfeeStatment.OWNER_NAME2 ,'
                    . 'B_ManfeeStatment.BLOCK,'
                    . 'B_ManfeeStatment.UNIT,'
                    . 'B_ManfeeStatment.FLOOR,'
                    . 'B_ManfeeStatment.OWNER_TEL,'
                    . 'B_ManfeeStatment.OWNER_ADDRESS1,'
                    . 'B_ManfeeStatment.OWNER_ADDRESS2,'
                    . 'B_ManfeeStatment.OWNER_ADDRESS3,'
                    . 'B_ManfeeStatment.OWNER_ADDRESS4'
            );
            $this->db->from('B_ManfeeStatment');
            //    $this->db->join('B_ManfeeStatment', 'B_resident.CODE = B_ManfeeStatment.RES_CODE', 'left');
            //   $this->db->join('B_Owner', 'B_Owner.CODE = B_resident.OWNERCODE', 'left');
            $this->db->where('B_ManfeeStatment.BAN_CODE', $this->session->userdata('BAN_CODE'));
            $this->db->where('B_ManfeeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->where('B_ManfeeStatment.PAYMENTNO', '');
            $this->db->where('B_ManfeeStatment.RES_CODE', $code);
            $this->db->order_by("B_ManfeeStatment.RES_CODE", "desc");
            return $this->db->get()->result_array();
        }
    }

    //for  listing all the view data 
    public function get_manfee_statment($code = FALSE) {

        $this->db->select('*');
        $this->db->from('B_ManfeeStatment');
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $allnone = true;
        if ($code === FALSE) {
            $is_paid_status = $this->input->post('is_paid_status');
            $unit = $this->input->post('unit');
            $floor = $this->input->post('floor');
            $block = $this->input->post('block');
            $cat = $this->input->post('cat');
                       $res_code = $this->input->post('res_code');
            if ($is_paid_status !== FALSE && $is_paid_status !== '') {
                $this->db->Where('IS_PAID', $is_paid_status);
                $allnone = false;
            }

            if ($unit !== FALSE && $unit !== '') {
                $this->db->Where('UNIT', $unit);
                $allnone = false;
            }

            if ($floor !== FALSE && $floor !== '') {
                $this->db->Where('FLOOR', $floor);
                $allnone = false;
            }

            if ($block !== FALSE && $block !== '') {
                $this->db->Where('BLOCK', $block);
                $allnone = false;
            }


            if ($cat !== FALSE && $cat !== '') {
                $this->db->Where('CAT', $cat);
                $allnone = false;
            }

            if ($res_code !== FALSE && $res_code !== '') {
                $this->db->Where('RES_CODE', $res_code);
                $allnone = false;
            }



            $this->db->order_by("BILLDATE", "DESC");



            if ($allnone === true) {
                return $this->db->get(0, 10)->result_array();
            } else {

                return $this->db->get()->result_array();
            }
        }
        $this->db->where('CODE', $code);
        //  $this->db->order_by("MDATE,CODE");
        return $this->db->get()->row_array();
    }

    public function get_manfee_statment_by_resident($code) {
        $this->db->select('*');
        $this->db->from('B_ManfeeStatment');
        $this->db->Where('RES_CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $this->db->order_by("MDATE");
        return $this->db->get()->result_array();
    }

    public function get_manfee_statment_by_paymentno($code) {
        $this->db->select('*');
        $this->db->from('B_ManfeeStatment');
        $this->db->Where('PAYMENTNO', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $this->db->order_by("MDATE");
        return $this->db->get()->result_array();
    }

    //**********  BEGIN GENERATE STATMENT  ************//
    public function gen_manfee() {
        $indate = $this->input->post('indate');
        $each_share1 = $this->input->post('each_share1');
        $p1 = $this->input->post('p1');
        $p2 = $this->input->post('p2');
        $cat = $this->input->post('cat');

        $tmpdate = substr(str_replace('-', '', $indate), 2, 4);
        // check the month has already generated  or not ?

        $this->load->helper('url');
        $this->db->select('count(*) as count1');
        $this->db->from('B_ManfeeStatment');
        $this->db->Where('CAT', $cat);
        $this->db->Where('RIGHT(CODE,4)', $tmpdate);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('BAN_CODE', $this->session->userdata('BAN_CODE'));

        $tmp1 = $this->db->get()->row_array();
        if ($tmp1['count1'] > 0) {
            //return FALSE;
            echo "already have ";
            //return '001';
        } else {

            //  echo $indate;
            $this->db->trans_start();
            $call_procedure = "CALL GEN_CSRFEE_NEW('" . $indate . "','" . $this->session->userdata('BAN_CODE') . "'," .
                    $each_share1 . "," . $p1 . "," . $p2 . ",'" . $cat . "' )";
            $this->db->query($call_procedure);

            $this->db->trans_complete();
        }
    }

    public function delete_genmanfee() {

        $code = $this->input->post('code');
        $data = array(
            'ISDELETE' => 1,
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('CODE', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->update('B_ManfeeStatment', $data);
    }

    public function get_mfree_statment_by_paymentno($code) {
        $this->db->select('*');
        $this->db->from('B_ManfeeStatment');
        $this->db->Where('PAYMENTNO', $code);
        $this->db->where('BAN_CODE', $this->session->userdata('BAN_CODE'));
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');

        $this->db->order_by("BILLDATE");
        return $this->db->get()->result_array();
    }

}
