<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Data Pengambilan Sayur</h4></div>
		</div>
		<div class="row">
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" id="bulanTahun" placeholder="Pilih bulan dan tahun" autocomplete="off">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-fw lihat">Lihat</button>
			</div>
		</div>
		<?php 
		if(count($pegawai) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
		<div class="table-responsive">
            <table id="sayur" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
				  <th>Nama Pegawai</th>
                  <th style="text-align:right">Total karung</th>
                  <th style="text-align:right">jumlah karung pokok</th>
                  <th style="text-align:right">jumlah karung lebih</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
                foreach($pegawai as $p) {
					if(count($result)==0){
				?>
						<tr>
							<td id="namaPegawai<?php echo $p->idPegawai;?>"><?php echo $p->namaPegawai;?></td>
							<td style="text-align:right" id="totalKarung<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right" id="karungPokok<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right">0</td>
							<th>
								<button type="button" data-toggle="modal" data-target="#modal_sayur" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
							</th>
						</tr>
				<?php
						
					}else{
						if($i<count($result) and ($p->idPegawai == $result[$i]['idPegawai'])){
				?>
							<tr>
								<td id="namaPegawai<?php echo $p->idPegawai;?>"><?php echo $p->namaPegawai;?></td>
								<td style="text-align:right" id="totalKarung<?php echo $p->idPegawai;?>"><?php echo $result[$i]['totalKarung'];?></td>
								<td style="text-align:right" id="karungPokok<?php echo $p->idPegawai;?>"><?php echo $result[$i]['karungPokok'];?></td>
								<td style="text-align:right"><?php echo $result[$i]['totalKarung']-$result[$i]['karungPokok'];?></td>
								<th>
									<button type="button" data-toggle="modal" data-target="#modal_sayur" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
								</th>
							</tr>
				<?php
						$i++;
						}else{
				?>
							<tr>
								<td id="namaPegawai<?php echo $p->idPegawai;?>"><?php echo $p->namaPegawai;?></td>
								<td style="text-align:right" id="totalKarung<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right" id="karungPokok<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right">0</td>
								<th>
									<button type="button" data-toggle="modal" data-target="#modal_sayur" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
								</th>
							</tr>
				<?php	
						}
					}
				}
                ?>
              </tbody>
            </table>
		</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_sayur">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Pengambilan Sayur</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_sayur" method="POST">
						<input type="hidden" class="form-control" id="idPegawai" name="idPegawai">
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" disabled>
                          </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Total Karung</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="totalKarung" name="totalKarung" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Karung Pokok</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="karungPokok" name="karungPokok" required>
                          </div>
                        </div>
						
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_sayur" id="simpan"> Simpan</button>
			</div>
		</div>
	</div>
</div>

<?php
	$this->load->view('partial/footer');
?>

<script type="text/javascript">
$(document).ready(function() {
	var tgl = '<?php echo $this->uri->segment(3);?>';
	if(tgl)
		$('#bulanTahun').attr('placeholder',tgl);
	else
		$('#bulanTahun').attr('placeholder','<?php echo date("Y-m");?>');
	
	var msg = '<?php echo $this->session->flashdata('errMsg');?>';
	if(msg != ''){
		swal({ 
            type: 'error', 
            title: 'Error!',
			icon: 'danger',
            text: msg 
        }); 
	}
	
	$('#bulanTahun').datepicker({
        format: "yyyy-mm",
		viewMode: "months", 
		minViewMode: "months",
        autoclose:true
    });
	
	$('.lihat').click(function() {
		window.location = '<?php echo site_url();?>Sayur/lihatSayur/' + $('#bulanTahun').val();
	});
	
	$('.ubah').click(function() {
		var id = this.id.substr(4);
		$('#idPegawai').val(id);
		$('#namaPegawai').val(document.getElementById('namaPegawai'+id).innerHTML);
		$('#totalKarung').val(document.getElementById('totalKarung'+id).innerHTML);
		$('#karungPokok').val(document.getElementById('karungPokok'+id).innerHTML);
		$('#form_sayur').attr('action','<?php echo site_url();?>Sayur/ubahSayur/<?php echo $this->uri->segment(3);?>');
	});
});

</script>
