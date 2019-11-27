<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom extends CI_Model{
	function cek_foto($foto, $kriteria = "", $kode = ""){
		if(empty($kode)){
			$thumb = base_url('assets/img').'/'.$kriteria.'/'.$foto;
			$loc   = "./assets/img/".$kriteria.'/'.$foto;
		}else if(empty($kriteria)){
			$thumb = base_url('assets/img').'/'.$foto;
			$loc   = "./assets/img/".$foto;
		}else{
			$thumb = base_url('assets/img').'/'.$kriteria.'/'.$kode.'/'.$foto;
			$loc   = "./assets/img/".$kriteria.'/'.$kode.'/'.$foto;
		}

		if(!file_exists($loc)){
		    if(empty($kriteria)){
			    $thumb = base_url('assets/img').'/no.jpg';
		    }else{
			    $thumb = base_url('assets/img').'/'.$kriteria.'/no.jpg';
		    }
		}

		return $thumb;
	}
}