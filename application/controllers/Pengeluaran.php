<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Pengeluaran_m');
		$this->load->model('Harga_m');
		$this->load->model('Pegawai_m');
		$this->load->model('Gaji_m');
		$this->load->model('Kandang_m');
		$this->load->model('PegawaiKandang_m');
	}
	
	public function generate($tgl, $idKandang, $namaKandang){
		$dataku = $idPegawai = $nama = $bonusBeras = [];
		$namaPegawai = '';
		$hasil = $this->Pengeluaran_m->detailPengeluaran($tgl, $idKandang);
		$kandang = $this->Kandang_m->getById($idKandang);
		
		//pengeluaran kandang itu di tanggal itu apa aja
		$i = $rutin = $nonrutin = 0;
		if(count($hasil) != 0){
			foreach($hasil as $row){
				$dataku['detail'][$i]['jenisPengeluaran'] = $row->jenisPengeluaran;
				$dataku['detail'][$i]['tanggalKeluar'] = $row->tanggalKeluar;
				$dataku['detail'][$i]['jumlahPengeluaran'] = $row->jumlahPengeluaran;
				$dataku['detail'][$i]['tipePengeluaran'] = $row->tipePengeluaran;
				
				if($row->tipePengeluaran == 'rutin'){
					$rutin += $dataku['detail'][$i]['jumlahPengeluaran'];
				}else{
					$nonrutin += $dataku['detail'][$i]['jumlahPengeluaran'];
				}	
				$i += 1;
			}
		}else{
			$dataku['detail'] = [];
		}
		
		//nama pekerja
		$pekerja = $this->PegawaiKandang_m->PKDiKandang($idKandang);
		$a=0;
		foreach($pekerja as $p){
			$namaPegawai .= $p->Pegawai_m->namaPegawai.', ';

			$idPegawai[$a] = $p->idPegawai;
			$nama[$a] = $p->Pegawai_m->namaPegawai;
			$bonusBeras[$a] = $p->Pegawai_m->bonusBeras;
			$a++;
		}
		$dataku['namaPegawai'] = substr($namaPegawai,0,-2);
		
		//gaji pegawai bulan sebelumnya
		$t = explode('-', $tgl);
		if($t[1]=='01'){
			$tanggal = ($t[0]-1).'-12';
		}else{
			$tanggal = $t[0].'-';
			if(($t[1]-1) < 10){
				$tanggal .= '0'.($t[1]-1);
			}else{
				$tanggal .= ($t[1]-1);
			}
		}
		
		$dataku['gajiPegawai'] = [];
		for($b=0;$b<count($idPegawai);$b++){
			$gajiPegawai = $this->Gaji_m->searchByTglIdFlag($tanggal, $idPegawai[$b]);
			if((count($gajiPegawai) != 0) and ($idPegawai[$b] != 13)){
				$dataku['gajiPegawai'][$b]['nama'] = $nama[$b];
				$dataku['gajiPegawai'][$b]['gaji'] = $gajiPegawai[0]['totalGaji'] + $gajiPegawai[0]['totalHutang'] + (9000 * $bonusBeras[$b]);
			}
		}
		
		$dataku['idKandang'] = $idKandang;
		$dataku['namaKandang'] = $namaKandang;
		$dataku['tanggalKeluar'] = $tgl;
		$dataku['rutin'] = $rutin;
		$dataku['nonrutin'] = $nonrutin;
		
		$data = json_encode($dataku);
		$data = json_decode($data);
		
		return $data;
	}
	
	public function index()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data['result'] = $this->Pengeluaran_m->getNow(date('Y-m'));
			$this->load->view('Pengeluaran_v',$data);
		}
	}
	
	public function allPengeluaran()
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
			$this->load->view('Pengeluaran_v',$data);
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
			$data['harga'] = $this->Harga_m->hargaPengeluaran();
			
			$this->load->view('DetailPengeluaran_v',$data);
			// echo '<pre>';
			// print_r($data['result']);
			// echo '<pre>';

		}
	}
	
	public function tambahPengeluaran()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tipe = $this->input->post('tipePengeluaran');
			$idK = $this->input->post('idK');
			$tgl = $this->input->post('tgl');
			
			$tglKeluar = $this->input->post('tanggalKeluar');
			$jenis = $this->input->post('jenisPengeluaran');
			$type = $this->input->post('tipe');
			if($tipe == 'nonpokok'){		
				$jumlah = str_replace('.','',$this->input->post('jumlahPengeluaran'));
			}else{
				$jumlah = floatval($this->input->post('jumlah'))*$this->input->post('harga');
			}
			$data = array('idKandang'=>$idK,
						'tanggalKeluar'=>$tglKeluar,
						'jenisPengeluaran'=>$jenis,
						'jumlahPengeluaran'=>$jumlah,
						'tipePengeluaran'=>$type,
						);
			
			$result = $this->Pengeluaran_m->tambahPengeluaran($data);
			if($result)
				redirect('Pengeluaran/detail/'.$tgl.'/'.$idK,'refresh');
			else
				echo "gagal";
		}
	}
	
	public function ubahPengeluaran()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('idKandang'=>$this->input->post('idK'),
						'tanggalKeluar'=>$this->input->post('tglK'),
						'jenisPengeluaran'=>$this->input->post('jenisK'),
						'jumlahPengeluaran'=>str_replace('.','',$this->input->post('jumlahK'))
						);
			
			$result = $this->Pengeluaran_m->ubahPengeluaran($data);
			$tgl = substr($data['tanggalKeluar'],0,7);
			if($result)
				redirect('Pengeluaran/detail/'.$tgl.'/'.$data['idKandang'],'refresh');
		}
	}
	
	public function hapusPengeluaran()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$id = $this->uri->segment(3);
			$tanggal = $this->uri->segment(4);
			$str = $this->uri->segment(5);
			$jns = str_replace('_',' ',$str);
			
			$result = $this->Pengeluaran_m->hapusPengeluaran($id, $tanggal, $jns);
			$tgl = substr($tanggal,0,7);
			if($result)
				redirect('Pengeluaran/detail/'.$tgl.'/'.$id,'refresh');
		}
	}
}
