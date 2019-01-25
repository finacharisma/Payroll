<?php
	$this->load->view('partial/header');
	include_once('tanggalIndo.php');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Data Gaji Pegawai Bulan <?php echo konversi($this->uri->segment(3));?></h4></div>
		  <div class="col-auto"><button type="button" class="btn pull-right btn-primary btn-fw" id="cetak"><i class="mdi mdi-printer"></i>Cetak</button></div>
		  <div class="col-auto">
			<?php if($status == "none"){ ?>
					<button type="button" class="btn pull-right btn-success btn-fw" id="simpanGaji"><i class="mdi mdi-download"></i>Simpan data bulan ini</button>
			<?php }else{ ?>
					<button type="button" class="btn pull-right btn-danger btn-fw" id="resetGaji"><i class="mdi mdi-delete"></i>Reset data bulan ini</button>
			<?php } ?>
		  </div>
		</div>
		<div class="row">
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" id="bulanTahun" placeholder="<?php echo $this->uri->segment(3);?>" autocomplete="off">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-fw lihat">Lihat</button>
			</div>
		</div>
		<?php 
		if(count($result) == 0) echo '<div style="display:block; text-align:center">Tidak ada data</div>';
		else{
			$result = json_decode($result);
		?>
		<div class="table-responsive">
            <table id="gaji" class="table table-bordered table-striped nowrap">
              <thead>
                <tr>
                  <th>Nama Pegawai</th>
                  <th style="text-align:right">Total Gaji</th>
                  <th style="text-align:right">Hutang</th>
                  <th style="text-align:right">Gaji Bersih</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($result as $row) {
                  ?>
                  <tr>
					<td><font <?php if(isset($pesan)) echo 'color="red"';?>><?= $row->namaPegawai?></font></td>
                    <td style="text-align:right"><?php echo 'Rp. '.number_format($row->totalGaji, 0, ".", ".")?></td>
                    <td style="text-align:right"><?php echo 'Rp. '.number_format($row->totalHutang, 0, ".", ".");?></td>
                    <td style="text-align:right;<?php if($row->gajiBulat != $row->gajisaved){echo 'color:red';}?>"><?= 'Rp. '.number_format($row->gajiBulat, 0, ".", ".")?></td>
                    <th style="text-align:center">
						<button type="button" id="detail_<?php echo $row->idPegawai;?>" class="btn btn-outline-primary detail">
                          Detail
                        </button>
					</th>
                  </tr>
                  <?php
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
	
	$('#bulanTahun').datepicker({
        format: "yyyy-mm",
		viewMode: "months", 
		minViewMode: "months",
        autoclose:true
    });
	
	$('.lihat').click(function() {
		window.location = '<?php echo site_url();?>Gaji/viewGaji/' + $('#bulanTahun').val();
	});
	
	$('#gaji').on('click','.detail',function() {
		var idPegawai = this.id.substr(7);
		window.location = '<?php echo site_url();?>Gaji/detailGaji/' + '<?php echo $this->uri->segment(3);?>' + '/' + idPegawai;
	});
	
	$('#simpanGaji').click(function() {
		window.location = '<?php echo site_url();?>Gaji/simpanGaji/<?php echo $this->uri->segment(3);?>';
	});
	
	$('#resetGaji').click(function() {
		window.location = '<?php echo site_url();?>Gaji/resetGaji/<?php echo $this->uri->segment(3);?>';
	});
	
	$('#cetak').click(function() {
		window.location = '<?php echo site_url();?>Gaji/cetakAll/<?php echo $this->uri->segment(3);?>';
	});
	
	$('#gaji').DataTable({
	});
});

</script>
