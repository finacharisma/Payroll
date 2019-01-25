<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ampas extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Pegawai_m');
		$this->load->model('Ampas_m');
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['pegawai'] = $this->Pegawai_m->getNamaPegawaiAmpas();
			$data['result'] = $this->Ampas_m->getAll(date('Y-m'));
			$this->load->view('Ampas_v',$data);
		}
	}
	
	public function lihatAmpas()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['pegawai'] = $this->Pegawai_m->getNamaPegawaiAmpas();
			$tgl = $this->uri->segment(3);
			$data['result'] = $this->Ampas_m->getAll($tgl);
			$this->load->view('Ampas_v',$data);
		}
	}
	
	public function ubahAmpas()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$idPegawai = $this->input->post('idPegawai');
			$tgl = $this->uri->segment(3);
			if($tgl == '') $tgl = date('Y-m');
			$cek = $this->Ampas_m->cek($idPegawai,$tgl);
			
			if(count($cek)!=0){
				$data = array('tunggal'=>$this->input->post('tunggal'),
						'tunggalPlus'=>$this->input->post('tunggalPlus'),
						'ganda'=>$this->input->post('ganda'),
						'gandaPlus'=>$this->input->post('gandaPlus'),
						'tonase'=>$this->input->post('tonase')
						);

				$result = $this->Ampas_m->ubahAmpas($tgl,$idPegawai,$data);
			}else{
				$data = array('bulanPengambilan'=>$tgl,
						'idPegawai'=>$idPegawai,
						'tunggal'=>$this->input->post('tunggal'),
						'tunggalPlus'=>$this->input->post('tunggalPlus'),
						'ganda'=>$this->input->post('ganda'),
						'gandaPlus'=>$this->input->post('gandaPlus'),
						'tonase'=>$this->input->post('tonase')
						);
				$result = $this->Ampas_m->tambahAmpas($data);
			}
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Data gagal diubah');
			
			redirect('Ampas/lihatAmpas/'.$tgl,'refresh');
		}
	}
}
