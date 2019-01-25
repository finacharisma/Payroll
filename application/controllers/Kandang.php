<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandang extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Kandang_m');
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['result'] = $this->Kandang_m->getAll();
			$this->load->view('Kandang_v',$data);
		}
	}
	
	public function tambahKandang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('namaKandang'=>$this->input->post('namaKandang'),
						'lokasi'=>$this->input->post('lokasi'));
			
			$result = $this->Kandang_m->tambahKandang($data);
			if($result)
				redirect('Kandang','refresh');
		}
	}
	
	public function ubahKandang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$idKandang = $this->input->post('idKandang');
			$data = array('namaKandang'=>$this->input->post('namaKandang'),
						'lokasi'=>$this->input->post('lokasi'));
			
			$result = $this->Kandang_m->ubahKandang($idKandang, $data);
			if($result)
				redirect('Kandang','refresh');
			
		}
	}
	
	public function hapusKandang()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$result = $this->Kandang_m->hapusKandang($this->uri->segment(3));
			
			if($result)
				redirect('Kandang','refresh');
		}
	}
}
