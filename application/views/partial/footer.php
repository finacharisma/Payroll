<div class="modal fade" id="change_pass">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="card-title">Ubah Password</h4>
				<button class="close" data-dismiss="modal">&times</button>
			</div>
			<div class="modal-body">
				<div class="card">
                    <div class="card-body">
                      <form>
						<div class="form-group row hi2"><label class="col-sm-3 col-form-label">Password baru</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger mr-2 ubahPassword" type="submit"> Simpan</button>
			</div>
		</div>
	</div>
</div>
		</div>
		<!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Powered by
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?php echo base_url();?>assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <!--<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>-->
  <script src="<?php echo base_url();?>assets/js/off-canvas.js"></script>
  <script src="<?php echo base_url();?>assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
  
  <!--datepicker-->
  <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.js"></script>
  <script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
  
  <!--dataTables-->
  <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/dataTables.fixedColumns.min.js"></script>
  
  <!--sweetalert-->
  <script src="<?php echo base_url();?>assets/js/sweetalert2.min.js"></script>
</body>

</html>

<script type="text/javascript">
	$('.ubahPassword').click(function() {
		var pass = $('#password').val();
		$.ajax({
            url  : "<?php echo site_url();?>Home/ubahPassword",
			type : "POST",
            dataType : "JSON",
            data : {"password": pass},
            success: function(data){
				//$("#change_pass").modal('hide');
				swal({ 
					type: 'success', 
					title: 'sukses',
					icon: 'success',
					text: data 
				});
			},
			error: function (textStatus, errorThrown){
				//$("#change_pass").modal('hide');
				swal({ 
					type: 'error', 
					title: 'error!',
					icon: 'danger',
					text: data 
				});
			}
        });
	});
</script>