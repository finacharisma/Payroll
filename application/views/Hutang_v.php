<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Data Hutang</h4></div>
		  <?php if($this->uri->segment(2) == 'belumLunas'){?>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_hutang">Tambah Hutang</button>
		  </div>
		  <?php } ?>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
            <table id="hutang" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
				  <th>No.</th>
                  <th>Tanggal Hutang</th>
                  <th>Nama Pegawai</th>
                  <th>Telepon</th>
                  <th style="text-align:right">Jumlah Hutang</th>
                  
				  <?php if($this->uri->segment(2) == 'belumLunas'){?>
					<th style="text-align:right">Sisa Hutang</th>
					<th></th>
				  <?php }else{ ?>
					<th style="text-align:right">Tanggal Lunas</th>
				  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
                foreach ($result as $row) {
                  ?>
                  <tr>
					<td><?= $i+=1;?></td>
					<td><?=$row->tanggalHutang?></td>
                    <td><?= $row->Pegawai_m->namaPegawai?></td>						
                    <td><?= $row->Pegawai_m->telepon?></td>					
                    <td style="text-align:right"><?= 'Rp. ', number_format($row->jumlahHutang, 0, ".", ".")?></td>					
					<?php if($this->uri->segment(2) == 'belumLunas'){?>
						<td style="text-align:right"><?= 'Rp. ', number_format($row->sisaHutang, 0, ".", ".")?></td>	
					<?php }else{ ?>
						<!--<td><?= date('d/m/Y', strtotime($row->tanggalLunas))?></td>-->
						<td><?= $row->tanggalLunas?></td>
					<?php } ?>
					
					<input type="hidden" id="tanggalHutang<?php echo $row->tanggalHutang,$row->idPegawai?>" value="<?php echo $row->tanggalHutang;?>">
					<input type="hidden" id="namaPegawai<?php echo $row->tanggalHutang,$row->idPegawai?>" value="<?php echo $row->Pegawai_m->namaPegawai;?>">
					<input type="hidden" id="telepon<?php echo $row->tanggalHutang,$row->idPegawai?>" value="<?php echo $row->Pegawai_m->telepon;?>">
					<input type="hidden" id="jumlahHutang<?php echo $row->tanggalHutang,$row->idPegawai?>" value="<?php echo $row->jumlahHutang;?>">
					<input type="hidden" id="sisaHutang<?php echo $row->tanggalHutang,$row->idPegawai?>" value="<?php echo $row->sisaHutang;?>">
					
					<?php if($this->uri->segment(2) == 'belumLunas'){?>
                    <td>
						<button type="button" data-toggle="modal" data-target="#modal_hutang" id="ubah_<?php echo $row->tanggalHutang,$row->idPegawai;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $row->tanggalHutang,$row->idPegawai;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
					</td>
					<?php } ?>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
			<?php
			}
			?>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_hutang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Hutang</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_hutang" method="POST">
						
						<div class="form-group row namaPegawai"><label class="col-sm-3 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-9">
							<select class="form-control" id="idPegawai" name="idPegawai">
								<?php foreach ($pegawai as $num){ ?>
								<option value="<?php echo $num->idPegawai; ?>"><?php echo $num->namaPegawai; ?></option>
								<?php } ?>
							</select>
                          </div>
                        </div>
						<div class="form-group row nama"><label class="col-sm-3 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama">
                          </div>
                        </div>
						<div class="form-group row tanggalHutang"><label class="col-sm-3 col-form-label">Tanggal Berhutang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tanggalHutang" name="tanggalHutang" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Hutang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahHutang" name="jumlahHutang" style="text-align:right" required>
                          </div>
                        </div>
						<div class="form-group row sisaHutang"><label class="col-sm-3 col-form-label">Sisa Hutang</label>
                          <div class="col-sm-9">
							<input type="hidden" class="form-control" id="sisaHutang" name="sisaHutang">
                            <input type="text" class="form-control" id="sisa" name="sisa" style="text-align:right" disabled>
                          </div>
                        </div>
						<div class="form-group row jumlahBayar"><label class="col-sm-3 col-form-label">Jumlah yang dibayar</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahBayar" name="jumlahBayar" style="text-align:right" required>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_hutang" id="simpan"> Simpan</button>
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
						<p>Apakah anda yakin ingin menghapus data hutang <b id="hapusnama"></b>?</p>	
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
		
		$('#tanggalHutang').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true
        });
		
		$('#btn_tambah').click(function() {
			$('.namaPegawai').show();
			$('.tanggalHutang').show();
			$('.nama').hide();
			$('.sisaHutang').hide();
			$('.jumlahBayar').hide();
			
			document.getElementById("jumlahHutang").disabled = false;
			
			$('#namaPegawai').val('');
			$('#tanggalHutang').val('');
			$('#jumlahHutang').val('');
			$('#jumlahBayar').val('0');
			
			$('#form_hutang').attr('action','<?php echo site_url();?>Hutang/tambahHutang');
		});
		
		$('#hutang').on('click','.ubah',function() {
			$('.namaPegawai').hide();
			$('.tanggalHutang').hide();
			$('.nama').show();
			$('.sisaHutang').show();
			$('.jumlahBayar').show();
			
			document.getElementById("nama").disabled = true;
			document.getElementById("jumlahHutang").disabled = true;
			
			var id=this.id.substr(15);
			var tgl=this.id.substr(5,10);
		
			$('#idPegawai').val(id);
			$('#tanggalHutang').val(tgl);
			$('#nama').val($('#namaPegawai' + tgl + id).val());
			$('#jumlahHutang').val($('#jumlahHutang' + tgl + id).val());
			$('#sisaHutang').val($('#sisaHutang' + tgl + id).val());
			$('#sisa').val($('#sisaHutang' + tgl + id).val());
			
			$('#form_hutang').attr('action','<?php echo site_url();?>Hutang/ubahHutang');
		});	
		
		$('#hutang').on('click','.hapus',function() {
			var id=this.id.substr(16);
			var tgl=this.id.substr(6,10);
			$('#idPegawai').val(id);
			$('#tanggalHutang').val(tgl);
			document.getElementById("hapusnama").innerHTML = $('#namaPegawai' + tgl + id).val();
		});
		
		$('#hapus').click(function() {
			window.location = '<?php echo site_url();?>Hutang/hapusHutang/' + $('#idPegawai').val()+'/'+ $('#tanggalHutang').val();
		});
		
		var jumlahHutang = document.getElementById('jumlahHutang');
		jumlahHutang.addEventListener('keyup', function(e){
			jumlahHutang.value = formatRupiah(this.value);
		});
		
		var jumlahBayar = document.getElementById('jumlahBayar');
		jumlahBayar.addEventListener('keyup', function(e){
			jumlahBayar.value = formatRupiah(this.value);
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
		
		$('#hutang').DataTable({
		});
});
</script>
