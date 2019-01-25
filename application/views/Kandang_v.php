<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Data Kandang</h4></div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_kandang">Tambah kandang</button>
		  </div>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
		<div class="table-responsive">
            <table id="harga" class="table table-bordered table-striped">
              <thead>
                <tr>
				  <th>Nama Kandang</th>
                  <th>Lokasi</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
                foreach ($result as $row) {
                  ?>
                  <tr>
                    <td><?= $row->namaKandang?></td>	
                    <td><?= $row->lokasi?></td>						
                    <!--helper-->
					<input type="hidden" id="idKandang<?php echo $row->idKandang?>" value="<?php echo $row->idKandang;?>">
					<input type="hidden" id="namaKandang<?php echo $row->idKandang?>" value="<?php echo $row->namaKandang;?>">
					<input type="hidden" id="lokasi<?php echo $row->idKandang?>" value="<?php echo $row->lokasi;?>">
					
                    <td>
						<button type="button" data-toggle="modal" data-target="#modal_kandang" id="ubah_<?php echo $row->idKandang;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $row->idKandang;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
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


<div class="modal fade" id="modal_kandang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Kandang</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<form class="forms-sample" id="form_kandang" method="POST">
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
						<input type="hidden" id="idKandang" name="idKandang">
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Kandang</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaKandang" name="namaKandang" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Lokasi</label>
                          <div class="col-sm-9">
                            <textarea class="form-control" id="lokasi" name="lokasi" required></textarea>
                          </div>
                        </div>

                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit"> Simpan</button>
			</div>
			</form>
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
						<p>Apakah anda yakin ingin menghapus kandang ini?</p>	
						<input type="hidden" class="form-control" id="id">
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger mr-2" id="hapus"> Ya</button>
			</div>
		</div>
	</div>
</div>		
<?php
	$this->load->view('partial/footer');
?>

<script type="text/javascript">
    $(document).ready(function() {
		$('#btn_tambah').click(function() {
			$('#lokasi').val('');
			$('#namaKandang').val('');
			
			$('#form_kandang').attr('action','<?php echo site_url();?>Kandang/tambahKandang');
		});
		
		$('.ubah').click(function() {
			var id=this.id.substr(5);
			$('#idKandang').val(id);
			$('#namaKandang').val($('#namaKandang' + id).val());
			$('#lokasi').val($('#lokasi' + id).val());
			
			$('#form_kandang').attr('action','<?php echo site_url();?>Kandang/ubahKandang');
		});
		
		$('.hapus').click(function() {
			var id=this.id.substr(6);
			$('#id').val(id)
		});
		$('#hapus').click(function() {
			var id = $('#id').val();
			window.location = '<?php echo site_url();?>Kandang/hapusKandang/' + id;
		});
});
</script>
