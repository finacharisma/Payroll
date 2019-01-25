<?php
	$this->load->view('partial/header');
	include_once('tanggalIndo.php');
?>
	<div class="card">
		<div class="card-body" style="padding:5%">
			<div class="row">
				<div class="form-group col-sm-3">
					<input type="text" class="form-control" id="bulanTahun" autocomplete="off">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-fw lihat">Lihat</button>
				</div>
			</div>
			<div><canvas id="myChart" style="padding-right:5%"></canvas></div>
		</div>
	</div>
<?php
	$this->load->view('partial/footer');
?>

<script src="<?php echo base_url();?>assets/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/js/chartjs-plugin-datalabels.js"></script>
<script>

function rupiah(angka){
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
    return rupiah.split('',rupiah.length-1).reverse().join('');
}

function formatTanggal(tgl){
    var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	var t = tgl.split('-');
	var hsl = bulan[parseInt(t[1])-1].concat(' ', t[0]);
	
	return hsl;
}

function createChart(label, data, data2, tgl, tgl2, labelx, labely, judul){
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: label,
			datasets: [{
				label: tgl2,
				data: data2,
				backgroundColor: 'rgba(30, 144, 255, 0.6)',
				lineTension: 0
			},
				{
				label: tgl,
				data: data,
				backgroundColor: 'rgba(173, 216, 230, 0.6)',
				lineTension: 0
			}
			],
			
		},options: {
			plugins: {
					datalabels: {
						anchor:'end',
						align: 'top',
						formatter: function(value, context) {
							return rupiah(Math.round(value/1000));
						}
					}
				},
			responsive: true,
			legend: {
				position: 'bottom',
			},
			hover: {
				mode: 'label'
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: labelx
					}
				}],
				yAxes: [{
					display: true,
					ticks: {
						beginAtZero: true,
						callback: function(value) {if (value % 1 === 0) {return 'Rp.'+rupiah(value);}}
					},
					scaleLabel: {
						display: true,
						labelString: labely
					}
				}]
			},
			title: {
				display: true,
				text: judul
			}
		}
	});
}
</script>

<script type="text/javascript">
$(document).ready(function() {
	var tgl = "<?php echo date('Y-m')?>";
	var tanggal = ''; //tanggal sebelumnya
		
	var t = tgl.split('-');
	if(t[1]=='01'){
		tanggal = tanggal.concat('', (parseInt(t[0])-1));
		tanggal = tanggal.concat('','-12');
	}else{
		tanggal = tanggal.concat('',t[0]);
		tanggal = tanggal.concat('','-');
		if((parseInt(t[1])-1) < 10){
			tanggal = tanggal.concat('','0');
			tanggal = tanggal.concat('',(parseInt(t[1])-1));
		}else{
			tanggal = tanggal.concat('',(parseInt(t[1])-1));
		}
	}
	$.ajax({
        url  : "<?php echo site_url();?>Home/viewChart",
		type : "POST",
        dataType : "JSON",
        data : {"tgl": tgl, "tglbefore": tanggal},
        success: function(data){
			var label = data.label;
			var isi = data.isi;
			var isi2 = data.isi2;
			$('#bulanTahun').val(tgl);
			createChart(label,isi,isi2,formatTanggal(tgl),formatTanggal(tanggal), 'Kandang', 'Total Pendapatan', 'Pendapatan kandang');
		},
		error: function (textStatus, errorThrown){
			console.log(data);
		}
    });
		
	$('#bulanTahun').datepicker({
        format: "yyyy-mm",
		viewMode: "months", 
		minViewMode: "months",
        autoclose:true
    });
	
	$('.lihat').click(function() {
		var tgl = $('#bulanTahun').val();
		var tanggal = ''; //tanggal sebelumnya
		
		var t = tgl.split('-');
		if(t[1]=='01'){
			tanggal = tanggal.concat('', (parseInt(t[0])-1));
			tanggal = tanggal.concat('','-12');
		}else{
			tanggal = tanggal.concat('',t[0]);
			tanggal = tanggal.concat('','-');
			if((parseInt(t[1])-1) < 10){
				tanggal = tanggal.concat('','0');
				tanggal = tanggal.concat('',(parseInt(t[1])-1));
			}else{
				tanggal = tanggal.concat('',(parseInt(t[1])-1));
			}
		}
		
		$.ajax({
            url  : "<?php echo site_url();?>Home/viewChart",
			type : "POST",
            dataType : "JSON",
            data : {"tgl": tgl, "tglbefore": tanggal},
            success: function(data){
				var label = data.label;
				var isi = data.isi;
				var isi2 = data.isi2;
				$('#bulanTahun').val(tgl);
				createChart(label,isi,isi2,formatTanggal(tgl),formatTanggal(tanggal), 'Kandang', 'Total Pendapatan', 'Pendapatan kandang');
			},
			error: function (textStatus, errorThrown){
				console.log(data);
			}
        });
	});
});
</script>