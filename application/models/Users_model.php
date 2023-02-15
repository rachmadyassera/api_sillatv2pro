<?php

class Users_model extends CI_Model
{
    public function getUser($id = null){

        if($id === null){
        return $this->db->get('user')->result_array();
        }else{
        return  $this->db->get_where('user', ['id'=>$id])->result_array();
        }
        
    }

    public function doLogin($email,$password){

        return  $this->db->get_where('user', ['email'=>$email, 'password'=>$password])->row_array();
            
    }

    public function validEmail($email){

        return  $this->db->get_where('user', ['email'=>$email]);
                
    }

    // public function deleteUser($id){
    //      $this->db->delete('user', ['user_id' => $id]);
    //      return  $this->db->affected_rows();
    // }

    public function createUser($data){
        
        $this->db->insert('user', $data);
        return  $this->db->affected_rows();

    }

    // public function updateUser($data, $id){
    //     $this->db->update('user', $data, ['id' => $id]);
    //     return  $this->db->affected_rows();
    // }

    public function updateLastLogin($email){
        $date = Date('Y-m-d');
        $data = array(
            'last_login'           => $date
        );
        $this->db->where('email', $email)->update('user', $data);

        return  $this->db->affected_rows();
    }
}
