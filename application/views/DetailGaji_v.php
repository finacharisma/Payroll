<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
			<div class="row" style="margin-bottom:20px">
			  <div class="col-auto mr-auto"><h4 class="card-title">Detail Gaji Pegawai</h4></div>
			  <div class="col-auto"><button type="button" class="btn pull-right btn-primary btn-fw" id="kembali">Kembali</button></div>
			  <div class="col-auto"><button type="button" class="btn pull-right btn-primary btn-fw" id="cetak"><i class="mdi mdi-printer"></i>Cetak</button></div>
			</div>
			
			<?php 
			if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
			else{
			?>
				<div class="row">
					<div class="col-md-2"><p class="mb-2">Nama Pegawai</p></div>
					<div class="col-md-9"><p class="mb-2">: <?php echo $result->namaPegawai;?></p></div>
					<div class="col-md-2"><p class="mb-2">Bonus Beras</p></div>
					<div class="col-md-9"><p class="mb-2">: <?php echo $result->bonusBeras.' Liter';?></p></div>
					<?php if($result->bonusMasaKerja != 0){?>
						<div class="col-md-2"><p class="mb-2">Bonus Masa Kerja</p></div>
						<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->bonusMasaKerja, 0, ".", ".");?></p></div>
					<?php } ?>
				
				<?php
					if($result->tipePegawai == "Kandang"){
				?>						
						<div class="col-md-2"><p class="mb-2">Gaji Pokok</p></div>
						<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->gajiPokok, 0, ".", ".");?></p></div>
						
						<?php if($result->bonusKeluarga != 0){?>
						<div class="col-md-2"><p class="mb-2">Bonus Keluarga</p></div>
						<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->bonusKeluarga, 0, ".", ".");?></p></div>
						<?php } ?>
						
						<?php if($result->bonusUsaha != 0){?>
						<div class="col-md-2"><p class="mb-2">Bonus Usaha</p></div>
						<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->bonusUsaha, 0, ".", ".");?></p></div>
						<?php } ?>
						
						<?php if($result->hasilPasar != 0){?>
						<div class="col-md-2"><p class="mb-2">Hasil Pasar</p></div>
						<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->hasilPasar, 0, ".", ".");?></p></div>
						<div class="col-md-7"><p class="mb-2"><?php echo $result->karungBonus?> X <?php echo 'Rp. ', number_format($result->hsayur, 0, ".", ".");?></p></div>
						<?php } ?>
				<?php
					}else{
						if($result->tunggal != -99){
				?>
							<div class="col-md-2"><p class="mb-2">Tunggal</p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalTunggal, 0, ".", ".");?></p></div>
							<div class="col-md-7"><p class="mb-2"><?php echo $result->tunggal?> X <?php echo 'Rp. ', number_format($result->htunggal, 0, ".", ".");?></p></div>
							<div class="col-md-2"><p class="mb-2">Tunggal Plus</p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalTunggalPlus, 0, ".", ".");?></p></div>
							<div class="col-md-7"><p class="mb-2"><?php echo $result->tunggalPlus?> X <?php echo 'Rp. ', number_format($result->htunggalPlus, 0, ".", ".");?></p></div>
							<div class="col-md-2"><p class="mb-2">Ganda</p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalGanda, 0, ".", ".");?></p></div>
							<div class="col-md-7"><p class="mb-2"><?php echo $result->ganda?> X <?php echo 'Rp. ', number_format($result->hganda, 0, ".", ".");?></p></div>
							<div class="col-md-2"><p class="mb-2">Ganda Plus</p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalGandaPlus, 0, ".", ".");?></p></div>
							<div class="col-md-7"><p class="mb-2"><?php echo $result->gandaPlus?> X <?php echo 'Rp. ', number_format($result->hgandaPlus, 0, ".", ".");?></p></div>
							<div class="col-md-2"><p class="mb-2">Tonase</p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalTonase, 0, ".", ".");?></p></div>
							<div class="col-md-7"><p class="mb-2"><?php echo $result->tonase?> X <?php echo 'Rp. ', number_format($result->htonase, 0, ".", ".");?></p></div>
				<?php
						}else{
							echo '<div class="col-md-2"><p class="mb-2">Tunggal</p></div><div class="col-md-9"><p class="mb-2">: Rp. 0</p></div>';
							echo '<div class="col-md-2"><p class="mb-2">Tunggal Plus</p></div><div class="col-md-9"><p class="mb-2">: Rp. 0</p></div>';
							echo '<div class="col-md-2"><p class="mb-2">Ganda</p></div><div class="col-md-9"><p class="mb-2">: Rp. 0</p></div>';
							echo '<div class="col-md-2"><p class="mb-2">Ganda Plus</p></div><div class="col-md-9"><p class="mb-2">: Rp. 0</p></div>';
							echo '<div class="col-md-2"><p class="mb-2">Tonase</p></div><div class="col-md-9"><p class="mb-2">: Rp. 0</p></div>';
						}
					}
				?>
				</div>
				<hr />
				
				<div class="row">
					<div class="col-md-6"><p class="font-weight-bold">Lain-lain</p></div>
					<div class="col-md-6">
						<button data-toggle="modal" data-target="#modal_bonus" class="gtambah">
							<i class="mdi mdi-plus"></i>
						</button>
					</div>
					<?php
						$i=0;
						foreach($bonus as $gbonus){
							$i++;
					?>
							<div class="col-md-2"><p class="mb-2" id="ketBonus<?php echo $i;?>"><?php echo $gbonus->ketBonus;?></p></div>
							<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($gbonus->jumlahBonus, 0, ".", ".");?></p></div>
							<div class="col-md-2"><p class="mb-2"><?php echo $gbonus->bulanBonus;?></p></div>
							<div class="col-md-6">
								<button data-toggle="modal" data-target="#modal_konfirm" class="ghapus" id="<?php echo $i;?>">
								  <i class="mdi mdi-delete"></i>
								</button>
							</div>
					<?php
						} 
					?>
				</div>
				<hr/>
				
				<div class="row">
					<div class="col-md-2"><p class="font-weight-bold">Total</p></div>
					<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalGaji, 0, ".", ".");?></div>
					<div class="col-md-2"><p class="font-weight-bold">Hutang</p></div>
					<div class="col-md-9"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->totalHutang, 0, ".", ".");?></div>
				</div>
				<hr />
				<div class="row">
					<div class="col-md-2"><p class="font-weight-bold">Gaji Bersih</p></div>
					<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->gajiBersih, 0, ".", ".");?></div>
				</div>
				<div class="row">
					<div class="col-md-2"><p class="font-weight-bold">Gaji Akhir</p></div>
					<div class="col-md-2"><p class="mb-2">: <?php echo 'Rp. ', number_format($result->gajiBulat, 0, ".", ".");?></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!--default-->
