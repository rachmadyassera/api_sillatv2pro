<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class User extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index_get(){

        $id = $this->get('user_id');
        if ($id === null){

        $user = $this->user->getUser();
        
        }else{

            $user = $this->user->getUser($id);

        }
       
        if ($user){
            $this->response([
                'status' => true,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'USER ID NOT FOUND'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete(){

        $id = $this->delete('user_id');

        if( $id === null){
            $this->response([
                'status' => false,
                'message' => 'PROVIDE AN USER ID'
            ], REST_Controller::HTTP_BAD_REQUEST);

        }else{

            if ( $this->user->deleteUser($id)>0){
                //ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'DELETED'
                ], REST_Controller::HTTP_OK);

            }else{
                $this->response([
                    'status'  => false,
                    'message' => 'ID NOT FOUND'
                ], REST_Controller::HTTP_NOT_FOUND);

            }
        }
    }

    public function index_post()
    {
        $data = [
            'user_name'   => $this->post('username'),
            'user_email'  => $this->post('email'),
            'user_level'  => $this->post('level'),
            'user_status' => $this->post('status'),
        ];

        if ($this->user->createUser($data)>0){
            $this->response([
                'status' => true,
                'message' => 'Data Berhasil di Simpan'
            ], REST_Controller::HTTP_CREATED);
        }else{
            $this->response([
                'status'  => false,
                'message' => 'Data Gagal di Simpan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }

    }

    public function index_put()
    {
        $id   = $this->put('user_id');
        $data = [
            'user_name'   => $this->put('username'),
            'user_email'  => $this->put('email'),
            'user_level'  => $this->put('level'),
            'user_status' => $this->put('status'),
        ];
        if ($this->user->updateUser($data, $id)>0){
            $this->response([
                'status' => true,
                'message' => 'Data Berhasil di Perbaharui'
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status'  => false,
                'message' => 'Data Gagal di Perbaharui'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}

