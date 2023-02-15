<?php

class Note_model extends CI_Model
{
    public function getNote($id = null){


        if($id === null){
        return $this->db->get('notes')->result_array();
        }else{
        return  $this->db->get_where('notes', ['id'=>$id])->result_array();
        }
        
    }

    public function deleteNote($id){
         $this->db->delete('notes', ['id' => $id]);
         return  $this->db->affected_rows();
    }

    public function createNote($data){
        $this->db->insert('notes', $data);
        return  $this->db->affected_rows();

    }

    public function updateNote($data, $id){
        $this->db->update('notes', $data, ['id' => $id]);
        return  $this->db->affected_rows();
    }
}
