<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Data Pegawai Ampas</h4></div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_pegawai">Tambah Pegawai</button>
		  </div>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
            <table id="pegawai" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
				  <th>No.</th>
                  <th>Nama Pegawai</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Tahun Masuk</th>
                  <th>Telepon</th>
				  <th style="text-align:right">Bonus Beras</th>
				  <th style="text-align:right">Bonus Masa Kerja</th>
				  <th style="text-align:right">Tunggal</th>
				  <th style="text-align:right">Tunggal Plus</th>
				  <th style="text-align:right">Ganda</th>
				  <th style="text-align:right">Ganda Plus</th>
				  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
                foreach ($result as $row) {
                  ?>
                  <tr>
					<td><?= $i+=1;?></td>
                    <td><?= ucwords($row->namaPegawai)?></td>
					<td><?= $row->username?></td>
					<td><?= $row->password?></td>
                    <td><?= substr($row->tahunMasuk, 0, 4)?></td>						
                    <td><?= $row->telepon?></td>					
					<td><?= $row->bonusBeras, ' Liter'?></td>						
					<td><?= 'Rp. ', number_format($row->bonusMasaKerja, 0, ".", ".")?></td>						
					<td><?= 'Rp. ', number_format($row->PegawaiAmpas_m->tunggal, 0, ".", ".")?></td>						
					<td><?= 'Rp. ', number_format($row->PegawaiAmpas_m->tunggalPlus, 0, ".", ".")?></td>						
					<td><?= 'Rp. ', number_format($row->PegawaiAmpas_m->ganda, 0, ".", ".")?></td>						
					<td><?= 'Rp. ', number_format($row->PegawaiAmpas_m->gandaPlus, 0, ".", ".")?></td>
					
						<input type="hidden" id="username<?php echo $row->idPegawai;?>" value="<?php echo $row->username;?>">
						<input type="hidden" id="password<?php echo $row->idPegawai;?>" value="<?php echo $row->password;?>">
						<input type="hidden" id="namaPegawai<?php echo $row->idPegawai;?>" value="<?php echo $row->namaPegawai;?>">
						<input type="hidden" id="tahunMasuk<?php echo $row->idPegawai;?>" value="<?php echo substr($row->tahunMasuk, 0, 4);?>">
						<input type="hidden" id="telepon<?php echo $row->idPegawai;?>" value="<?php echo $row->telepon;?>">
						<input type="hidden" id="gajiPokok<?php echo $row->idPegawai;?>" value="<?php echo $row->gajiPokok;?>">
						<input type="hidden" id="bonusKeluarga<?php echo $row->idPegawai;?>" value="<?php echo $row->bonusKeluarga;?>">
						<input type="hidden" id="bonusBeras<?php echo $row->idPegawai;?>" value="<?php echo $row->bonusBeras;?>">
						<input type="hidden" id="bonusMasaKerja<?php echo $row->idPegawai;?>" value="<?php echo $row->bonusMasaKerja;?>">
						<input type="hidden" id="tunggal<?php echo $row->idPegawai;?>" value="<?php echo $row->PegawaiAmpas_m->tunggal;?>">
						<input type="hidden" id="tunggalPlus<?php echo $row->idPegawai;?>" value="<?php echo $row->PegawaiAmpas_m->tunggalPlus;?>">
						<input type="hidden" id="ganda<?php echo $row->idPegawai;?>" value="<?php echo $row->PegawaiAmpas_m->ganda;?>">
						<input type="hidden" id="gandaPlus<?php echo $row->idPegawai;?>" value="<?php echo $row->PegawaiAmpas_m->gandaPlus;?>">
                    <td>
						<button type="button" data-toggle="modal" data-target="#modal_pegawai" id="ubah_<?php echo $row->idPegawai;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $row->idPegawai;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
					</td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
			<?php
			}
			?>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_pegawai">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Pegawai</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_pegawai" method="POST">
						
						<input type="hidden" class="form-control" id="idPegawai" name="idPegawai">
						<div class="form-group row username"><label class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" name="username" required>
                          </div>
                        </div>
						<div class="form-group row password"><label class="col-sm-3 col-form-label">Password</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tahun Masuk</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="tahunMasuk" name="tahunMasuk">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Telepon</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="telepon" name="telepon">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Bonus Beras</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="bonusBeras" name="bonusBeras" style="text-align:right">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Bonus Masa Kerja</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="bonusMasaKerja" name="bonusMasaKerja" style="text-align:right">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tunggal</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tunggal" name="tunggal" style="text-align:right">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tunggal Plus</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tunggalPlus" name="tunggalPlus" style="text-align:right">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Ganda</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="ganda" name="ganda" style="text-align:right">
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Ganda Plus</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="gandaPlus" name="gandaPlus" style="text-align:right">
                          </div>
                        </div>
						<input type="hidden" class="form-control" id="tipePegawai" name="tipePegawai" value="Ampas">
                        
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_pegawai" id="simpan"> Simpan</button>
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
						<p>Apakah anda yakin ingin menghapus data pegawai dengan nama <b id="nama"></b></p>	
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger mr-2" id="hapus"> Ya</button>
				<button class="btn btn-primary mr-2" data-dismiss="modal"> Batal</button>
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
			}) 
		}
		
		$('#btn_tambah').click(function() {
			$('.username').show();
			
			$('#namaPegawai').val('');
			$('#tahunMasuk').val('');
			$('#telepon').val('');
			$('#gajiPokok').val('');
			$('#bonusKeluarga').val('');
			$('#bonusBeras').val('');
			$('#bonusMasaKerja').val('');
			$('#tunggal').val('');
			$('#tunggalPlus').val('');
			$('#ganda').val('');
			$('#gandaPlus').val('');
			
			$('#form_pegawai').attr('action','<?php echo site_url();?>Pegawai/tambahPegawai/<?php echo $this->uri->segment(2);?>');
		});
		
		$('#pegawai').on('click','.ubah',function() {
			$('.username').hide();
			
			var id=this.id.substr(5);
		
			$('#idPegawai').val(id);
			$('#username').val($('#username' + id).val());
			$('#password').val($('#password' + id).val());
			$('#namaPegawai').val($('#namaPegawai' + id).val());
			$('#tahunMasuk').val($('#tahunMasuk' + id).val());
			$('#telepon').val($('#telepon' + id).val());
			$('#gajiPokok').val($('#gajiPokok' + id).val());
			$('#bonusKeluarga').val($('#bonusKeluarga' + id).val());
			$('#bonusBeras').val($('#bonusBeras' + id).val());
			$('#bonusMasaKerja').val($('#bonusMasaKerja' + id).val());
			$('#tunggal').val($('#tunggal' + id).val());
			$('#tunggalPlus').val($('#tunggalPlus' + id).val());
			$('#ganda').val($('#ganda' + id).val());
			$('#gandaPlus').val($('#gandaPlus' + id).val());
			
			$('#form_pegawai').attr('action','<?php echo site_url();?>Pegawai/ubahPegawai/<?php echo $this->uri->segment(2);?>');
		});	
		
		$('#pegawai').on('click','.hapus',function() {
			var id=this.id.substr(6);
			$('#idPegawai').val(id);
			document.getElementById("nama").innerHTML = $('#namaPegawai'+id).val();
		});
		
		$('#hapus').click(function() {
			window.location = '<?php echo site_url();?>Pegawai/hapusPegawai/' + $('#idPegawai').val() + '/<?php echo $this->uri->segment(2);?>';
		});
		
		var tunggal = document.getElementById('tunggal');
		tunggal.addEventListener('keyup', function(e){
			tunggal.value = formatRupiah(this.value);
		});
		
		var tunggalPlus = document.getElementById('tunggalPlus');
		tunggalPlus.addEventListener('keyup', function(e){
			tunggalPlus.value = formatRupiah(this.value);
		});
		
		var ganda = document.getElementById('ganda');
		ganda.addEventListener('keyup', function(e){
			ganda.value = formatRupiah(this.value);
		});
		
		var gandaPlus = document.getElementById('gandaPlus');
		gandaPlus.addEventListener('keyup', function(e){
			gandaPlus.value = formatRupiah(this.value);
		});
		
		var bonusMasaKerja = document.getElementById('bonusMasaKerja');
		bonusMasaKerja.addEventListener('keyup', function(e){
			bonusMasaKerja.value = formatRupiah(this.value);
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
		}
		
		$('#pegawai').DataTable({
			scrollX: true,
			fixedColumns: {
				leftColumns: 2,
				rightColumns: 1
			}
		});
});
</script>
