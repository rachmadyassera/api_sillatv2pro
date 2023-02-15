<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Users extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model', 'user');
    }

    public function index_get(){

        $email    = $this->get('email');
        $password = md5($this->get('password'));

        $user = $this->user->doLogin($email,$password);

       
        if ($user){

            $this->user->updateLastLogin($email);
            
            $this->response([
                'status'  => true,
                'message' => 'LOGIN SUCCESS',
                'data'    => $user 
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'PASSWORD OR EMAIL INVALID'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
 

    public function index_post()
    {
        $data = [
            'name'     => $this->post('name'),
            'email'    => $this->post('email'),
            'password' => md5($this->post('password')),
        ];


        $cek_email = $this->user->validEmail($data['email']);
        if ($cek_email->num_rows() > 0) {

            $this->response([
                'status'  => false,
                'message' => 'Email telah terdaftar.'
            ], REST_Controller::HTTP_BAD_REQUEST);
        
        }else{

            if ($this->user->createUser($data)>0){
                $this->response([
                    'status' => true,
                    'message' => 'Data Berhasil di Terdaftar'
                ], REST_Controller::HTTP_CREATED);
            }else{
                $this->response([
                    'status'  => false,
                    'message' => 'Data Gagal di Terdaftar'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }


    }

}

