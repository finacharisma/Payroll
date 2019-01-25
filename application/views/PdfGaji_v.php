<?php
	include_once('tanggalIndo.php');

    $pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Gaji Pegawai');
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
	$pdf->SetFont('times', '', 12);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);

if(($this->session->userdata('username')!='?') or ($this->session->userdata('status')=='available')){	
	if($this->session->userdata('idPegawai') != ''){
		$bulan = strtoupper(konversi(date('Y-m')));
	}else{
		$bulan = strtoupper(konversi($this->uri->segment(3)));
	}
	
	$isi = '<h2 align="center">SLIP GAJI</h2>
			<table>
				<tr>
					<td style="width: 120px">Bulan</td>
					<td style="width: 10px">:</td>
					<td>'.$bulan.'</td>
				</tr>
				<tr>
					<td style="width: 120px">Nama Pegawai</td>
					<td style="width: 10px">:</td>
					<td> '.strtoupper($result->namaPegawai).'</td>
				</tr>
			</table><br /><br />';
	$isi .= '
			<table border="0" cellpadding="3">
				<tr>
					<th><b>KETERANGAN</b></th>
					<th><b>JUMLAH</b></th>
				</tr>
				<tr>
					<td>Bonus Beras</td>
					<td>'.$result->bonusBeras.' Liter</td>
				</tr>';
	if($result->bonusMasaKerja != 0){
	$isi .= '<tr>
				<td>Bonus Masa Kerja</td>
				<td align="right">Rp. '.number_format($result->bonusMasaKerja, 0, ".", ".").'</td>
			</tr>';
	}
	
	if($result->tipePegawai == "Kandang"){
		$isi .= '<tr>
					<td>Gaji Pokok</td>
					<td align="right">Rp. '.number_format($result->gajiPokok, 0, ".", ".").'</td>
				</tr>';
		if($result->bonusKeluarga != 0){
		$isi .=	'<tr>
					<td>Bonus Keluarga</td>
					<td align="right">Rp. '.number_format($result->bonusKeluarga, 0, ".", ".").'</td>
				</tr>';
		}
		if($result->bonusUsaha != 0){
		$isi .= '<tr>
					<td>Bonus Usaha</td>
					<td align="right">Rp. '.number_format($result->bonusUsaha, 0, ".", ".").'</td>
				</tr>';
		}
		if($result->hasilPasar != 0){
		$isi .= '<tr>
					<td>Hasil Pasar</td>
					<td align="right">Rp. '.number_format($result->hasilPasar, 0, ".", ".").'</td>
				</tr>';
		}
	}else if($result->tipePegawai == "Ampas"){
		$a = [];
		$b = ["Tunggal", "Tunggal Plus", "Ganda", "Ganda Plus", "Tonase"];
		if($result->tunggal == -99){
			$a = [0,0,0,0,0];
		}else{
			$a = [$result->totalTunggal, $result->totalTunggalPlus, $result->totalGanda, $result->totalGandaPlus,$result->totalTonase];
		}
		for($i=0;$i<4;$i++){
			$isi .= '<tr>
					<td>'.$b[$i].'</td>
					<td  align="right">Rp. '.number_format($a[$i], 0, ".", ".").'</td>
				</tr>';
		}
	}
	
	foreach($bonus as $row){
		$isi .= '<tr>
					<td>'.ucwords($row->ketBonus).'</td>
					<td align="right">Rp. '.number_format($row->jumlahBonus, 0, ".", ".").'</td>
				</tr>
				';
	}
	$isi .= '<tr>
				<td></td><td><hr /></td>
			</tr>
			<tr>
				<td>Total Gaji</td>
				<td align="right">Rp. '.number_format($result->totalGaji, 0, ".", ".").'</td>
			</tr>
			<tr>
				<td>Total Hutang</td>
				<td align="right">Rp. '.number_format($result->totalHutang, 0, ".", ".").'</td>
			</tr>
			<tr>
				<td></td><td><hr /></td>
			</tr>
			<tr>
				<td>Gaji Bersih</td>
				<td align="right">Rp. '.number_format($result->gajiBersih, 0, ".", ".").'</td>
			</tr>
			<tr>
				<td>Gaji Akhir</td>
				<td align="right">Rp. '.number_format($result->gajiBulat, 0, ".", ".").'</td>
			</tr>';
	
	$isi .= '</table>';
}else{
	$isi = '<p align="center">Gaji Belum Tersedia</p>';
}
	$pdf->AddPage('P', 'A4');
	$pdf->writeHTML($isi, true, false, true, false, '');
    $pdf->Output('gaji.pdf', 'I');

?>