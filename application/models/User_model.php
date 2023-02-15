<?php

class User_model extends CI_Model
{
    public function getUser($id = null){


        if($id === null){
        return $this->db->get('tbl_user')->result_array();
        }else{
        return  $this->db->get_where('tbl_user', ['user_id'=>$id])->result_array();
        }
        
    }

    public function deleteUser($id){
         $this->db->delete('tbl_user', ['user_id' => $id]);
         return  $this->db->affected_rows();
    }

    public function createUser($data){
        $this->db->insert('tbl_user', $data);
        return  $this->db->affected_rows();

    }

    public function updateUser($data, $id){
        $this->db->update('tbl_user', $data, ['user_id' => $id]);
        return  $this->db->affected_rows();
    }
}
