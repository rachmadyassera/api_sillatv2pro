<?php

class Surat_model extends CI_Model
{
    public function get_all_sm(){
  
        return  $this->db->get('tbl_surat_manual')->result_array(); 
        
    }
    
    public function get_surat_opd($id_opd){
  
        return  $this->db->get_where('tbl_surat_manual', ['id_opd_sm'=>$id_opd,'status_sm'=>1])->result_array(); 
        
    }

    public function get_surat_byid($id_sm){ 

        return  $this->db->get_where('tbl_surat_manual', ['id_surat_manual'=>$id_sm])->row_array(); 
        
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
