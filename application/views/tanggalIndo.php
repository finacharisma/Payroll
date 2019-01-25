<?php
	function konversi($tgl){
		$bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		
		$tanggal = explode('-', $tgl);
		$hsl = "";
		
		for($i=(count($tanggal)-1);$i>=0;$i--){
			if($i == 1)
				$hsl .= " ".$bulan[intval($tanggal[$i])];
			else
				$hsl .= " ".$tanggal[$i];
		}
		
		return $hsl;
	}
?>