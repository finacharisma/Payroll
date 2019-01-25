<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Admin_m');
		$this->load->model('Pegawai_m');
	}
	
	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('login_v');
	}
	
	public function masuk()
	{
		$data = $this->input->post();
		
		$result = $this->Admin_m->masuk($data['username'], $data['password']);
		if(count($result) != 0)
		{
			$this->session->set_userdata('username',$result[0]["username"]);
			redirect(site_url().'Home');
		}else{
			$result2 = $this->Pegawai_m->masuk($data['username'], $data['password']);
			if(count($result2) != 0)
			{
				$this->session->set_userdata('idPegawai',$result2[0]["idPegawai"]);
				$this->session->set_userdata('username','?');
				redirect(site_url().'Gaji/cetakDetail/'.date('Y-m').'/'.$result2[0]["idPegawai"]);
			}else{
				$this->session->set_flashdata('keterangan','Username dan password tidak cocok atau tidak ditemukan');
				redirect(site_url());
			}
		}
	}
	
	public function keluar() {
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
