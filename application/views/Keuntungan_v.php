<?php
	$this->load->view('partial/header');
	include_once('tanggalIndo.php');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
		<div class="card-body">
		<div class="row" style="margin-bottom:20px">
		  <div class="col-auto mr-auto"><h4 class="card-title">Keuntungan Bulanan <?php echo konversi($this->uri->segment(3));?></h4></div>
		  <div class="col-auto">
			<?php if($status == '!saved'){ ?>
					<button type="button" class="btn pull-right btn-success btn-fw" id="simpanKeuntungan"><i class="mdi mdi-download"></i>Simpan pendapatan bulan ini</button>
			<?php }else{ ?>
					<button type="button" class="btn pull-right btn-danger btn-fw" id="resetKeuntungan"><i class="mdi mdi-delete"></i>Reset pendapatan bulan ini</button>
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
		?>
            <table id="keuntungan" class="table table-striped nowrap">
              <thead>
                <tr>
				  <th>Nama Kandang</th>
                  <th>Pegawai</th>
                  <th style="text-align:right">Pemasukan</th>
                  <th style="text-align:right">Pengeluaran</th>
                  <th style="text-align:right">Pendapatan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
				$totalPemasukan = $totalPengeluaran = $totalKeuntungan = 0;
                foreach ($result as $row) {
                  ?>
                  <tr>
					<td><?= $row->namaKandang?></td>
                    <td><?= ucwords($row->namaPegawai)?></td>
					<td style="text-align:right"><?= 'Rp. ', number_format($row->pemasukan, 0, ".", ".")?></td>
					
                    <td style="text-align:right"><?= 'Rp. ', number_format($row->pengeluaran, 0, ".", ".")?></td>
                    <td style="text-align:right;<?php if($row->keuntungan != $row->keuntungansaved){echo 'color:red';}?>"><?= 'Rp. ', number_format($row->keuntungan, 0, ".", ".")?></td>
					<td style="text-align:center;">
						<button type="button" id="detail_<?php echo $row->idKandang;?>" class="btn btn-outline-primary detail">
                          Detail
                        </button>
					</td>
				  </tr>
                  <?php
                $totalPemasukan += $row->pemasukan;
                $totalPengeluaran += $row->pengeluaran;
                $totalKeuntungan += $row->keuntungan;
				}
                ?>
				
				<tr>
					<td colspan="2"><b>Total</b></td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($totalPemasukan, 0, ".", ".")?></td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($totalPengeluaran, 0, ".", ".")?></td>
					<td style="text-align:right"><?php echo 'Rp. ', number_format($totalKeuntungan, 0, ".", ".")?></td>
					<td></td>
				</tr>
              </tbody>
            </table>
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
	$('#bulanTahun').datepicker({
        format: "yyyy-mm",
		viewMode: "months", 
		minViewMode: "months",
        autoclose:true
    });
	
	$('.lihat').click(function() {
		window.location = '<?php echo site_url();?>Keuntungan/getAll/' + $('#bulanTahun').val();
	});
	
	$('#keuntungan').on('click','.detail',function() {
		var idKandang = this.id.substr(7);
		window.location = '<?php echo site_url();?>Pemasukan/detail/<?php echo $this->uri->segment(3)?>/' + idKandang;
	});
	
	$('#simpanKeuntungan').click(function() {
		window.location = '<?php echo site_url();?>Keuntungan/simpanKeuntungan/<?php echo $this->uri->segment(3);?>';
	});
	
	$('#resetKeuntungan').click(function() {
		window.location = '<?php echo site_url();?>Keuntungan/resetKeuntungan/<?php echo $this->uri->segment(3);?>';
	});
	
	$('#keuntungan').DataTable({
		scrollX: true,
		fixedColumns: {
			leftColumns: 1,
			rightColumns: 1
		}
	});
});

</script>
