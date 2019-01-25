<?php
	$this->load->view('partial/header');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title judul">Data Pengambilan Ampas Tahu</h4></div>
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
            <table id="ampas" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
				  <th>Nama Pegawai</th>
                  <th style="text-align:right">Tunggal</th>
                  <th style="text-align:right">Tunggal Plus</th>
                  <th style="text-align:right">Ganda</th>
                  <th style="text-align:right">Ganda Plus</th>
                  <th style="text-align:right">Tonase</th>
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
							<td style="text-align:right" id="tunggal<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right" id="tunggalPlus<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right" id="ganda<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right" id="gandaPlus<?php echo $p->idPegawai;?>">0</td>
							<td style="text-align:right" id="tonase<?php echo $p->idPegawai;?>">0</td>
							<th>
								<button type="button" data-toggle="modal" data-target="#modal_ampas" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
							</th>
						</tr>
				<?php
						
					}else{
						if($i<count($result) and ($p->idPegawai == $result[$i]['idPegawai'])){
				?>
							<tr>
								<td id="namaPegawai<?php echo $p->idPegawai;?>"><?php echo $p->namaPegawai;?></td>
								<td style="text-align:right" id="tunggal<?php echo $p->idPegawai;?>"><?php echo $result[$i]['tunggal'];?></td>
								<td style="text-align:right" id="tunggalPlus<?php echo $p->idPegawai;?>"><?php echo $result[$i]['tunggalPlus'];?></td>
								<td style="text-align:right" id="ganda<?php echo $p->idPegawai;?>"><?php echo $result[$i]['ganda'];?></td>
								<td style="text-align:right" id="gandaPlus<?php echo $p->idPegawai;?>"><?php echo $result[$i]['gandaPlus'];?></td>
								<td style="text-align:right" id="tonase<?php echo $p->idPegawai;?>"><?php echo $result[$i]['tonase'];?></td>
								<th>
									<button type="button" data-toggle="modal" data-target="#modal_ampas" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
								</th>
							</tr>
				<?php
						$i++;
						}else{
				?>
							<tr>
								<td id="namaPegawai<?php echo $p->idPegawai;?>"><?php echo $p->namaPegawai;?></td>
								<td style="text-align:right" id="tunggal<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right" id="tunggalPlus<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right" id="ganda<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right" id="gandaPlus<?php echo $p->idPegawai;?>">0</td>
								<td style="text-align:right" id="tonase<?php echo $p->idPegawai;?>">0</td>
								<th>
									<button type="button" data-toggle="modal" data-target="#modal_ampas" id="ubah<?php echo $p->idPegawai;?>" class="btn btn-warning ubah">Ubah</button>
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

<div class="modal fade" id="modal_ampas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Pengambilan Ampas</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_ampas" method="POST">
						<input type="hidden" class="form-control" id="idPegawai" name="idPegawai">
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pegawai</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaPegawai" name="namaPegawai" disabled>
                          </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label">Tunggal</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="tunggal" name="tunggal" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tunggal Plus</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="tunggalPlus" name="tunggalPlus" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Ganda</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="ganda" name="ganda" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Ganda Plus</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="gandaPlus" name="gandaPlus" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Tonase</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="tonase" name="tonase" required>
                          </div>
                        </div>
						
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_ampas" id="simpan"> Simpan</button>
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
		window.location = '<?php echo site_url();?>Ampas/lihatAmpas/' + $('#bulanTahun').val();
	});
	
	$('.ubah').click(function() {
		var id = this.id.substr(4);
		$('#idPegawai').val(id);
		$('#namaPegawai').val(document.getElementById('namaPegawai'+id).innerHTML);
		$('#tunggal').val(document.getElementById('tunggal'+id).innerHTML);
		$('#tunggalPlus').val(document.getElementById('tunggalPlus'+id).innerHTML);
		$('#ganda').val(document.getElementById('ganda'+id).innerHTML);
		$('#gandaPlus').val(document.getElementById('gandaPlus'+id).innerHTML);
		$('#tonase').val(document.getElementById('tonase'+id).innerHTML);
		$('#form_ampas').attr('action','<?php echo site_url();?>Ampas/ubahAmpas/<?php echo $this->uri->segment(3);?>');
	});
});

</script>
