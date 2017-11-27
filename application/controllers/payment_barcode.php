<?php

class Payment_barcode extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('genmfree_model');
        $this->load->model('genmanfee_model');
        //$this->load->model('gencarmanfee_model');
        $this->load->helper('url');
        $this->load->helper('html');
    }

    public function create() {
        header('Content-type: application/json');
        $code1 = $this->input->post('code1');
        $data['genmfree'] = $this->genmfree_model->get_mfree_statment_barcode($code1);

        //   print_r( $data );
        // echo json_encode($data['genmfree']);
        if (!empty($data['genmfree'])) {
            echo json_encode($data['genmfree']);
        } else {
            echo 'empty!';
        }
        // print_r($data['genmfree']);  
    }

    public function manfee_create() {
        header('Content-type: application/json');
        $code1 = $this->input->post('code1');
        //echo $code1;
        //  $code1 = 'B1232';
//$code1 = '116C';
//        if (substr($code1, 0, 1) == 'B') {
//            $data['genmfree'] = $this->gencarmanfee_model->get_manfee_statment_barcode($code1);
//        } else {
        //           $data['genmfree'] = $this->genmanfee_model->get_manfee_statment_barcode($code1  
//        }
        //  $code1='B3-242';
        $data['genmfree'] = $this->genmanfee_model->get_manfee_statment_barcode($code1);

        if (!empty($data['genmfree'])) {
            echo json_encode($data['genmfree']);
        } else {
            echo $code1;
        }
    }

}

?>
