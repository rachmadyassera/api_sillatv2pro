<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class PaguProgram extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProgramKegiatanSubKegiatan_m', 'pks');
    }

    public function index_get(){

        $norek_sk = $this->get('norek_subkegiatan');  
        $tahun = $this->get('tahun');  
        $opd = $this->get('opd');  
		$pks = $this->pks->getSumPaguPKS($norek_sk,$tahun,$opd); 
       
        if ($pks){
            $this->response([
                'status' => true,
                'data' => $pks
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'DATA NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}

