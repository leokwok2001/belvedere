<?php

class Comm_man_payment_model extends CI_Model {

//    protected $ban_code;
//    protected $login_name;


    public function __construct() {

        //$this->session->userdata("BAN_CODE")
//        $ban_code=$this->session->userdata("BAN_CODE");
//        $login_name=$this->session->userdata("LOGIN_NAME");
//        
        $this->load->database();
    }

    public function get_payrecord($seq = FALSE) {
// get all data

        $is_paid_status = $this->input->post('is_paid_status');
        $fromdate = $this->input->post('fromdate');
        $todate = $this->input->post('todate');

        $this->db->select('*');
        $this->db->from('B_CommManPayRecord');
        $this->db->Where('B_CommManPayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_CommManPayRecord.BAN_CODE', '001');

        //       $this->db->where('B_CommManPayRecord.BAN_CODE', $this->session->userdata("BAN_CODE"));

        if ($seq === FALSE) {

            if ($is_paid_status !== FALSE && $is_paid_status !== '' && $is_paid_status !== 'ALL') {
                $this->db->Where('IS_PAID', $is_paid_status);
            } elseif ($is_paid_status == 'ALL') {
                // DO NOTHING
            } else {
                $this->db->Where('IS_PAID', 0);
            }

            if ($fromdate !== FALSE && $fromdate !== '') {
                $this->db->Where('INDATE >= ', $fromdate);
            }

            if ($todate !== FALSE && $todate !== '') {
                $this->db->Where('INDATE <= ', $todate);
            }

            $this->db->order_by("PAYMENTNO", "DESC");
            return $this->db->get()->result_array();
        }
// get data by $code
        $this->db->Where('B_CommManPayRecord.PAYMENTNO', $seq);
        return $this->db->get()->row_array();
    }

    public function get_payrecord_bank_excel() {

//        $this->db->
        $date1 = $this->input->post('date1');
        $date2 = $this->input->post('date2');
        $bankacno = $this->input->post('bankacno');
        //     $select1 = "B_CommManPayRecord.CODE,CONCAT(B_ManfeeStatment.BLOCK,'-',B_ManfeeStatment.FLOOR,B_ManfeeStatment.UNIT)  AS UNIT ,
        $select1 = "B_CommManPayRecord.CODE ,
substr(B_ManfeeStatment.BILLDATE,1,7) AS PERIOD, 
B_CommManPayRecord.AMT AS AMT,
B_CommManPayRecord.BANKNO AS BANKNO , 
B_CommManPayRecord.CHEQNO AS CHEQNO";

        $this->db->select($select1, FALSE);

        $this->db->from('B_CommManPayRecord');
        $this->db->join('B_ManfeeStatment', 'B_ManfeeStatment.PAYMENTNO = B_CommManPayRecord.PAYMENTNO', 'left');
        $this->db->Where('B_CommManPayRecord.DELETEDATE', '0000-00-00 00:00:00');

        if (($date1 !== FALSE && $date1 !== '') && ($date2 !== FALSE && $date2 !== '')) {
            $this->db->Where("(B_CommManPayRecord.INDATE>='$date1' AND B_CommManPayRecord.INDATE<='$date2' )");
        }

        if ($bankacno !== FALSE && $bankacno !== '') {
            $this->db->Where('B_CommManPayRecord.BANKACNO', $bankacno);
        }

        $this->db->where('B_CommManPayRecord.BAN_CODE', '001');
        return $this->db->get()->result_array();
    }

    public function get_payrecord_resident($code = FALSE) {

        $this->db->select('*');
        $this->db->from('B_CommManPayRecord');
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
        // start transaction 
        $this->db->trans_start();
        $payno = $this->comm_man_payment_model->get_paymentno();
        $data = array(
            'PAYMENT_REF' => '', //$this->input->post('payment_ref'),
            'CODE' => $this->input->post('code'),
            'INDATE' => $this->input->post('indate'),
            'AMT' => $this->input->post('amt'),
            'PAYTYPE' => $this->input->post('ptype'),
            'CHEQNO' => $this->input->post('cheqno'),
            'REMARKS' => $this->input->post('remarks'),
            'PAYMENTNO' => $payno['PAYMENTNO'],
            'CREATEDATE' => date("Y-m-d"),
            'CAT' => $cat1,
            'BANKNO' => $this->input->post('bankno'),
            'BANKACNO' => $this->input->post('bankacno'),
            'CREATEBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => '001'
        );



        $this->db->insert('B_CommManPayRecord', $data);

        // update CRS BILL master
        for ($i = 0, $size = count($arrayjason); $i < $size; ++$i) {
            $data2 = array('PAYMENTNO' => $payno['PAYMENTNO']);
            $this->db->where('CODE', $arrayjason[$i]['CODE']);
            $this->db->update('B_ManfeeStatment', $data2);
            unset($data2);
        }
// complete transaction
        $this->db->trans_complete();
    }

    public function set_unpresentcheque($paymentno = false) {


        $this->db->select('*');
        $this->db->from('B_CommManPayRecord');
        $this->db->Where('B_CommManPayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_CommManPayRecord.BAN_CODE', '001');
        $this->db->Where('B_CommManPayRecord.PAYMENTNO', $paymentno);
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
        $this->db->update('B_CommManPayRecord', $data);
        // $data2 = array(
        //    'PAYMENTNO' => '',
        // );

        $data2 = array('IS_PAID' => 0, 'PAYMENTNO' => '');
        $this->db->where('PAYMENTNO', $paymentno);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_ManfeeStatment', $data2);
        $this->db->trans_complete();
    }

//    function set_payrecord_by_manu($code, $TrueFalse) {
//        $this->load->helper('url');
//        $data = array('IS_PAID' => $TrueFalse === 'TRUE' ? TRUE : FALSE);
//        $this->db->where('CODE', $code);
//
//        $this->db->update('B_ManfeeStatment', $data);
//    }

