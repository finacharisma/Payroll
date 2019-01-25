<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sayur extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Pegawai_m');
		$this->load->model('Sayur_m');
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['pegawai'] = $this->Pegawai_m->getNamaPegawaiKandang();
			$data['result'] = $this->Sayur_m->getAll(date('Y-m'));
			$this->load->view('Sayur_v',$data);
		}
	}
	
	public function lihatSayur()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['pegawai'] = $this->Pegawai_m->getNamaPegawaiKandang();
			$tgl = $this->uri->segment(3);
			$data['result'] = $this->Sayur_m->getAll($tgl);
			$this->load->view('Sayur_v',$data);
		}
	}
	
	public function ubahSayur()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$idPegawai = $this->input->post('idPegawai');
			$tgl = $this->uri->segment(3);
			if($tgl == '') $tgl = date('Y-m');
			$cek = $this->Sayur_m->getById($idPegawai,$tgl);
			
			if(count($cek)!=0){
				$data = array('totalKarung'=>$this->input->post('totalKarung'),
						'karungPokok'=>$this->input->post('karungPokok')
						);

				$result = $this->Sayur_m->ubahSayur($tgl,$idPegawai,$data);
			}else{
				$data = array('bulanPengambilan'=>$tgl,
						'idPegawai'=>$idPegawai,
						'totalKarung'=>$this->input->post('totalKarung'),
						'karungPokok'=>$this->input->post('karungPokok')
						);
				$result = $this->Sayur_m->tambahSayur($data);
			}
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Data gagal diubah');
			
			redirect('Sayur/lihatSayur/'.$tgl,'refresh');
		}
	}
}
