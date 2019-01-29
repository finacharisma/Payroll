<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hutang extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Hutang_m');
		$this->load->model('Pegawai_m');
	}
	
	public function belumLunas()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['result'] = $this->Hutang_m->belumLunas();
			$data['pegawai'] = $this->Pegawai_m->getNamaPegawai();
			$this->load->view('Hutang_v',$data);
		}
	}
	
	public function lunas()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['result'] = $this->Hutang_m->lunas();
			$this->load->view('Hutang_v',$data);
		}
	}
	
	public function tambahHutang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('tanggalHutang'=>$this->input->post('tanggalHutang'),
						'idPegawai'=>$this->input->post('idPegawai'),
						'jumlahHutang'=>str_replace('.','',$this->input->post('jumlahHutang'))
						);
			
			$result = $this->Hutang_m->tambahHutang($data);
			if($result)
				redirect('Hutang\belumLunas','refresh');
		}
	}
	
	public function ubahHutang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('idPegawai'=>$this->input->post('idPegawai'),
						'tanggalHutang'=>$this->input->post('tanggalHutang'),
						'sisaHutang'=>$this->input->post('sisaHutang')-str_replace('.','',$this->input->post('jumlahBayar'))
						);
			if($data['sisaHutang'] == 0)
				$data['tanggalLunas'] = date('Y-m-d');
			
			if($data['sisaHutang'] < 0){
				$this->session->set_flashdata('errMsg','Gagal mengubah data. jumlah yang dibayar lebih besar dari hutang');
				redirect('Hutang\belumLunas','refresh');
			}else{
				$result = $this->Hutang_m->ubahHutang($data);
				if($result)
					redirect('Hutang\belumLunas','refresh');
			}
		}
	}
	
	public function hapusHutang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$result = $this->Hutang_m->hapusHutang($this->uri->segment(3), $this->uri->segment(4));
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Gagal menghapus data');
			
			redirect('Hutang\belumLunas','refresh');
		}
	}
}
