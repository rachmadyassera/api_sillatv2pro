<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Auth extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'model');
    }

    public function index_get(){

        $email    = $this->get('email');
        $password = md5($this->get('password'));

        $user = $this->model->doLogin($email,$password);

       
        if ($user){

            // $this->model->updateLastLogin($email);
            if ($user['level'] == 2){
                $this->response([
                    'status'  => true,
                    'message' => 'LOGIN SUCCESS',
                    'data'    => $user 
                ], REST_Controller::HTTP_OK);
            
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'Hak Akses Ditolak '
                ], REST_Controller::HTTP_BAD_REQUEST);            
            }

            
        }else{
            $this->response([
                'status' => false,
                'message' => 'PASSWORD OR EMAIL INVALID'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // public function index_delete(){

    //     $id = $this->delete('user_id');

    //     if( $id === null){
    //         $this->response([
    //             'status' => false,
    //             'message' => 'PROVIDE AN USER ID'
    //         ], REST_Controller::HTTP_BAD_REQUEST);

    //     }else{

    //         if ( $this->model->deleteUser($id)>0){
    //             //ok
    //             $this->response([
    //                 'status' => true,
    //                 'id' => $id,
    //                 'message' => 'DELETED'
    //             ], REST_Controller::HTTP_OK);

    //         }else{
    //             $this->response([
    //                 'status'  => false,
    //                 'message' => 'ID NOT FOUND'
    //             ], REST_Controller::HTTP_NOT_FOUND);

    //         }
    //     }
    // }

    // public function index_post()
    // {
    //     $data = [
    //         'name'     => $this->post('name'),
    //         'email'    => $this->post('email'),
    //         'password' => md5($this->post('password')),
    //     ];


    //     $cek_email = $this->model->validEmail($data['email']);
    //     if ($cek_email->num_rows() > 0) {

    //         $this->response([
    //             'status'  => false,
    //             'message' => 'Email telah terdaftar.'
    //         ], REST_Controller::HTTP_BAD_REQUEST);
        
    //     }else{

    //         if ($this->model->createUser($data)>0){
    //             $this->response([
    //                 'status' => true,
    //                 'message' => 'Data Berhasil di Terdaftar'
    //             ], REST_Controller::HTTP_CREATED);
    //         }else{
    //             $this->response([
    //                 'status'  => false,
    //                 'message' => 'Data Gagal di Terdaftar'
    //             ], REST_Controller::HTTP_BAD_REQUEST);
    //         }
    //     }  
    // }

    public function index_put()
    {
        $id   = $this->put('user_id');
        $data = [
            'user_name'   => $this->put('username'),
            'user_email'  => $this->put('email'),
            'user_level'  => $this->put('level'),
            'user_status' => $this->put('status'),
        ];
        if ($this->model->updateUser($data, $id)>0){
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

