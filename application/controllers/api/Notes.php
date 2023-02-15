<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Notes extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Note_model', 'note');
    }

    public function index_get(){

        $id = $this->get('id');

        if ($id === null){

        $note = $this->note->getnote();
        
        }else{

            $note = $this->note->getnote($id);

        }
       
        if ($note){
            $this->response([
                'notes' => $note
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

            if ( $this->note->deletenote($id)>0){
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

        if ($this->note->createnote($data)>0){
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
        if ($this->note->updatenote($data, $id)>0){
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

