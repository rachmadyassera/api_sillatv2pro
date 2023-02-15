<?php

class Opd_m extends CI_Model
{
    public function getOPD(){ 

        return $this->db->get('tbl_opd')->result_array();  
    } 
}
