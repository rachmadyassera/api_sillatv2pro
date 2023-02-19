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

		// $pks = $this->pks->getPKS($norek_sk);
		// $pks = $this->pks->getPKS($opd);
        $norek_sk = $this->get('norek_subkegiatan');  
        $opd = $this->get('opd');  

        if ($norek_sk === null){

			$pks = $this->pks->getPKS($opd);
        
        }else{
			
            $pks = $this->pks->getPKS_by_noreksubkegiatan($norek_sk, $opd);
        }
       
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

