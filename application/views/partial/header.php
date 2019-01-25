<!DOCTYPE html>
<html lang="en">

<head>
  <title>Al-Baqoroh | Payroll</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.ico">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

  <!--datepicker
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.css" />
  <!--datatable-->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fixedColumns.dataTables.min.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert2.min.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/myStyle.css" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center"></div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
		<?php
		if($this->uri->segment(1) == "Hutang"){
		?>
		<ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item no-wrap <?php if($this->uri->segment(2) == 'belumLunas') echo 'active'?>">
            <a href="<?php echo site_url();?>Hutang/belumLunas" class="nav-link">Belum Lunas</a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(2) == 'lunas') echo 'active'?>">
            <a href="<?php echo site_url();?>Hutang/lunas" class="nav-link">Lunas</a>
          </li>
        </ul>
		<?php }else if(($this->uri->segment(1) == "Pemasukan") or ($this->uri->segment(1) == "Pengeluaran")){ ?>
		<ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
          <li class="nav-item no-wrap <?php if($this->uri->segment(1) == 'Pemasukan') echo 'active'?>">
            <a href="<?php echo site_url();?>Pemasukan/detail/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>" class="nav-link">Pemasukan</a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(1) == 'Pengeluaran') echo 'active'?>">
            <a href="<?php echo site_url();?>Pengeluaran/detail/<?php echo $this->uri->segment(3)?>/<?php echo $this->uri->segment(4)?>" class="nav-link">Pengeluaran</a>
          </li>
        </ul>
		<?php } ?>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello 
				<?php echo $this->session->userdata('username');?>
			  </span>
              <img class="img-xs rounded-circle" src="<?php echo base_url();?>assets/images/faces-clipart/pic-1.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item" data-toggle="modal" href="#change_pass">
                Ubah Password
              </a>
              <a href="<?php echo site_url();?>Login/keluar" class="dropdown-item">
                Keluar
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url();?>Home">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" style="<?php if(($this->uri->segment(1) == 'Pemasukan') or ($this->uri->segment(1) == 'Pengeluaran') or ($this->uri->segment(1) == 'Ampas') or ($this->uri->segment(1) == 'Keuntungan') or ($this->uri->segment(1) == 'Kandang')){echo'color:#4a4a4a';}?>">
              <i class="menu-icon mdi mdi-account-outline"></i>
              <span class="menu-title">Pegawai</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item <?php if($this->uri->segment(2) == 'PegawaiKandang'){echo 'active';}?>">
                  <a class="nav-link" href="<?php echo site_url();?>Pegawai/pegawaiKandang" style="<?php if(($this->uri->segment(1) == 'Kandang')){echo'color:#4a4a4a';}?>">Pegawai Kandang</a>
                </li>
				<li class="nav-item <?php if($this->uri->segment(2) == 'pegawaiAmpas'){echo 'active';}?>">
                  <a class="nav-link" href="<?php echo site_url();?>Pegawai/pegawaiAmpas" style="<?php if($this->uri->segment(1) == 'Ampas'){echo'color:#4a4a4a';}?>">Pegawai Ampas</a>
                </li>
                <li class="nav-item <?php if($this->uri->segment(1) == 'Hutang'){echo 'active';}?>">
                  <a class="nav-link" href="<?php echo site_url();?>Hutang/belumLunas">Hutang</a>
                </li>
				<li class="nav-item <?php if($this->uri->segment(1) == 'Gaji'){echo 'active';}?>">
                  <a class="nav-link" href="<?php echo site_url();?>Gaji/viewGaji/<?php echo date('Y-m');?>" style="<?php if(($this->uri->segment(1) == 'Pemasukan') or ($this->uri->segment(1) == 'Keuntungan') or ($this->uri->segment(1) == 'Pengeluaran')){echo'color:#4a4a4a';}?>">Gaji</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item <?php if($this->uri->segment(1) == 'Keuntungan'){echo 'active';}?>">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth" style="<?php if($this->uri->segment(1) == 'Gaji'){echo'color:#4a4a4a';}?>">
              <i class="menu-icon mdi mdi-cash-multiple"></i>
              <span class="menu-title">Usaha</span>
              <i class="menu-arrow"></i>
            </a>
			<div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
				<li class="nav-item">
                  <a class="nav-link <?php if($this->uri->segment(1) == 'Keuntungan'){echo 'active';}?>" href="<?php echo site_url();?>Keuntungan/getAll/<?php echo date('Y-m');?>" style="<?php if(($this->uri->segment(1) == 'Gaji')){echo'color:#4a4a4a';}?>">Hasil Kandang</a>
                </li>
				<li class="nav-item <?php if($this->uri->segment(1) == 'Harga'){echo 'active';}?>">
                  <a class="nav-link" href="<?php echo site_url();?>Harga">Harga</a>
                </li>
              </ul>
            </div>
          </li>
		  <li class="nav-item <?php if($this->uri->segment(1) == 'Kandang'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo site_url();?>Kandang">
              <i class="menu-icon mdi mdi-cow"></i>
              <span class="menu-title">Kandang</span>
            </a>
          </li>
		  <li class="nav-item <?php if($this->uri->segment(1) == 'Ampas'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo site_url();?>Ampas">
              <i class="menu-icon mdi mdi-archive"></i>
              <span class="menu-title">Pengambilan Ampas</span>
            </a>
          </li>
		  <li class="nav-item <?php if($this->uri->segment(1) == 'Sayur'){echo 'active';}?>">
            <a class="nav-link" href="<?php echo site_url();?>Sayur">
              <i class="menu-icon mdi mdi-content-paste"></i>
              <span class="menu-title">Pengambilan Sayur</span>
            </a>
          </li>
		  
        </ul>
      </nav>
	  
	  <div class="main-panel">
		<div class="content-wrapper">