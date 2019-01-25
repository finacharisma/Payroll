<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Keuntungan_m');
		$this->load->model('Admin_m');
		$this->load->model('Kandang_m');
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$this->load->view('Home_v');
		}
	}
	
	public function viewChart()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->input->post('tgl');
			$tglbefore = $this->input->post('tglbefore');

			$data['label'] = $data['isi'] = [];
			$kandang = $this->Kandang_m->getNama();
			$hasil = $this->Keuntungan_m->viewByTgl($tgl);
			$hasil2 = $this->Keuntungan_m->viewByTgl($tglbefore);

			$i = $c = 0;
			if(count($kandang) != 0){
				foreach($kandang as $row){
					if(count($hasil) == 0){
						$data['label'][$c] = $row->namaKandang;
						$data['isi'][$c] = 0;
					}else if($i<count($hasil) and ($row->idKandang == $hasil[$i]['idKandang'])){
						$data['label'][$c] = $row->namaKandang;
						$data['isi'][$c] = $hasil[$i]['totalKeuntungan'];
						
						$i++;
					}else{
						$data['label'][$c] = $row->namaKandang;
						$data['isi'][$c] = 0;
					}
					$c+=1;					
				}
			}
			
			$i = $c = 0;
			if(count($kandang) != 0){
				foreach($kandang as $row){
					if(count($hasil2) == 0){
						$data['isi2'][$c] = 0;
					}else if($i<count($hasil2) and ($row->idKandang == $hasil2[$i]['idKandang'])){
						$data['isi2'][$c] = $hasil2[$i]['totalKeuntungan'];
						
						$i++;
					}else{
						$data['isi2'][$c] = 0;
					}
					$c+=1;					
				}
			}
			echo json_encode($data);
		}
	}
	
	public function ubahPassword()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$password = $this->input->post('password');
			$hasil = $this->Admin_m->ubahPassword($password);
			if($hasil){
				$data = 'Password berhasil diubah';
			}else{
				$data = 'Password Gagal Diubah';
			}
			echo json_encode($data);
		}
	}
}
