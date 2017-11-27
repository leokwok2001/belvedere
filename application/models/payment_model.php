<?php

class Payment_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        /// $this->load->model('outstanding_model');
    }

    public function get_payrecord($seq = FALSE) {
// get all data
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');

        $cat1 = $this->input->post('cat1');

        $is_paid_status = $this->input->post('is_paid_status');
        $this->db->select('*');
        $this->db->from('B_PayRecord');
        $this->db->Where('B_PayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_PayRecord.BAN_CODE', '001');
        //   $allnone = true;

        if ($seq === FALSE) {


            if ($cat1 !== FALSE && $cat1 !== '' && $cat1 !== 'ALL') {
                $this->db->Where('CAT', $cat1);
            }


            if ($fromdate !== FALSE && $fromdate !== '') {
                $this->db->Where('INDATE >= ', $fromdate);
            }

            if ($todate !== FALSE && $todate !== '') {
                $this->db->Where('INDATE <= ', $todate);
            }

            if ($is_paid_status !== FALSE && $is_paid_status !== '') {
                $this->db->Where('IS_PAID', $is_paid_status);
                // $allnone = false;
                $this->db->order_by("PAYMENTNO", "DESC");
                return $this->db->get()->result_array();
            } else {
                $this->db->Where('IS_PAID', 0);
                $this->db->order_by("PAYMENTNO", "DESC");
                return $this->db->get(0, 100)->result_array();
            }
        }
// get data by $code
        $this->db->Where('B_PayRecord.PAYMENTNO', $seq);
        $this->db->order_by("PAYMENTNO", "DESC");
        return $this->db->get()->row_array();
    }

    public function get_paymentreceipt($paymentno = FALSE) {
        $this->db->select('B_PayRecord.PAYMENTNO,'
                . 'B_PayRecord.CODE,'
                . 'B_PayRecord.INDATE,'
                . 'B_PayRecord.AMT,'
                . 'B_PayRecord.PAYTYPE,'
                . 'B_PayRecord.CHEQNO,'
                . 'B_PayRecord.BAN_CODE,'
                . 'B_PayRecord.CREATEBY,'
                . 'B_PayRecord.REMARKS,'
                . 'B_PayRecord.HANDLE_BY,'
                . 'B_PayRecord.PAYMENT_REF,'
                . 'B_MfreeStatment.RES_FIRSTNAME AS NAME1,'
                . 'B_MfreeStatment.RES_LASTNAME AS NAME2,'
                . 'B_MfreeStatment.ADDRESS1,'
                . 'B_MfreeStatment.ADDRESS2,'
                . 'B_MfreeStatment.ADDRESS3,'
                . 'B_MfreeStatment.ADDRESS4,'
                . 'B_MfreeStatment.RES_BLOCK,'
                . 'B_MfreeStatment.RES_UNIT,'
                . 'B_MfreeStatment.RES_FLOOR'
        );
        $this->db->from('B_PayRecord');
        $this->db->join('B_MfreeStatment', 'B_MfreeStatment.PAYMENTNO = B_PayRecord.PAYMENTNO', 'left');
        if ($paymentno === FALSE) {
            $fromdate = $this->input->post('date1');
            $todate = $this->input->post('date2');
            if ($fromdate !== FALSE && $fromdate !== '') {
                $this->db->Where('B_PayRecord.INDATE >= ', $fromdate);
            }
            if ($todate !== FALSE && $todate !== '') {
                $this->db->Where('B_PayRecord.INDATE <= ', $todate);
            }
        } else {
            $this->db->Where('B_PayRecord.PAYMENTNO', $paymentno);
        }
        $this->db->Where('B_PayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_PayRecord.BAN_CODE', '001');
        $this->db->order_by("B_PayRecord.PAYMENTNO");
        return $this->db->get()->result_array();
    }

    public function get_payrecord_resident($code = FALSE) {
        $this->db->select('*');
        $this->db->from('B_PayRecord');
        $this->db->Where('CODE', $code);
        $this->db->Where('DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('BAN_CODE', '001');
        $this->db->order_by("PAYMENTNO");
        return $this->db->get()->result_array();
    }

    public function set_payrecord_barcode() {
        $this->load->helper('url');
        $jason = $this->input->post('tmpjason');
        $arrayjason = json_decode($jason, true);
        IF (substr($this->input->post('code'), 0, 1) === 'B') {
            $cat1 = 'C';
        } else {
            $cat1 = 'R';
        }
        $payno = $this->payment_model->get_paymentno();
        $data = array(
            'PAYMENT_REF' => '', //$this->input->post('payment_ref'),
            'CODE' => strtoupper($this->input->post('code')),
            'INDATE' => $this->input->post('indate'),
            'AMT' => $this->input->post('amt'),
            'PAYTYPE' => $this->input->post('ptype'),
            'CHEQNO' => $this->input->post('cheqno'),
            'REMARKS' => $this->input->post('remarks'),
            'BANKNO' => $this->input->post('bankno'),
            'P_OUTSTAND' => 0,
            'BANKACNO' => $this->input->post('bankacno'),
            'PAYMENTNO' => $payno['PAYMENTNO'],
            'CREATEDATE' => date("Y-m-d"),
            'CAT' => $cat1,
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => '001'
        );
// start transaction 
        $this->db->trans_start();
        $this->db->insert('B_PayRecord', $data);
        for ($i = 0, $size = count($arrayjason); $i < $size; ++$i) {
            if ($arrayjason[$i]['DIFFERENT'] == '0') {
                $this->db->set("PAYMENTNO", $payno['PAYMENTNO'], false);
                $this->db->set("PAID_AMT", " PAID_AMT +" . $arrayjason[$i]['PAID_AMT'], false);
            } else {
                $this->db->set("PARTIALNO", $payno['PAYMENTNO'], false);
                $this->db->set("PAID_AMT", " PAID_AMT +" . $arrayjason[$i]['PAID_AMT'], false);
            }
            $this->db->where('CODE', $arrayjason[$i]['CODE']);
            $this->db->update('B_MfreeStatment');
        }
// complete transaction
        $this->db->trans_complete();
    }

    public function set_payrecord_batch($csvdata) {
        $this->load->helper('url');
        $this->db->trans_start();
        foreach ($csvdata as $key => $value) {
            $payno = $this->payment_model->get_paymentno();
            $data = array(
                'PAYMENT_REF' => $value['PAYMENT_REF'],
                'CODE' => $value['CODE'],
                'INDATE' => $value['INDATE'],
                'AMT' => $value['AMT'],
                'PAYTYPE' => $value['PTYPE'],
                'REMARKS' => $value['REMARKS'],
                'PAYMENT_REF' => $value['PAYMENT_REF'],
                'HANDLE_BY' => $value['HANDLE_BY'],
                'PAYMENTNO' => $payno['PAYMENTNO'],
                'BANKNO' => $value['BANKNO'],
                'CREATEDATE' => date("Y-m-d"),
                'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
                'BAN_CODE' => '001'
            );
            $this->db->insert('B_PayRecord', $data);
            $data2 = array('IS_PAID' => TRUE);
            $this->db->where('CODE', $value['PAYMENT_REF']);
            $this->db->update('B_MfreeStatment', $data2);
        }
// complete transaction
        $this->db->trans_complete();
    }

    function set_payrecord_by_manu($code, $TrueFalse) {
        $this->load->helper('url');
        $data = array('IS_PAID' => $TrueFalse === 'TRUE' ? TRUE : FALSE);
        $this->db->where('CODE', $code);
        $this->db->update('B_MfreeStatment', $data);
    }

    function set_payrecord_by_manu2($code, $TrueFalse) {
        $this->load->helper('url');
        if ($TrueFalse === 'TRUE') {
            $data = array('IS_PAID' => TRUE,
                'IS_PAIDBY' => $this->session->userdata("LOGIN_NAME"),
                'IS_PAIDDATE' => date("Y-m-d"));
            $data2 = array('IS_PAID' => TRUE);
            $this->db->trans_start();
            $this->db->where('B_PayRecord.PAYMENTNO', $code);
            $this->db->where('B_PayRecord.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->update('B_PayRecord', $data);

            $this->db->where('B_MfreeStatment.PAYMENTNO', $code);
            $this->db->where('B_MfreeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->update('B_MfreeStatment', $data2);
            $this->db->trans_complete();
        }
    }

    function set_payrecord_confirm_all() {
        $this->load->helper('url');
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');
        $cat1 = $this->input->post('cat1');
        $bancode = '001';


        $loginname = $this->session->userdata("LOGIN_NAME");
        $call_procedure = "CALL SET_PAYRECORD_CONFIRMALL('" . $fromdate . "','" . $todate . "','" . $cat1 . "','" . $bancode . "','" . $loginname . "' ) ";
        $this->db->query($call_procedure);
    }

    public function set_unpresentcheque($paymentno = false) {
        $this->db->select('*');
        $this->db->from('B_PayRecord');
        $this->db->Where('B_PayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_PayRecord.BAN_CODE', '001');
        $this->db->Where('B_PayRecord.PAYMENTNO', $paymentno);
        $payrecords = $this->db->get()->row_array();
        $data = array(
            'CHEQNO' => $payrecords['CHEQNO'] . '-Return Cheque by' . $this->session->userdata("LOGIN_NAME") . ' on ' . date("Y-m-d"),
            'REMARKS' => $payrecords['CHEQNO'] . '-Return Cheque by' . $this->session->userdata("LOGIN_NAME") . ' on ' . date("Y-m-d"),
            'IS_PAID' => 2,
            'IS_PAIDDATE' => date("Y-m-d"),
            'CREATEDATE' => date("Y-m-d"),
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => '001'
        );
        $this->db->trans_start();
        $this->db->where('PAYMENTNO', $paymentno);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_PayRecord', $data);
        $data2 = array(
            'PAYMENTNO' => '',
        );
        $this->db->where('PAYMENTNO', $paymentno);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_MfreeStatment', $data2);
        $this->db->trans_complete();
    }

    function update_payrecord() {
        $seq = $this->input->post('seq');
        IF (substr($this->input->post('code'), 0, 1) === 'B') {
            $cat1 = 'C';
        } else {
            $cat1 = 'R';
        }
        $data = array(
            'PAYMENT_REF' => $this->input->post('payment_ref'),
            'CODE' => $this->input->post('code'),
            'indate' => $this->input->post('indate'),
            'AMT' => $this->input->post('amt'),
            'PAYTYPE' => $this->input->post('ptype'),
            'REMARKS' => $this->input->post('remarks'),
            'CHEQNO' => $this->input->post('cheqno'),
            'BANKNO' => $this->input->post('bankno'),
            'BANKACNO' => $this->input->post('bankacno'),
            'MODIFYDATE' => date("Y-m-d"),
            'CAT' => $cat1,
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => '001'
        );
        $this->db->where('PAYMENTNO', $seq);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_PayRecord', $data);
    }

    public function delete_payrecord() {
        $seq = $this->input->post('seq');
        $this->db->trans_start();
        $data = array(
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );
        $this->db->where('PAYMENTNO', $seq);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_PayRecord', $data);
        $data2 = array('IS_PAID' => 0, 'PAYMENTNO' => '');
        $this->db->where('B_MfreeStatment.PAYMENTNO', $seq);
        $this->db->where('B_MfreeStatment.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_MfreeStatment', $data2);
        $this->db->trans_complete();
    }

    public function get_paymentno() {
        $this->db->query('CALL GET_PAYMENTNO2 (\'' . '001' . '\',@p0)');
        $query = $this->db->query('SELECT @p0 AS PAYMENTNO ');
        return $query->row_array();
    }

    public function get_payrecord_bank_excel() {

        $cat1 = $this->input->post('cat1');
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $bankacno = $this->input->post('bankacno');
        $select1 = "B_PayRecord.CODE ,
substr(B_MfreeStatment.INDATE,1,7) AS PERIOD, 
B_PayRecord.AMT AS AMT,
B_PayRecord.BANKNO AS BANKNO , 
B_PayRecord.CHEQNO AS CHEQNO";
        $this->db->select($select1, FALSE);
        $this->db->from('B_PayRecord');
        $this->db->join('B_MfreeStatment', 'B_MfreeStatment.PAYMENTNO = B_PayRecord.PAYMENTNO', 'left');
        $this->db->Where('B_PayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->Where('B_PayRecord.CAT', $cat1);

        if (($date1 !== FALSE && $date1 !== '') && ($date2 !== FALSE && $date2 !== '')) {
            $this->db->Where("(B_PayRecord.INDATE>='$date1' AND B_PayRecord.INDATE<='$date2' )");
        }
        if ($bankacno !== FALSE && $bankacno !== '') {
                    $this->db->Where('B_PayRecord.BANKACNO', $bankacno);
        }


        $this->db->where('B_PayRecord.BAN_CODE', '001');
        return $this->db->get()->result_array();
    }

}
