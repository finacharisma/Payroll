<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Pegawai_m');
		$this->load->model('PegawaiAmpas_m');
		$this->load->model('PegawaiKandang_m');
		$this->load->model('Kandang_m');
	}
	
	public function PegawaiKandang()
	{
		$data['result'] = $this->Pegawai_m->getAllPKandang();
		$data['kandang'] = $this->Kandang_m->getAll();
		$this->load->view('PegawaiKandang_v',$data);
	}
	
	public function PegawaiAmpas()
	{
		$data['result'] = $this->Pegawai_m->getAllPAmpas();
		$this->load->view('PegawaiAmpas_v',$data);
	}
	
	public function tambahPegawai()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			//cek username udah ada belom
			$adauser = $this->Pegawai_m->cekusername($this->input->post('username'));
			if(count($adauser) == 0){
				$tahun = $this->input->post('tahunMasuk').'-00-00';
				$data = array('username'=>$this->input->post('username'),
							'password'=>$this->input->post('password'),
							'namaPegawai'=>$this->input->post('namaPegawai'),
							'tahunMasuk'=>$tahun,
							'telepon'=>$this->input->post('telepon'),
							'bonusBeras'=>$this->input->post('bonusBeras'),
							'bonusMasaKerja'=>str_replace('.', '',$this->input->post('bonusMasaKerja')),
							'tipePegawai'=>$this->input->post('tipePegawai')
							);
				
				$result = $this->Pegawai_m->tambahPegawai($data);
				if($result){
					$id = $this->Pegawai_m->cekbeforeadd($this->input->post('username'));
					if($data['tipePegawai'] == 'Ampas'){
						$inp = array('idPegawai'=>$id[0]['idPegawai'],
							'tunggal'=>str_replace('.', '',$this->input->post('tunggal')),
							'tunggalPlus'=>str_replace('.', '',$this->input->post('tunggalPlus')),
							'ganda'=>str_replace('.', '',$this->input->post('ganda')),
							'gandaPlus'=>str_replace('.', '',$this->input->post('gandaPlus'))
							);
						
						$this->PegawaiAmpas_m->tambahPegawaiAmpas($inp);
					}else{
						$inp = array('idPegawai'=>$id[0]['idPegawai'],
							'idKandang'=>$this->input->post('namaKandang'),
							'gajiPokok'=>str_replace('.', '',$this->input->post('gajiPokok')),
							'bonusKeluarga'=>str_replace('.', '',$this->input->post('bonusKeluarga')),
							'bonusUsaha'=>$this->input->post('bonusUsaha')
							);
						
						$this->PegawaiKandang_m->tambahPegawaiKandang($inp);
					}
				}else{
					$this->session->set_flashdata('errMsg','data gagal ditambahkan');
				}		
			}else
				$this->session->set_flashdata('errMsg','username sudah ada');
			
			redirect('Pegawai/'.$this->uri->segment(3),'refresh');
		}
	}
	
	public function ubahPegawai()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$idPegawai = $this->input->post('idPegawai');
			$tahun = $this->input->post('tahunMasuk').'-00-00';
			$data = array('namaPegawai'=>$this->input->post('namaPegawai'),
						'password'=>$this->input->post('password'),
						'tahunMasuk'=>$tahun,
						'telepon'=>$this->input->post('telepon'),
						'bonusBeras'=>$this->input->post('bonusBeras'),
						'bonusMasaKerja'=>str_replace('.', '',$this->input->post('bonusMasaKerja')),
						'tipePegawai'=>$this->input->post('tipePegawai')
						);
			
			$result = $this->Pegawai_m->ubahPegawai($idPegawai, $data);
			
			if($data['tipePegawai'] == 'Ampas'){
					$id = $this->PegawaiAmpas_m->cekid($idPegawai);
					$inp = array('tunggal'=>str_replace('.', '',$this->input->post('tunggal')),
						'tunggalPlus'=>str_replace('.', '',$this->input->post('tunggalPlus')),
						'ganda'=>str_replace('.', '',$this->input->post('ganda')),
						'gandaPlus'=>str_replace('.', '',$this->input->post('gandaPlus'))
						);
					if(count($id)!=0)
						$this->PegawaiAmpas_m->ubahPegawaiAmpas($idPegawai, $inp);
					else{
						$inp['idPegawai'] = $idPegawai;
						$this->PegawaiAmpas_m->tambahPegawaiAmpas($inp);
					}
				}else{
					$id = $this->PegawaiKandang_m->cekid($idPegawai);
					$inp = array('idKandang'=>$this->input->post('namaKandang'),
							'gajiPokok'=>str_replace('.', '',$this->input->post('gajiPokok')),
							'bonusKeluarga'=>str_replace('.', '',$this->input->post('bonusKeluarga')),
							'bonusUsaha'=>$this->input->post('bonusUsaha')
						);
					if(count($id)!=0){
						$this->PegawaiKandang_m->ubahPegawaiKandang($idPegawai, $inp);
					}else{
						$inp['idPegawai'] = $idPegawai;
						$this->PegawaiKandang_m->tambahPegawaiKandang($inp);
					}
				}
			
			redirect('Pegawai/'.$this->uri->segment(3),'refresh');
		}
	}
	
	public function hapusPegawai()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$id = $this->uri->segment(3);
			$result = $this->Pegawai_m->hapusPegawai($id);
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Data gagal dihapus');
			
			redirect('Pegawai/'.$this->uri->segment(4),'refresh');
		}
	}
}
