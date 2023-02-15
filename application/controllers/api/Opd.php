<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Opd extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('opd_m', 'opd');
    }

    public function index_get(){

		$opd = $this->opd->getOPD(); 
       
        if ($opd){
            $this->response([
                'status' => true,
                'data' => $opd
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'DATA NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 

}

