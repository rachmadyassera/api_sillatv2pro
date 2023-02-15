<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Surat extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Surat_model', 'surat');
    }

    public function index_get(){
 
        $id_opd = $this->get('id_opd_sm');
        $id_sm = $this->get('id_surat_manual');

        // $surat = $this->surat->get_all_sm();

        if ($id_sm === null){

            $surat = $this->surat->get_surat_opd($id_opd);
        
        }else{

            $surat = $this->surat->get_surat_byid($id_sm);

        }
        // $data = 
        // [
        //     'id_surat_manual' => $surat['id_surat_manual'],
        //     'id_opd_sm' => $surat['id_opd_sm'],
        //     'perihal_sm' => $surat['perihal_sm'],
        //     'tujuan_sm' => $surat['tujuan_sm'],
        //     'no_sm' => $surat['no_sm'],
        //     'tgl_sm' => $surat['tgl_sm'],
        //     'status_sm' => $surat['status_sm'],
        //     'file_sm' => 'https://e-surat.tanjungbalaikota.go.id/file_signed/'.$surat['file_sm']
        // ]; 
       
        if ($surat){
            $this->response([
                // 'status'  => true, 
                'surat_manual' => $surat 
                // 'surat_manual' => [$data]
                
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'message' => 'note ID NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){

        $id = $this->delete('id');

        if( $id === null){
            $this->response([
                'message' => 'PROVIDE AN note ID'
            ], REST_Controller::HTTP_BAD_REQUEST);

        }else{

            if ( $this->surat->deletenote($id)>0){
                //ok
                $this->response([
                    'id' => $id,
                    'message' => 'DELETED'
                ], REST_Controller::HTTP_OK);

            }else{
                $this->response([
                    'message' => 'ID NOT FOUND'
                ], REST_Controller::HTTP_NOT_FOUND);

            }
        }
    }

    public function index_post()
    {
        $data = [
            'note'   => $this->post('note'),
        ];

        if ($this->surat->createnote($data)>0){
            $this->response([
                'message' => 'Data Berhasil di Simpan'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'message' => 'Data Gagal di Simpan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

    public function index_put()
    {
        $id   = $this->put('id');
        $data = [
            'note'   => $this->put('note'),
        ];
        if ($this->surat->updatenote($data, $id)>0){
            $this->response([
                'message' => 'Data Berhasil di Perbaharui'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'message' => 'Data Gagal di Perbaharui'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}

