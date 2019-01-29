<?php
	$this->load->view('partial/header');
	include_once('tanggalIndo.php');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Detail Pemasukan</h4></div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="ringkasan">Ringkasan</button>
		  </div>
		  <div class="col-auto">
			<button type="button" class="btn pull-right btn-primary btn-fw" id="btn_tambah" data-toggle="modal" data-target="#modal_pemasukan">Tambah Pemasukan</button>
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
		  <div class="col-md-2"><p class="font-weight-bold">Bulan</p></div>
		  <div class="col-md-9"><p class="mb-2">: <?php echo konversi($this->uri->segment(3));?></p></div>
		</div>
		<div class="table-responsive">
            <table id="pemasukan" class="table table-striped nowrap">
              <thead>
                <tr>
				  <th>Pemasukan</th>
				  <th>Tanggal Pemasukan</th>
                  <th style="text-align:right">Jumlah Pemasukan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$rutin = $nonrutin = 0;
				$i=1;
                foreach ($result->detail as $row) {
                  ?>
                  <tr>
					<td><?= $row->jenisPemasukan?></td>				
					<td><?php echo date('d/m/Y', strtotime($row->tanggalMasuk));?></td>				
                    <td style="text-align:right<?php if($row->tipePemasukan == 'nonrutin'){echo ';color:blue';}?>"><?= 'Rp. ', number_format($row->jumlahPemasukan, 0, ".", ".")?></td>
                    <td style="text-align:center">
						<button type="button" data-toggle="modal" data-target="#modal_editPemasukan" id="ubah_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-warning ubah">
                          <i class="mdi mdi-pencil"></i>
                        </button>
						<button type="button" data-toggle="modal" data-target="#modal_konfirm" id="hapus_<?php echo $i;?>" class="btn btn-icons btn-rounded btn-outline-danger hapus">
                          <i class="mdi mdi-delete"></i>
                        </button>
					</td>
					<!--helper-->
					<input type="hidden" class="form-control" id="tanggalMasuk<?php echo $i?>" value="<?php echo $row->tanggalMasuk;?>">
					<input type="hidden" class="form-control" id="jenisPemasukan<?php echo $i?>" value="<?php echo $row->jenisPemasukan;?>">
					<input type="hidden" class="form-control" id="jumlahPemasukan<?php echo $i?>"  value="<?php echo $row->jumlahPemasukan;?>">
                  </tr>
                <?php
					if($row->tipePemasukan == 'rutin'){
						$rutin += $row->jumlahPemasukan;
					}else{
						$nonrutin += $row->jumlahPemasukan;
					}	
					$i++;
				}
                ?>
				
				<tr>
					<td colspan="2">Pemasukan rutin</td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($rutin, 0, ".", ".")?></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">Pemasukan nonrutin</td>
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

