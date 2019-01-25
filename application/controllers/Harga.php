<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Harga_m');
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['result'] = $this->Harga_m->getAll();
			$this->load->view('Harga_v',$data);
		}
	}
	
	public function ubahHarga()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('namaItem'=>$this->input->post('nama'),
						'harga'=>str_replace('.','',$this->input->post('hargaItem')),
						'tipe'=>$this->input->post('tipe')
						);
			$result = $this->Harga_m->ubahHarga($data);
			if($result)
				redirect('Harga','refresh');
		}
	}
	
	public function tambahHarga()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('namaItem'=>$this->input->post('namaItem'),
						'harga'=>str_replace('.','',$this->input->post('hargaItem')),
						'tipe'=>$this->input->post('tipe')
						);
			
			$result = $this->Harga_m->tambahHarga($data);
			if($result)
				redirect('Harga','refresh');
		}
	}
	
	public function hapusHarga()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$nama = $this->uri->segment(3);
			$nama = str_replace('_',' ',$nama);
			$result = $this->Harga_m->hapusHarga($nama, $this->uri->segment(4));
			
			if($result)
				redirect('Harga','refresh');
		}
	}

}
