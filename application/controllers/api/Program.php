<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Program extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProgramKegiatanSubKegiatan_m', 'pks');
    }

    public function index_get(){

        $norek_sk = $this->get('norek_subkegiatan');  
		$pks = $this->pks->getPKS($norek_sk);

        // if ($norek_sk === null){

        // 	$pks = $this->pks->getPKS();
        
        // }else{
        //     $pks = $this->pks->getPKS($norek_sk);
        // }
       
        if ($pks){
            $this->response([
                'status' => true,
                'data' => $pks
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'NO REKENING SUBKEGIATAN NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 

}