<div class="modal fade" id="modal_pemasukan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data Pemasukan</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_pemasukan" method="POST">
						<div class="form-group row hi1"><label class="col-sm-3 col-form-label">Tipe Pemasukan</label>
                          <div class="col-sm-9">
							<select class="form-control" id="tipePemasukan" name="tipePemasukan">
								<option value="nonpokok">Nonpokok</option>
								<option value="pokok">Pokok</option>
							</select>
                          </div>
                        </div>
						<div class="form-group row hi2"><label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="tanggalMasuk" name="tanggalMasuk" autocomplete="off" required>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pemasukan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jenisPemasukan" name="jenisPemasukan" autocomplete="off" required>
                          </div>
                        </div>
						
						<div class="form-group row n1"><label class="col-sm-3 col-form-label">Jumlah Pemasukan(Rp.)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahPemasukan" name="jumlahPemasukan" autocomplete="off" style="text-align:right" required>
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
                            <input type="text" class="form-control" id="jumlah" name="jumlah" autocomplete="off" style="text-align:right" required>
                          </div>
                        </div>
                        <div class="form-group row p2"><label class="col-sm-3 col-form-label">Harga Satuan</label>
                          <div class="col-sm-9">
							<select class="form-control" id="harga" name="harga">
								<?php foreach ($harga as $num){ ?>
								<option value="<?php echo $num->harga; ?>"><?php echo $num->namaItem,' (',$num->harga,')'; ?></option>
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
				<button class="btn btn-success mr-2" type="submit" form="form_pemasukan" id="simpan"> Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_editPemasukan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Data edit Pemasukan</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form class="forms-sample" id="form_editPemasukan" method="POST">
						
						<div class="form-group row"><label class="col-sm-3 col-form-label">Nama Pemasukan</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="namaP" name="namaP" disabled>
                          </div>
                        </div>
						<div class="form-group row"><label class="col-sm-3 col-form-label">Jumlah Pemasukan(Rp.)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="jumlahP" name="jumlahP" style="text-align:right" required>
                          </div>
                        </div>
						<!--helper-->
						<input type="hidden" class="form-control" id="idK" name="idK" value=<?php echo $this->uri->segment(4);?>>
						<input type="hidden" class="form-control" id="tglM" name="tglM">
						<input type="hidden" class="form-control" id="jenisP" name="jenisP">
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success mr-2" type="submit" form="form_editPemasukan" id="simpan"> Simpan</button>
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
						<p>Apakah anda yakin ingin menghapus data pemasukan ini?</p>
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
    $(".p1").hide();
	$(".p2").hide();
	$("#jumlahPemasukan").val('');
	$("#jumlah").val("0");
	
	var tgl = $('#tgl').val();
	var tahun = tgl.substr(0,4);
	var bulan = (tgl.substr(5,2))-1;
	var date = new Date();
	var firstDay = new Date(tahun,bulan, 1);
	var lastDay = new Date(tahun,bulan+1, 0);
	
	$('#tanggalMasuk').datepicker({
		format: "yyyy-mm-dd",
        startDate: firstDay,
		endDate: lastDay,
        autoclose:true
    });

	$("#tipePemasukan").change(function () {
        if ($(this).val() == "pokok") { //kalo pokok
            $(".n1").hide();
            $(".n2").hide();
			$("#jumlahPemasukan").val("0");
			$("#tipe").val("rutin");
			$("#jumlah").val('');
            $(".p1").show();
			$(".p2").show();
        } else {
            $(".n1").show();
            $(".n2").show();
            $(".p1").hide();
			$(".p2").hide();
			$("#jumlahPemasukan").val('');
			$("#jumlah").val("0");
        }
    });
	
	$('#ringkasan').click(function() {
		window.location = '<?php echo site_url();?>Keuntungan/getAll/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>';
	});
	
	$('#btn_tambah').click(function() {
		$('#form_pemasukan').attr('action','<?php echo site_url();?>Pemasukan/tambahPemasukan');
	});
	
	$('.ubah').click(function() {	
		var id=this.id.substr(5);
		$('#namaP').val($('#jenisPemasukan' + id).val());
		$('#jenisP').val($('#jenisPemasukan' + id).val());
		$('#tglM').val($('#tanggalMasuk' + id).val());
		$('#jumlahP').val($('#jumlahPemasukan' + id).val());
			
		$('#form_editPemasukan').attr('action','<?php echo site_url();?>Pemasukan/ubahPemasukan');
	});
	
	$('.hapus').click(function() {	
		var id=this.id.substr(6);
		$('#id').val(id);
	});
	
	$('#hapus').click(function() {
		var id = $('#id').val();
		var str = $('#jenisPemasukan' + id).val();
		
		var i = 0, strLength = str.length;
		for(i; i < strLength; i++) {
			str = str.replace(" ", "_");
		}
		
		var url = <?php echo $this->uri->segment(4);?> + '/' + $('#tanggalMasuk' + id).val() + '/' + str;
		window.location = '<?php echo site_url();?>Pemasukan/hapusPemasukan/' + url;
	});
	
	var jumlahPemasukan = document.getElementById('jumlahPemasukan');
	jumlahPemasukan.addEventListener('keyup', function(e){
		jumlahPemasukan.value = formatRupiah(this.value);
	});
	
	var jumlahP = document.getElementById('jumlahP');
	jumlahP.addEventListener('keyup', function(e){
		jumlahP.value = formatRupiah(this.value);
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
