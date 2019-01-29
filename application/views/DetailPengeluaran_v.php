<?php
	$this->load->view('partial/header');
	include_once('tanggalIndo.php');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Detail Pengeluaran</h4></div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="ringkasan">Ringkasan</button>
		  </div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_pengeluaran">Tambah Pengeluaran</button>
		  </div>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
		?>
		<div class="row">
		  <div class="col-md-2"><p class="font-weight-bold">Nama Kandang</p></div>
		  <div class="col-md-9"><p class="mb-2">: <?php echo $result->namaKandang;?></p></div>
		  <div class="col-md-2"><p class="font-weight-bold">Pegawai</p></div>
		  <div class="col-md-9"><p class="mb-2 text-capitalize">: <?php echo $result->namaPegawai;?></p></div>
		  <div class="col-md-2"><p class="font-weight-bold">Bulan/Tahun</p></div>
		  <div class="col-md-9"><p class="mb-2">: <?php echo konversi($this->uri->segment(3));?></p></div>
		</div>
		<div class="table-responsive">
            <table id="pengeluaran" class="table table-striped nowrap">
              <thead>
                <tr>
				  <th>Pengeluaran</th>
				  <th>Tanggal Pengeluaran</th>
                  <th style="text-align:right">Jumlah Pengeluaran</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
				<?php 
				$rutin = $nonrutin = 0;
				foreach ($result->gajiPegawai as $a) {
				?>
				<tr>
				  <td>Gaji <?php echo $a->nama;?></td>
				  <td><?php echo '01/'.date('m/Y', strtotime($this->uri->segment(3)))?></td>
                  <td style="text-align:right"><?= 'Rp. ', number_format($a->gaji, 0, ".", ".")?></td>
                  <td></td>
                </tr>
                <?php
				$rutin += $a->gaji;
				}
				$i=1;
                foreach ($result->detail as $row) {
                  ?>
                  <tr>
					<td><?= $row->jenisPengeluaran?></td>				
					<td><?php echo date('d/m/Y', strtotime($row->tanggalKeluar));?></td>				
                    <td style="text-align:right<?php if($row->tipePengeluaran == 'nonrutin'){echo ';color:blue';}?>"><?= 'Rp. ', number_format($row->jumlahPengeluaran, 0, ".", ".")?></td>
                    <td style="text-align:center">
						<button type="button" data-toggle="modal" data-target="#modal_editPengeluaran" id="ubah_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
					</td>
					<!--helper-->
					<input type="hidden" class="form-control" id="tanggalKeluar<?php echo $i?>" value="<?php echo $row->tanggalKeluar;?>">
					<input type="hidden" class="form-control" id="jenisPengeluaran<?php echo $i?>" value="<?php echo $row->jenisPengeluaran;?>">
					<input type="hidden" class="form-control" id="jumlahPengeluaran<?php echo $i?>"  value="<?php echo $row->jumlahPengeluaran;?>">
                  </tr>
                <?php
                if($row->tipePengeluaran == 'rutin'){
					$rutin += $row->jumlahPengeluaran;
				}else{
					$nonrutin += $row->jumlahPengeluaran;
				}
				$i++;
				}
                ?>
				
				<tr>
					<td colspan="2">Pengeluaran rutin</td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($rutin, 0, ".", ".")?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Pengeluaran nonrutin</td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($nonrutin, 0, ".", ".")?></td>
					<td></td>
				</tr>
              </tbody>
            </table>
		</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_pengeluaran">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Pengeluaran</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_pengeluaran" method="POST">
						<div class="form-group row hi1"><label class="col-sm-3 col-form-label">Tipe Pengeluaran</label>
                          <div class="col-sm-9">
							<select class="form-control" id="tipePengeluaran" name="tipePengeluaran">
								<option value="nonpokok">Nonpokok</option>
								<option value="pokok">Pokok</option>
							</select>
                          </div>
                        </div>
						<div class="form-group row hi2"><label class="col-sm-3 col-form-label">Tanggal Keluar</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tanggalKeluar" name="tanggalKeluar" autocomplete="off" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pengeluaran</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jenisPengeluaran" name="jenisPengeluaran" autocomplete="off" required>
                          </div>
                        </div>
						
						<div class="form-group row n1"><label class="col-sm-3 col-form-label">Jumlah Pengeluaran(Rp.)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahPengeluaran" name="jumlahPengeluaran" autocomplete="off" style="text-align:right" required>
                          </div>
                        </div>
						<div class="form-group row n2"><label class="col-sm-3 col-form-label">Tipe</label>
                          <div class="col-sm-9">
							<select class="form-control" id="tipe" name="tipe">
								<option value="rutin">Rutin</option>
								<option value="nonrutin">Non-rutin</option>
							</select>
                          </div>
                        </div>
						
                        <div class="form-group row p1"><label class="col-sm-3 col-form-label">Jumlah</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" style="text-align:right" autocomplete="off" required>
                          </div>
                        </div>
                        <div class="form-group row namaPegawai p2"><label class="col-sm-3 col-form-label">Harga Satuan</label>
                          <div class="col-sm-9">
							<select class="form-control" id="harga" name="harga">
								<?php foreach ($harga as $num){ ?>
								<option value="<?php echo $num->harga; ?>"><?php echo $num->namaItem,' (',number_format($num->harga, 0, ".", "."),')'; ?></option>
								<?php } ?>
							</select>
                          </div>
                        </div>
						<!--helper-->
						<input type="hidden" class="form-control" id="idK" name="idK" value=<?php echo $this->uri->segment(4);?>>
						<input type="hidden" class="form-control" id="tgl" name="tgl" value=<?php echo $this->uri->segment(3);?>>
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_pengeluaran" id="simpan"> Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_editPengeluaran">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data edit Pengeluaran</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_editPengeluaran" method="POST">
						
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pengeluaran</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaK" name="namaK" disabled>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Pengeluaran(Rp.)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahK" name="jumlahK" style="text-align:right" required>
                          </div>
                        </div>
						<!--helper-->
						<input type="hidden" class="form-control" id="idK" name="idK" value=<?php echo $this->uri->segment(4);?>>
						<input type="hidden" class="form-control" id="tglK" name="tglK">
						<input type="hidden" class="form-control" id="jenisK" name="jenisK">
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_editPengeluaran" id="simpan"> Simpan</button>
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
						<p>Apakah anda yakin ingin menghapus data pengeluaran ini?</p>
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
	 $(".n1").show();
     $(".n2").show();
	$("#jumlahPengeluaran").val('');
	$("#jumlah").val("0");
    $(".p1").hide();
	$(".p2").hide();
	
	var tgl = $('#tgl').val();
	var tahun = tgl.substr(0,4);
	var bulan = (tgl.substr(5,2))-1;
	var date = new Date();
	var firstDay = new Date(tahun,bulan, 1);
	var lastDay = new Date(tahun,bulan+1, 0);
	
	$('#ringkasan').click(function() {
		window.location = '<?php echo site_url();?>Keuntungan/getAll/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>';
	});
	
	$('#tanggalKeluar').datepicker({
		format: "yyyy-mm-dd",
        startDate: firstDay,
		endDate: lastDay,
        autoclose:true
    });

	$("#tipePengeluaran").change(function () {
		//n:jumlah pengeluaran, p1:jumlah, p2:harga
        if ($(this).val() == "pokok") {
            $(".n1").hide();
            $(".n2").hide();
            $(".p1").show();
			$("#jumlahPengeluaran").val("0");
			$("#tipe").val("rutin");
			$("#jumlah").val('');
			$(".p2").show();
        } else {
            $(".n1").show();
            $(".n2").show();
			$("#jumlahPengeluaran").val('');
			$("#jumlah").val("0");
            $(".p1").hide();
			$(".p2").hide();
        }
    });
	
	$('#btn_tambah').click(function() {
		$('#form_pengeluaran').attr('action','<?php echo site_url();?>Pengeluaran/tambahPengeluaran');
	});
	
	$('.ubah').click(function() {	
		var id=this.id.substr(5);
		$('#namaK').val($('#jenisPengeluaran' + id).val());
		$('#jenisK').val($('#jenisPengeluaran' + id).val());
		$('#tglK').val($('#tanggalKeluar' + id).val());
		$('#jumlahK').val($('#jumlahPengeluaran' + id).val());
			
		$('#form_editPengeluaran').attr('action','<?php echo site_url();?>Pengeluaran/ubahPengeluaran');
	});
	
	$('.hapus').click(function() {	
		var id=this.id.substr(6);
		$('#id').val(id);
	});
	
	$('#hapus').click(function() {
		var id = $('#id').val();
		var str = $('#jenisPengeluaran' + id).val();
		
		var i = 0, strLength = str.length;
		for(i; i < strLength; i++) {
			str = str.replace(" ", "_");
		}
		
		var url = <?php echo $this->uri->segment(4);?> + '/' + $('#tanggalKeluar' + id).val() + '/' + str;
		window.location = '<?php echo site_url();?>Pengeluaran/hapusPengeluaran/' + url;
	});
	
	var jumlahPengeluaran = document.getElementById('jumlahPengeluaran');
	jumlahPengeluaran.addEventListener('keyup', function(e){
		jumlahPengeluaran.value = formatRupiah(this.value);
	});
	
	var jumlahK = document.getElementById('jumlahK');
	jumlahK.addEventListener('keyup', function(e){
		jumlahK.value = formatRupiah(this.value);
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
