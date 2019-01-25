<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Pemasukan_m');
		$this->load->model('Harga_m');
		$this->load->model('Pegawai_m');
		$this->load->model('PegawaiKandang_m');
		$this->load->model('Kandang_m');
	}
	
	public function generate($tgl, $idKandang, $namaKandang){
		$dataku = [];
		$pegawai = '';
		$hasil = $this->Pemasukan_m->detailPemasukan($tgl, $idKandang);
		
		//pemasukan kandang itu di tanggal itu apa aja
		$i = $pemasukanRutin = $pemasukanNonrutin = 0;
		if(count($hasil) != 0){
			foreach($hasil as $row){
				$dataku['detail'][$i]['jenisPemasukan'] = $row->jenisPemasukan;
				$dataku['detail'][$i]['tanggalMasuk'] = $row->tanggalMasuk;
				$dataku['detail'][$i]['jumlahPemasukan'] = $row->jumlahPemasukan;
				$dataku['detail'][$i]['tipePemasukan'] = $row->tipePemasukan;
				
				if($row->tipePemasukan == 'rutin'){
					$pemasukanRutin += $dataku['detail'][$i]['jumlahPemasukan'];
				}else{
					$pemasukanNonrutin += $dataku['detail'][$i]['jumlahPemasukan'];
				}			
				$i += 1;
			}
		}else{
			$dataku['detail'] = [];
		}
		
		//nama pekerja
		$pekerja = $this->PegawaiKandang_m->PKDiKandang($idKandang);
		foreach($pekerja as $p){
			$pegawai .= $p->Pegawai_m->namaPegawai.', ';
		}
		$dataku['namaPegawai'] = substr($pegawai,0,-2);
		
		$dataku['idKandang'] = $idKandang;
		$dataku['namaKandang'] = $namaKandang;
		$dataku['tanggalMasuk'] = $tgl;
		$dataku['rutin'] = $pemasukanRutin;
		$dataku['nonRutin'] = $pemasukanNonrutin;
		
		$data = json_encode($dataku);
		$data = json_decode($data);
		
		return $data;
	}
	
	public function allPemasukan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$dataku = [];
			$tgl = $this->uri->segment(3);
			$kandang = $this->Kandang_m->getAll();
				
			for($i=0;$i<count($kandang);$i++){
				$dataku[$i] = $this->generate($tgl, $kandang[$i]['idKandang'], $kandang[$i]['namaKandang']);
			}
			
			$data['result'] = $dataku;
			$this->load->view('Pemasukan_v',$data);
		}
	}
	
	public function detail()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$idKandang = $this->uri->segment(4);
			$nama = $this->Kandang_m->getById($idKandang);

			$data['result'] = $this->generate($tgl, $idKandang, $nama->namaKandang);
			$data['harga'] = $this->Harga_m->hargaPemasukan();
			
			$this->load->view('DetailPemasukan_v',$data);
		}

	}
	
	public function tambahPemasukan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tipe = $this->input->post('tipePemasukan');
			$idK = $this->input->post('idK');
			$tgl = $this->input->post('tgl');
			
			$tglMasuk = $this->input->post('tanggalMasuk');
			$jenis = $this->input->post('jenisPemasukan');
			$type = $this->input->post('tipe');
			
			if($tipe == 'nonpokok'){
				$jumlah = str_replace('.','',$this->input->post('jumlahPemasukan'));
			}else{
				$jumlah = floatval($this->input->post('jumlah'))*$this->input->post('harga');
			}
			$data = array('idKandang'=>$idK,
						'tanggalMasuk'=>$tglMasuk,
						'jenisPemasukan'=>$jenis,
						'jumlahPemasukan'=>$jumlah,
						'tipePemasukan'=>$type
						);

			$result = $this->Pemasukan_m->tambahPemasukan($data);
			if($result)
				redirect('Pemasukan/detail/'.$tgl.'/'.$idK,'refresh');
			else
				echo "gagal";
		}
	}
	
	public function ubahPemasukan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('idKandang'=>$this->input->post('idK'),
						'tanggalMasuk'=>$this->input->post('tglM'),
						'jenisPemasukan'=>$this->input->post('jenisP'),
						'jumlahPemasukan'=>str_replace('.','',$this->input->post('jumlahP'))
						);
			
			$result = $this->Pemasukan_m->ubahPemasukan($data);
			$tgl = substr($data['tanggalMasuk'],0,7);
			if($result)
				redirect('Pemasukan/detail/'.$tgl.'/'.$data['idKandang'],'refresh');
		}
	}
	
	public function hapusPemasukan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$id = $this->uri->segment(3);
			$tanggal = $this->uri->segment(4);
			$str = $this->uri->segment(5);
			$jns = str_replace('_',' ',$str);
			
			$result = $this->Pemasukan_m->hapusPemasukan($id, $tanggal, $jns);
			$tgl = substr($tanggal,0,7);
			if($result)
				redirect('Pemasukan/detail/'.$tgl.'/'.$id,'refresh');
		}
	}
}
