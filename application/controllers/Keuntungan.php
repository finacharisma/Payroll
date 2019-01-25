<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keuntungan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Keuntungan_m');
		$this->load->model('Pemasukan_m');
		$this->load->model('Pengeluaran_m');
		$this->load->model('Kandang_m');
		$this->load->model('PegawaiKandang_m');
		$this->load->model('Gaji_m');
	}
	
	public function generate($tgl){
			$dataku = [];
			$no = $im = $ik = 0; //no: counter kandang, im: index pemasukan, ik: index pengeluaran
			
			$kandang= $this->Kandang_m->getAll();
			$pemasukan = $this->Pemasukan_m->getNow($tgl);
			$pengeluaran = $this->Pengeluaran_m->getNow($tgl);
			
			if(count($kandang) != 0){
				foreach($kandang as $k){
					$idPegawai = $bonusBeras = [];
					$namaPegawai = '';
					$dataku[$no]['idKandang'] = $k->idKandang;
					$dataku[$no]['namaKandang'] = $k->namaKandang;
								
					//pemasukan
					if(count($pemasukan) != 0){
						if($im<count($pemasukan) and ($pemasukan[$im]['idKandang'] == $k->idKandang)){
							$dataku[$no]['pemasukan'] = $pemasukan[$im]['sum'];
							$im += 1;
						}else{
							$dataku[$no]['pemasukan'] = 0;
						}	
					}else{
						$dataku[$no]['pemasukan'] = 0;
					}
					
					//pengeluaran
					if(count($pengeluaran) != 0){
						if($ik<count($pengeluaran) and ($pengeluaran[$ik]['idKandang'] == $k->idKandang)){
							$dataku[$no]['pengeluaran'] = $pengeluaran[$ik]['sum'];
							$ik += 1;
						}else{
							$dataku[$no]['pengeluaran'] = 0;
						}
					}else{
						$dataku[$no]['pengeluaran'] = 0;
					}
					
					//nama pekerja
					$pekerja = $this->PegawaiKandang_m->PKDiKandang($k->idKandang);
					$a=0;
					foreach($pekerja as $p){
						$namaPegawai .= $p->Pegawai_m->namaPegawai.', ';
						$idPegawai[$a] = $p->idPegawai;
						$bonusBeras[$a] = $p->Pegawai_m->bonusBeras;
						$a++;
					}
					$dataku[$no]['namaPegawai'] = substr($namaPegawai,0,-2);
					
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
					
					$gaji = 0;
					for($b=0;$b<count($idPegawai);$b++){
						$gajiPegawai = $this->Gaji_m->searchByTglId($tanggal, $idPegawai[$b]);
						if(count($gajiPegawai) != 0){
							$gaji += $gajiPegawai[0]['totalGaji'] + $gajiPegawai[0]['totalHutang'] + (9000 * $bonusBeras[$b]);
						}
					}
					$dataku[$no]['pengeluaran'] += $gaji;
					//end of pengeluaran
					
					$dataku[$no]['keuntungan'] = $dataku[$no]['pemasukan'] - $dataku[$no]['pengeluaran'];
					
					//liat data keuntungan yang saved
					$ksaved = $this->Keuntungan_m->viewByIdkandangTgl($k->idKandang, $tgl);
					if(count($ksaved) != 0){
						$dataku[$no]['keuntungansaved'] = $ksaved[0]['totalKeuntungan'];
					}else{
						$dataku[$no]['keuntungansaved'] = 0;
					}
					
					$no += 1;
				}
			}
			$dataku = json_encode($dataku);
			$dataku = json_decode($dataku);
			return $dataku;
	}
	
	public function getAll()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$data['result'] = $this->generate($tgl);
			$cekdatakeuntungan = $this->Keuntungan_m->viewByTgl($tgl);
			if(count($cekdatakeuntungan) != 0){
				$data['status'] = 'saved';
			}else{
				$data['status'] = '!saved';
			}
			
			$this->load->view('Keuntungan_v',$data);
			// echo '<pre>';
			// print_r($data);
			// echo '<pre>';

		}
	}
	
	public function simpanKeuntungan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$hasil = $this->generate($tgl);
			
			foreach($hasil as $row){
				$data = array('keuntunganTanggal'=>$tgl,
						'idKandang'=>$row->idKandang,
						'totalKeuntungan'=>$row->keuntungan
						);
				$this->Keuntungan_m->simpanKeuntungan($data);
			}
			
			redirect('Keuntungan/getAll/'.$tgl,'refresh');
		}
	}

	public function resetKeuntungan()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			
			$this->Keuntungan_m->resetKeuntungan($tgl);
			
			redirect('Keuntungan/getAll/'.$tgl,'refresh');
		}
	}
}
