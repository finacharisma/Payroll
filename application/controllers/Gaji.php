<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
        $this->load->library('Pdf');
		$this->load->model('Gaji_m');
		$this->load->model('Pegawai_m');
		$this->load->model('PegawaiAmpas_m');
		$this->load->model('PegawaiKandang_m');
		$this->load->model('Bonus_m');
		$this->load->model('Hutang_m');
		$this->load->model('Ampas_m');
		$this->load->model('Sayur_m');
		$this->load->model('Harga_m');
		$this->load->model('Keuntungan_m');
	}
	
	public function index(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = date('Y-m');
			$idPegawai = $this->session->userdata('idPegawai');
			$data = $this->forDetail($tgl, $idPegawai);
			$this->load->view('PdfGaji_v',$data);
		}
	}
	
	public function hitungGaji($tgl, $idPegawai){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = $dataku = [];
			$totalGaji = $totalHutang = $gajiBersih = 0;
			
			$pokok = $this->Pegawai_m->detailGaji($idPegawai);
			
			//simpan data pokok ke dataku
			$dataku['idPegawai'] = $pokok[0]['idPegawai'];
			$dataku['namaPegawai'] = $pokok[0]['namaPegawai'];
			$dataku['tipePegawai'] = $pokok[0]['tipePegawai'];
			$dataku['bonusBeras'] = $pokok[0]['bonusBeras'];
			$dataku['bonusMasaKerja'] = $pokok[0]['bonusMasaKerja'];
			
			$totalGaji += $dataku['bonusMasaKerja'];
			
			//pegawai kandang
			//-------------------------------------------------------------------------------------------------------------------
			if($pokok[0]['tipePegawai'] == 'Kandang'){
				//gajipokok & bonus keluarga
				$gp = $this->PegawaiKandang_m->cekId($pokok[0]['idPegawai']);
				if(count($gp)!=0){
					$dataku['gajiPokok'] = $gp[0]['gajiPokok'];
					$dataku['bonusKeluarga'] = $gp[0]['bonusKeluarga'];
					$totalGaji = $totalGaji + $dataku['gajiPokok']  + $dataku['bonusKeluarga'];
				}else{
					$dataku['gajiPokok'] = "0";
					$dataku['bonusKeluarga'] = "0";
				}
				

				//bonus usaha bulan ini

				//cek dikandang mana
				$kand = $this->PegawaiKandang_m->cekId($pokok[0]['idPegawai']);
				//ada berapa pegawai dikandang itu yang dapet bonus usaha
				$jml = $this->PegawaiKandang_m->pegawaidiKandang($kand[0]['idKandang']);
				$usaha = $this->Keuntungan_m->viewByIdkandangTgl($kand[0]['idKandang'],$tgl);
				if(count($usaha)!=0){
					if($kand[0]['bonusUsaha'] == 'ya'){
						$dataku['bonusUsaha'] = intval(($usaha[0]['totalKeuntungan']*0.05)/$jml);
					}else{
						$dataku['bonusUsaha'] = "0";
					}
						
					//kalkulasi totalGaji
					$totalGaji += $dataku['bonusUsaha'];
				}					
				else 
					$dataku['bonusUsaha'] = "0";
				
				
				//hasil pasar
				$hsayur = $this->Harga_m->getByNama('pasar lebih');
				$sayur = $this->Sayur_m->getById($pokok[0]['idPegawai'], $tgl);
				$dataku['hsayur'] = $hsayur[0]['harga'];
				if(count($sayur)!=0){
					$dataku['karungBonus'] = $sayur[0]['totalKarung']-$sayur[0]['karungPokok'];
					$dataku['hasilPasar'] = $dataku['hsayur']  * $dataku['karungBonus'];
				
				//kalkulasi totalGaji
				$totalGaji += $dataku['hasilPasar'];

				}
				else $dataku['hasilPasar'] = $dataku['karungBonus'] = "0";
			//pegawai ampas
			//-------------------------------------------------------------------------------------------------------------------
			}else{
				$ampas = $this->Ampas_m->getById($pokok[0]['idPegawai'], $tgl);
				$hampas = $this->PegawaiAmpas_m->cekId($pokok[0]['idPegawai']);
				$htonase = $this->Harga_m->getByNama('tonase');
				$jpAmpas = $this->Pegawai_m->sumPAmpas();
					
				if(count($ampas)!=0){
					$dataku['tunggal'] = $ampas[0]['tunggal'];
					$dataku['htunggal'] = $hampas[0]['tunggal'];
					$dataku['totalTunggal'] = ($ampas[0]['tunggal']*$hampas[0]['tunggal']);
					
					$dataku['tunggalPlus'] = $ampas[0]['tunggalPlus'];
					$dataku['htunggalPlus'] = $hampas[0]['tunggalPlus'];
					$dataku['totalTunggalPlus'] = ($ampas[0]['tunggalPlus']*$hampas[0]['tunggalPlus']);
					
					$dataku['ganda'] = $ampas[0]['ganda'];
					$dataku['hganda'] = $hampas[0]['ganda'];
					$dataku['totalGanda'] = ($ampas[0]['ganda']*$hampas[0]['ganda']);
					
					$dataku['gandaPlus'] = $ampas[0]['gandaPlus'];
					$dataku['hgandaPlus'] = $hampas[0]['gandaPlus'];
					$dataku['totalGandaPlus'] = ($ampas[0]['gandaPlus']*$hampas[0]['gandaPlus']);
					
					$dataku['tonase'] = $ampas[0]['tonase'];
					$dataku['htonase'] = $htonase[0]['harga'];
					$dataku['totalTonase'] = ($ampas[0]['tonase']*$htonase[0]['harga'])/$jpAmpas;
					
					//kalkulasi totalGaji
					$totalGaji = $totalGaji + $dataku['totalTunggal'] + $dataku['totalTunggalPlus'] + $dataku['totalGanda'] + $dataku['totalGandaPlus'] + $dataku['totalTonase'];
				}else $dataku['tunggal'] = -99;
			}
			
			//bonus lain
			$bonus = $this->Bonus_m->detailBonus($tgl, $pokok[0]['idPegawai']);
			if(count($bonus)!=0){
				for($j=0;$j<count($bonus);$j++)
					$totalGaji += $bonus[$j]['jumlahBonus'];
			}
			
			$hutang = $this->Hutang_m->hutangBulanIni($pokok[0]['idPegawai'], $tgl);
			if(count($hutang)!=0){
				$totalHutang = $hutang[0]['hutang'];
				$gajiBersih = $totalGaji - $hutang[0]['hutang'];	
			}
			//pembulatan
			$gaji = intval(substr($gajiBersih,-4));
			if(($gaji == 0) or ($gaji == 5000)){
				$dataku['gajiBulat'] = $gajiBersih;
			}else if($gaji < 5000){
				$dataku['gajiBulat'] = (intval($gajiBersih/10000))*10000+5000;
			}else if($gaji > 5000){
				$dataku['gajiBulat'] = ((intval($gajiBersih/10000))+1)*10000;
			}else{
				$dataku['gajiBulat'] = $gajiBersih;
			}
			
			$dataku['totalGaji'] = $totalGaji;
			$dataku['gajiBersih'] = $gajiBersih;
			
			if($totalHutang == '')
				$dataku['totalHutang'] = 0;
			else
				$dataku['totalHutang'] = $totalHutang;
			
			return $dataku;
		}
	}
	
	public function gajiSemuaPegawai($tgl){
		$pegawai = $this->Pegawai_m->getAllPegawai();
		$dataku = [];
			
		for($i=0;$i<count($pegawai);$i++){
			$dataku[$i] = $this->hitungGaji($tgl, $pegawai[$i]['idPegawai']);
		}
		return $dataku;
	}
	
	public function viewGaji(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$hasil = $this->gajiSemuaPegawai($tgl);
			$hasil = json_encode($hasil);
			$hasil = json_decode($hasil);
			
			foreach($hasil as $row){
				$status = $this->Gaji_m->searchByTglId($tgl, $row->idPegawai); //cari gaji pegawai pd tanggal tertentu
				if(count($status) == 0){
					$data['status'] = "none";
					$row->gajisaved = 0;
				}else{
					$data['status'] = "ada";
					$row->totalHutang = $status[0]['totalHutang'];
					
					//pembulatan total gaji
					$gaji = intval(substr($row->totalGaji,-4));
					if(($gaji == 0) or ($gaji == 5000)){
						$row->totalGaji = $row->totalGaji;
					}else if($gaji < 5000){
						$row->totalGaji = (intval($row->totalGaji/10000))*10000+5000;
					}else if($gaji > 5000){
						$row->totalGaji = ((intval($row->totalGaji/10000))+1)*10000;
					}else{
						$row->totalGaji = $row->totalGaji;
					}
					
					$row->gajiBersih = $row->totalGaji - $status[0]['totalHutang'];
					$row->gajiBulat = $row->totalGaji - $status[0]['totalHutang'];
					$row->gajisaved = $status[0]['totalGaji'];
				}
			}
			$data['result'] = json_encode($hasil);
			// echo '<pre>';
			// print_r($data['result']);
			// echo '<pre>';

			$this->load->view('Gaji_v',$data);
		}
	}
	
	public function forDetail($tgl, $idPegawai){
			$hasil = $this->hitungGaji($tgl, $idPegawai);//dapetin detail gajinya
			$hasil = json_encode($hasil);
			$hasil = json_decode($hasil);
			
			$status = $this->Gaji_m->searchByTglId($tgl, $idPegawai); //cek apa utangnya udah disimpen?
			if(count($status) != 0){
				$hasil->totalHutang = $status[0]['totalHutang'];
				$hasil->gajiBersih = $hasil->totalGaji - $status[0]['totalHutang'];
				
				
				//pembulatan
				$gaji = intval(substr($hasil->gajiBersih,-4));
				if(($gaji == 0) or ($gaji == 5000)){
					$hasil->gajiBulat = $hasil->gajiBersih;
				}else if($gaji < 5000){
					$hasil->gajiBulat = (intval($hasil->gajiBersih/10000))*10000+5000;
				}else if($gaji > 5000){
					$hasil->gajiBulat = ((intval($hasil->gajiBersih/10000))+1)*10000;
				}else{
					$hasil->gajiBulat = $hasil->gajiBersih;
				}
			}
			
			$data['bonus'] = $this->Bonus_m->detailBonus($tgl, $idPegawai);
			$data['hutang'] = $this->Hutang_m->hutangBulanIni($idPegawai, $tgl);
			$data['result'] = $hasil;
			
			return $data;
	}
	
	public function detailGaji(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$idPegawai = $this->uri->segment(4);
			$data = $this->forDetail($tgl, $idPegawai);
			// echo '<pre>';
			// print_r($data);
			// echo '<pre>';

			$this->load->view('DetailGaji_v',$data);
		}
	}
	
	public function simpanGaji(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$hasil = $this->gajiSemuaPegawai($tgl);
			$hasil = json_encode($hasil);
			$hasil = json_decode($hasil);
			
			foreach($hasil as $row){
				if($row->gajiBulat >= 0){
					//tambah data gaji
					$inp = array('idPegawai'=>$row->idPegawai,
							'tanggalGaji'=>$tgl.'-00',
							'totalHutang'=>$row->totalHutang,
							'totalGaji'=>$row->gajiBulat
							);
					$this->Gaji_m->simpanGaji($inp);
					
					//update data hutang
					$this->Hutang_m->updateHutangFromGaji($row->idPegawai, $tgl);
				}else{
					//tambah data gaji
					$inp = array('idPegawai'=>$row->idPegawai,
							'tanggalGaji'=>$tgl.'-00',
							'totalHutang'=>$row->totalHutang,
							'totalGaji'=>0
							);
					$this->Gaji_m->simpanGaji($inp);
					//update data hutang
					$this->Hutang_m->updateHutangFromGaji($row->idPegawai, $tgl); //lunasin semua hutang
					$this->Hutang_m->insertHutangFromGaji($row->idPegawai, $tgl, ($row->gajiBulat * -1)); //tambah hutang baru kebulan selanjutnya
				}
			}
			redirect('Gaji/viewGaji/'.$tgl,'refresh');
		}
	}
	
	public function resetGaji(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$hasil = $this->Gaji_m->searchByTgl($tgl);
			$t = explode('-', $tgl);
			if($t[1]==12){
				$tanggal = $t[0].'-01-00';
			}else{
				$tanggal = $t[0].'-';
				if(($t[1]+1) < 10){
					$tanggal .= '0'.($t[1]+1).'-00';
				}else{
					$tanggal .= ($t[1]+1).'-00';
				}
			}

			foreach($hasil as $row){
				$HT = $this->Hutang_m->searchHutangByTglId($tgl, $row->idPegawai);
				if(count($HT) != 0){
					foreach($HT as $i){
						$this->Hutang_m->resetHutang($i->tanggalHutang, $row->idPegawai,$row->totalHutang); //reset hutang pegawai ini ke awal
					}
					$HT2 = $this->Hutang_m->searchHutangByTglId($tanggal, $row->idPegawai); //cek ada hutang yang dimasukin ke bulan depan?
					if(count($HT2) != 0)
						$this->Hutang_m->hapusHutang($row->idPegawai, $tanggal);
				}
				$this->Gaji_m->resetGaji($tgl, $row->idPegawai); //hapus data gaji pegawai ini
			}
			redirect('Gaji/viewGaji/'.$tgl,'refresh');
		}
	}
	
	//Bonus
	public function tambahBonus()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$data = array('idPegawai'=>$this->input->post('idPegawai'),
						'bulanBonus'=>$this->input->post('tgl'),
						'ketBonus'=>$this->input->post('ketBonus'),
						'jumlahBonus'=>$this->input->post('jumlahBonus')
						);

			$result = $this->Bonus_m->tambahBonus($data);
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Penambahan data gagal');
			
			redirect('Gaji/detailGaji/'.$this->input->post('tgl').'/'.$this->input->post('idPegawai'),'refresh');
		}
	}
	
	public function hapusBonus()
	{
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$idPegawai = $this->input->post('id');
			$bulanBonus = $this->input->post('bulan');
			$ketBonus = $this->input->post('ket');
			
			$result = $this->Bonus_m->hapusBonus($idPegawai, $bulanBonus, $ketBonus);
			
			if(!$result)
				$this->session->set_flashdata('errMsg','Penghapusan data gagal');
			
			redirect('Gaji/detailGaji/'.$bulanBonus.'/'.$idPegawai,'refresh');
		}
	}
	
	public function cetakDetail(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$idPegawai = $this->uri->segment(4);
			$data = $this->forDetail($tgl, $idPegawai);
			//for pegawai
			$cek = $this->Gaji_m->searchByTgl($tgl);
			if(count($cek)!=0){
				$this->session->set_flashdata('status','available');
			}
			$this->load->view('PdfGaji_v',$data);
		}
	}
	
	public function cetakAll(){
		if($this->session->userdata('username') == ""){
			redirect(site_url());
		}else{
			$tgl = $this->uri->segment(3);
			$pegawai = $this->Pegawai_m->getAllPegawai();
			$dataku = [];
			for($i=0;$i<count($pegawai);$i++){
				$dataku[$i] = $this->forDetail($tgl, $pegawai[$i]['idPegawai']);
			}
			$dataku = json_encode($dataku);
			$data['hasil'] = json_decode($dataku);
			// echo '<pre>';
			// print_r($data['hasil']);
			// echo '<pre>';

			$this->load->view('PdfAll_v',$data);
		}
	}
	
	//end Bonus
}
