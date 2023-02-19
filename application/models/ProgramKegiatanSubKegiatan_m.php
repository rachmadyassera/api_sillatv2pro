<?php

class ProgramKegiatanSubKegiatan_m extends CI_Model
{
    // public function getPKS($norek_sk){

		
	// 	$this->db->select('tahun_program, norek_program, nama_program, norek_kegiatan, nama_kegiatan, norek_sub_kegiatan, nama_sub_kegiatan, id_sub_kegiatan, nama_opd, id_opd_pro');
	// 	$this->db->from('tbl_kegiatan');
	// 	$this->db->join('tbl_program', 'tbl_kegiatan.id_program_kegiatan = tbl_program.id_program');
	// 	$this->db->join('tbl_sub_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_sub_kegiatan.id_kegiatan_sub_kegiatan');
	// 	$this->db->join('tbl_opd', 'tbl_sub_kegiatan.id_opd_sub_kegiatan = tbl_opd.id_opd');
	// 	$this->db->where('norek_sub_kegiatan', $norek_sk);
	// 	$this->db->limit(1);
	// 	$hsl = $this->db->get()->result_array();
	// 	return $hsl; 
        
    // }

	public function getPKS($opd){ 

		$this->db->select('norek_program, nama_program, norek_kegiatan, nama_kegiatan, norek_sub_kegiatan, nama_sub_kegiatan');
		$this->db->from('tbl_kegiatan');
		$this->db->join('tbl_program', 'tbl_kegiatan.id_program_kegiatan = tbl_program.id_program');
		$this->db->join('tbl_sub_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_sub_kegiatan.id_kegiatan_sub_kegiatan');
		$this->db->join('tbl_opd', 'tbl_sub_kegiatan.id_opd_sub_kegiatan = tbl_opd.id_opd');
		$this->db->where('id_opd', $opd); 
		$this->db->distinct('norek_sub_kegiatan');
		$hsl = $this->db->get()->result_array();
		return $hsl; 
        
    }

	public function getPKS_by_noreksubkegiatan($norek_sk, $opd){  
		$this->db->select('norek_program, nama_program, norek_kegiatan, nama_kegiatan, norek_sub_kegiatan, nama_sub_kegiatan, id_sub_kegiatan, id_opd, nama_opd');
		$this->db->from('tbl_kegiatan');
		$this->db->join('tbl_program', 'tbl_kegiatan.id_program_kegiatan = tbl_program.id_program');
		$this->db->join('tbl_sub_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_sub_kegiatan.id_kegiatan_sub_kegiatan');
		$this->db->join('tbl_opd', 'tbl_sub_kegiatan.id_opd_sub_kegiatan = tbl_opd.id_opd');
		$this->db->where('norek_sub_kegiatan', $norek_sk);  
		$this->db->where('id_opd', $opd); 
		$this->db->limit(1); 
		$hsl = $this->db->get()->result_array();
		return $hsl; 
        
    }


	public function getSumPaguPKS($norek_sk,$tahun,$opd){

		
		$this->db->select('norek_sub_kegiatan, nama_sub_kegiatan, tahun_program, id_sub_kegiatan, id_opd_pro, nama_opd');
		$this->db->select_sum('nilai_pagu');
		$this->db->from('tbl_kegiatan');
		$this->db->join('tbl_program', 'tbl_kegiatan.id_program_kegiatan = tbl_program.id_program');
		$this->db->join('tbl_sub_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_sub_kegiatan.id_kegiatan_sub_kegiatan'); 
		$this->db->join('tbl_sub2_kegiatan', 'tbl_sub_kegiatan.id_sub_kegiatan = tbl_sub2_kegiatan.id_sub_kegiatan_sub2_kegiatan');
		$this->db->join('tbl_pagu', 'tbl_sub2_kegiatan.id_sub2_kegiatan = tbl_pagu.id_sub2_kegiatan_pagu');
		$this->db->join('tbl_opd', 'tbl_pagu.id_opd_pagu = tbl_opd.id_opd');
		$this->db->where('tahun_program', $tahun);
		$this->db->where('norek_sub_kegiatan', $norek_sk); 
		$this->db->where('id_opd_pro', $opd); 
		$hsl = $this->db->get()->result_array();
		return $hsl; 
        
    }

	public function getSumRealisasiPKS($norek_sk,$tahun,$opd){

		
		$this->db->select('norek_sub_kegiatan, nama_sub_kegiatan, tahun_program, id_sub_kegiatan, id_opd_pro, nama_opd');
		$this->db->select_sum('nilai_realisasi');
		$this->db->from('tbl_kegiatan');
		$this->db->join('tbl_program', 'tbl_kegiatan.id_program_kegiatan = tbl_program.id_program');
		$this->db->join('tbl_sub_kegiatan', 'tbl_kegiatan.id_kegiatan = tbl_sub_kegiatan.id_kegiatan_sub_kegiatan'); 
		$this->db->join('tbl_sub2_kegiatan', 'tbl_sub_kegiatan.id_sub_kegiatan = tbl_sub2_kegiatan.id_sub_kegiatan_sub2_kegiatan');
		$this->db->join('tbl_realisasi', 'tbl_sub2_kegiatan.id_sub2_kegiatan = tbl_realisasi.id_sub2_kegiatan_realisasi');
		$this->db->join('tbl_opd', 'tbl_realisasi.id_opd_realisasi = tbl_opd.id_opd');
		$this->db->where('tahun_program', $tahun);
		$this->db->where('norek_sub_kegiatan', $norek_sk); 
		$this->db->where('id_opd_pro', $opd); 
		$hsl = $this->db->get()->result_array();
		return $hsl; 
        
    }



}
