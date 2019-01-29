<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Ketentuan Harga</h4></div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_harga">Tambah Harga</button>
		  </div>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
		<div class="table-responsive">
            <table id="harga" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
				  <th>No.</th>
                  <th>Nama Item</th>
                  <th>Tipe Item</th>
                  <th style="text-align:right">Harga per item</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
                foreach ($result as $row) {
                  ?>
                  <tr>
					<td style="text-align:right"><?= $i+=1;?></td>
                    <td id="namanya<?php echo $i;?>"><?= $row->namaItem?></td>
                    <td id="namanya<?php echo $i;?>"><?= $row->tipe?></td>
                    <td style="text-align:right"><?= 'Rp. '.number_format($row->harga, 0, ".", ".")?></td>						
                    <!--helper-->
					<input type="hidden" id="namaItem<?php echo $i?>" value="<?php echo $row->namaItem;?>">
					<input type="hidden" id="hargaItem<?php echo $i?>" value="<?php echo $row->harga;?>">
					<input type="hidden" id="tipe<?php echo $i?>" value="<?php echo $row->tipe;?>">
					
                    <td style="text-align:center">
						<button type="button" data-toggle="modal" data-target="#modal_harga" id="ubah_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<?php if($row->tipe != "sistem"){?>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
						<?php } ?>
					</td>
                  </tr>
                  <?php } ?>
              </tbody>
            </table>
		</div>
			<?php
			}
			?>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_harga">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Ketentuan Harga</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_harga" method="POST">
						
						<div class="form-group row nama"><label class="col-sm-3 col-form-label">Nama Item</label>
                          <div class="col-sm-9">
							<input type="hidden" class="form-control" id="nama" name="nama">
                            <input type="text" class="form-control" id="namaItem" name="namaItem" required>
                          </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Harga per item</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="hargaItem" name="hargaItem" style="text-align:right" required>
                          </div>
                        </div>
						<div class="form-group row tipe"><label class="col-sm-3 col-form-label">Tipe</label>
                          <div class="col-sm-9">
							<select class="form-control" id="tipe" name="tipe">
								<option value=""></option>
								<option value="pemasukan">Pemasukan</option>
								<option value="pengeluaran">Pengeluaran</option>
							</select>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_harga" id="simpan"> Simpan</button>
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
						<p>Apakah anda yakin ingin menghapus data harga <b id="hapusnama"></b>?</p>	
						<input type="hidden" class="form-control" id="id">
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
		
		$('#harga').DataTable({
		});
		
		$('#btn_tambah').click(function() {
			$('.tipe').show();
			document.getElementById("namaItem").disabled = false;
			document.getElementById('tipe').required = true;
			
			$('#namaItem').val('');
			$('#hargaItem').val('');
			$('#tipe').val('');
			
			$('#form_harga').attr('action','<?php echo site_url();?>Harga/tambahHarga');
		});
		
		$('#harga').on('click','.ubah',function() {
			var id=this.id.substr(5);
			
			document.getElementById("namaItem").disabled = true;
			$('#namaItem').val($('#namaItem' + id).val());
			$('#nama').val($('#namaItem' + id).val());
			$('#hargaItem').val($('#hargaItem' + id).val());
			
			if($('#tipe' + id).val() == 'sistem'){
				$('.tipe').hide();
				document.getElementById('tipe').required = false;
			}else{
				$('.tipe').show();
				$('#tipe').val($('#tipe' + id).val());
				document.getElementById('tipe').required = true;
			}
			
			$('#form_harga').attr('action','<?php echo site_url();?>Harga/ubahHarga');
		});
		
		$('#harga').on('click','.hapus',function() {
			var id=this.id.substr(6);
			$('#id').val(id);
			document.getElementById("hapusnama").innerHTML = $('#namaItem' + id).val();
		});
		
		$('#hapus').click(function() {
			var id = $('#id').val();
			var str = $('#namaItem' + id).val();
			
			var i = 0, strLength = str.length;
			for(i; i < strLength; i++) {
				str = str.replace(" ", "_");
			}
			
			window.location = '<?php echo site_url();?>Harga/hapusHarga/' + str +'/'+ $('#hargaItem'+id).val();
		});
		
		var hargaItem = document.getElementById('hargaItem');
		hargaItem.addEventListener('keyup', function(e){
			hargaItem.value = formatRupiah(this.value);
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
});
</script>