</div>
</div>


<div class="modal fade" id="modal_bonus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Bonus Lainnya</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_bonus" method="POST">
						<div class="form-group row"><label class="col-sm-3 col-form-label">Keterangan Bonus</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="ketBonus" name="ketBonus" required>
                          </div>
                        </div>
						<div class="form-group row hi2"><label class="col-sm-3 col-form-label">Jumlah Bonus</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="jumlahBonus" name="jumlahBonus" style="text-align:right" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tanggal</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tanggal" name="tanggal" autocomplete="off">
                          </div>
                        </div>
						<input type="hidden" class="form-control" id="tgl" name="tgl" value="<?php echo $this->uri->segment(3);?>">
						<input type="hidden" class="form-control" id="idPegawai" name="idPegawai" value="<?php echo $this->uri->segment(4);?>">
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_bonus" id="simpan"> Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_konfirm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Konfirmasi</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
						<p>Apakah anda yakin ingin menghapus bonus ini?</p>
						<form id="form_konfirm" method="POST">
							<input type="hidden" class="form-control" id="ket" name="ket">
							<input type="hidden" class="form-control" id="bulan" name="bulan" value="<?php echo $this->uri->segment(3);?>">
							<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $this->uri->segment(4);?>">
						</form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger mr-2" type="submit" form="form_konfirm" id="hapus"> Ya</button>
			</div>
		</div>
	</div>
</div>	
	
<?php
	$this->load->view('partial/footer');
?>

<script type="text/javascript">
$(document).ready(function() {
	var msg = '<?php echo $this->session->flashdata('errMsg');?>';
	if(msg != ''){
		swal({ 
            type: 'error', 
            title: 'Error!',
			icon: 'danger',
            text: msg 
        }); 
	}
	
	var tgl = $('#tgl').val();
	var tahun = tgl.substr(0,4);
	var bulan = (tgl.substr(5,2))-1;
	var date = new Date();
	var firstDay = new Date(tahun,bulan, 1);
	var lastDay = new Date(tahun,bulan+1, 0);
	
	$('#tanggal').datepicker({
		format: "yyyy-mm-dd",
        startDate: firstDay,
		endDate: lastDay,
        autoclose:true
    });
	
	$('#kembali').click(function() {
		window.location = '<?php echo site_url();?>Gaji/viewGaji/<?php echo $this->uri->segment(3)?>';
	});
	
	$('.gtambah').click(function() {
		$('#form_bonus').attr('action','<?php echo site_url();?>Gaji/tambahBonus');
	});
	
	$('.ghapus').click(function() {	
		var id=this.id;
		$('#ket').val(document.getElementById('ketBonus'+id).innerHTML);
		$('#form_konfirm').attr('action','<?php echo site_url();?>Gaji/hapusBonus');
	});
	
	$('#cetak').click(function() {
		window.location = '<?php echo site_url();?>Gaji/cetakDetail/<?php echo $this->uri->segment(3);?>/<?php echo $this->uri->segment(4);?>';
	});
	
	/*var jumlahBonus = document.getElementById('jumlahBonus');
	jumlahBonus.addEventListener('keyup', function(e){
		jumlahBonus.value = formatRupiah(this.value);
	});
		
		function formatRupiah(angka){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		}*/
});

</script>