    function set_payrecord_by_manu2($code, $TrueFalse) {
        $this->load->helper('url');

        if ($TrueFalse === 'TRUE') {
            $data = array('IS_PAID' => TRUE,
                'IS_PAIDBY' => $this->session->userdata("LOGIN_NAME"),
                'IS_PAIDDATE' => date("Y-m-d"));

            $data2 = array('IS_PAID' => TRUE);
            // update payrecord
            $this->db->trans_start();
            $this->db->where('B_CommManPayRecord.PAYMENTNO', $code);
            $this->db->where('B_CommManPayRecord.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->update('B_CommManPayRecord', $data);
            // update reesident management statment 

            $this->db->where('B_ManfeeStatment.PAYMENTNO', $code);
            $this->db->where('B_ManfeeStatment.DELETEDATE', '0000-00-00 00:00:00');
            $this->db->update('B_ManfeeStatment', $data2);
        }


        $this->db->trans_complete();
    }

    function update_payrecord() {
        $seq = $this->input->post('seq');
        $data = array(
            'PAYMENT_REF' => '', //$this->input->post('payment_ref'),
            'CODE' => $this->input->post('code'),
            'indate' => $this->input->post('indate'),
            'AMT' => $this->input->post('amt'),
            'PAYTYPE' => $this->input->post('ptype'),
            'REMARKS' => $this->input->post('remarks'),
            'CHEQNO' => $this->input->post('cheqno'),
            'MODIFYDATE' => date("Y-m-d"),
            'BANKNO' => $this->input->post('bankno'),
            'BANKACNO' => $this->input->post('bankacno'),
            'MODIFYBY' => $this->session->userdata("LOGIN_NAME"),
            'BAN_CODE' => '001'
        );
        $this->db->where('PAYMENTNO', $seq);
        $this->db->where('BAN_CODE', '001');

        $this->db->update('B_CommManPayRecord', $data);
    }

    function delete_payrecord() {
        $seq = $this->input->post('seq');

        $this->db->trans_start();

        $data = array(
            'DELETEDATE' => date("Y-m-d"),
            'DELETEBY' => $this->session->userdata("LOGIN_NAME")
        );

        $this->db->where('PAYMENTNO', $seq);
        $this->db->where('BAN_CODE', '001');
        $this->db->update('B_CommManPayRecord', $data);

        $data2 = array('IS_PAID' => 0, 'PAYMENTNO' => '');


        $this->db->where('B_ManfeeStatment.PAYMENTNO', $seq);
        $this->db->where('B_ManfeeStatment.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->update('B_ManfeeStatment', $data2);

        $this->db->trans_complete();
    }

    function get_paymentno() {
        $this->db->query('CALL GET_PAYMENTNO1 (\'' . '001' . '\',@p0)');

        $query = $this->db->query('SELECT @p0 AS PAYMENTNO ');

        return $query->row_array();
    }

    public function get_paymentreceipt($paymentno = FALSE) {

        $this->db->select('B_CommManPayRecord.PAYMENTNO,'
                . 'B_CommManPayRecord.CODE,'
                . 'B_CommManPayRecord.INDATE,'
                . 'B_CommManPayRecord.AMT,'
                . 'B_CommManPayRecord.PAYTYPE,'
                . 'B_CommManPayRecord.CHEQNO,'
                . 'B_CommManPayRecord.BAN_CODE,'
                . 'B_CommManPayRecord.CREATEBY,'
                . 'B_CommManPayRecord.REMARKS,'
                . 'B_CommManPayRecord.HANDLE_BY,'
                . 'B_CommManPayRecord.PAYMENT_REF,'
                . 'B_ManfeeStatment.OWNER_NAME1 AS NAME1,'
                . 'B_ManfeeStatment.OWNER_NAME2 AS NAME2,'
                . 'B_ManfeeStatment.OWNER_ADDRESS1,'
                . 'B_ManfeeStatment.OWNER_ADDRESS2,'
                . 'B_ManfeeStatment.OWNER_ADDRESS3,'
                . 'B_ManfeeStatment.OWNER_ADDRESS4,'
                . 'B_ManfeeStatment.BLOCK,'
                . 'B_ManfeeStatment.UNIT,'
                . 'B_ManfeeStatment.CHARGE_DESC,'
                . 'B_ManfeeStatment.FLOOR'
        );



        $this->db->from('B_CommManPayRecord');
        $this->db->join('B_ManfeeStatment', 'B_ManfeeStatment.PAYMENTNO = B_CommManPayRecord.PAYMENTNO', 'left');


        if ($paymentno === FALSE) {

            $fromdate = $this->input->post('date1');
            $todate = $this->input->post('date2');


            if ($fromdate !== FALSE && $fromdate !== '') {
                $this->db->Where('B_CommManPayRecord.INDATE >= ', $fromdate);
            }
            if ($todate !== FALSE && $todate !== '') {
                $this->db->Where('B_CommManPayRecord.INDATE <= ', $todate);
            }
        } else {
            $this->db->Where('B_CommManPayRecord.PAYMENTNO', $paymentno);
        }

        $this->db->Where('B_CommManPayRecord.DELETEDATE', '0000-00-00 00:00:00');
        $this->db->where('B_CommManPayRecord.BAN_CODE', '001');
        $this->db->order_by("B_CommManPayRecord.PAYMENTNO");



        return $this->db->get()->result_array();
    }

}
