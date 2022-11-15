<?php include('config/db.php')?>
<?php include('config/dbc.php')?>
<?php include("config/user.php");?>
<?php include('config/function.php')?>
<?php include('config/setup.php')?>
<?php include('config/session.php')?>
<?php $pagename = "Dashboard";?>
<?php
	mysqli_set_charset ($dbc,'utf8');
	$nameq = "SELECT * FROM `tbl_name`";
	$namerun = mysqli_query($dbc, $nameq);
	while($namerow=mysqli_fetch_assoc($namerun)){
		$nameid 		= $namerow['name_id'];
		$namename 		= $namerow['name_companyname'];
		$nameaddress 	= $namerow['name_companyaddress'];
	}	
?>
<?php
	mysqli_set_charset ($dbc,'utf8');
	$logoq = "SELECT * FROM `tbl_logo`";
	$logorun = mysqli_query($dbc, $logoq);
	while($logorow=mysqli_fetch_assoc($logorun)){
		$logoid 		= $logorow['logo_id'];
		$logoname 		= $logorow['logo_name'];
		$logoheight 	= $logorow['logo_height'];
		$logowidth 		= $logorow['logo_width'];
	}	
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('config/meta.php')?>

  <?php include('config/link.php')?>

  
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

  <!-- ========== HEADER ========== -->

  <?php include('config/header.php')?>

  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <!-- Navbar Vertical -->
  
  <?php include('config/verticalnav.php')?>
  

  <main id="content" role="main" class="main">
    <!-- Content -->
    <div class="content container-fluid">
		<!-- Page Header -->
		  <div class="page-header">
			<div class="row align-items-center">
			  <div class="col">
				<h1 class="page-header-title">Clients</h1>
			  </div>
			  <!-- End Col -->

			  <div class="col-auto">
				<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewClient">
				  <i class="bi-plus-circle me-1"></i> New Clients
				</a>
			  </div>
			  <!-- Modal -->
				<div class="modal fade" id="NewClient" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add New Client</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="adminaction.php" method="post" enctype="multipart/form-data">
						  <div class="mb-3">
							<label class="form-label" for="client">Select A Vendor</label>
							<select id="client" name="client" class="form-control">
							  <option value="">Choose an option</option>
							  <?php 
							  mysqli_set_charset ($dbc,'utf8');
								$vq1 = "SELECT * FROM `tbl_vendor`";
								$vrun1 = mysqli_query($dbc, $vq1);
								while($vrow1=mysqli_fetch_assoc($vrun1)){
									$vendor_id    	= $vrow1['vendor_id'];
									$vendor_name 	= $vrow1['vendor_name'];
									$vendor_logo	= $vrow1['vendor_logo'];
								?>	
							  <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_name; ?></option>
								<?php } ?>
							</select>
						  </div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="NewClient" class="btn btn-primary">Save</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				<!-- End Modal -->
			  <!-- End Col -->
			</div>
			<!-- End Row -->
		  </div>
		<!-- End Page Header -->
		<div class="row justify-content-lg-center">
			<div class="col-lg-12">
				<div class="card">
				  <!-- Header -->
				  <div class="card-header">
					<div class="row justify-content-between align-items-center flex-grow-1">
					  <div class="col-12 col-md">
						<div class="d-flex justify-content-between align-items-center">
						  <h5 class="card-header-title">Clients</h5>
						</div>
					  </div>

					  <div class="col-auto">
						<!-- Filter -->
						<form>
						  <!-- Search -->
						  <div class="input-group input-group-merge input-group-flush">
							<div class="input-group-prepend input-group-text">
							  <i class="bi-search"></i>
							</div>
						  </div>
						  <!-- End Search -->
						</form>
						<!-- End Filter -->
					  </div>
					</div>
				  </div>
				  <!-- End Header -->

				  <!-- Table -->
				  <div class="table-responsive datatable-custom">
					<table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
						   data-hs-datatables-options='{
								   "order": [],
								   "search": "#datatableWithSearchInput",
								   "isResponsive": false,
								   "isShowPaging": true,
								   "pagination": "datatablePagination"
								 }'>
					  <thead class="thead-light">
					  <tr class="text-center">
						<th>Client ID</th>
						<th>Client Name</th>
						<th>Client Status</th>
						<th>Delete</th>
					  </thead>

					  <tbody>
						<?php
						mysqli_set_charset ($dbc,'utf8');
						$clientq1 = "SELECT * FROM `tbl_clients`";
						$clientrun1 = mysqli_query($dbc, $clientq1);
						while($clientrow1=mysqli_fetch_assoc($clientrun1)){
							$client_id 			= $clientrow1['client_id'];
							$client_vendorid 	= $clientrow1['client_vendorid'];
							$client_status		= $clientrow1['client_status'];
							
						mysqli_set_charset ($dbc,'utf8');
						$vq1 = "SELECT * FROM `tbl_vendor` WHERE `vendor_id`='$client_id'";
						$vrun1 = mysqli_query($dbc, $vq1);
						while($vrow1=mysqli_fetch_assoc($vrun1)){
							$vendor_id    	= $vrow1['vendor_id'];
							$vendor_name 	= $vrow1['vendor_name'];
							$vendor_logo	= $vrow1['vendor_logo'];
						}
						
						?>
					  
					  <tr class="text-center">
						<td><?php echo $client_id; ?></td>
						<td class="text-center">
							<img class="avatar avatar-lg avatar-4x3" src="../uploads/<?php echo $vendor_logo;?>" alt="Image Description">
							<div class="ms-0">
								<span class="d-block h5 text-inherit mb-0"><?php echo $vendor_name;?> </span>
							</div>
						</td>
						
						<td>
							<?php
								if ($client_status == "1") { ?>
									<a class="btn btn-success btn-sm" href="adminaction.php?DisableClient=<?php echo $client_id;?>" class="link-sm link-secondary small lead" onclick="return confirm('Are you sure you want to disable the client ?');">
										Active
									</a>
								<?php } else { ?>
									<a class="btn btn-danger btn-sm" href="adminaction.php?EnableClient=<?php echo $client_id;?>" class="link-sm link-secondary small lead" onclick="return confirm('Are you sure you want to enable this client ?');">
										In-Active
									</a>
								<?php }
							?>
						
						</td>
						
						<td class="text-center">
							<a class="btn btn-ghost-danger" href="adminaction.php?ClientDelete=<?php echo $client_id;?>" class="link-sm link-secondary small lead" onclick="return confirm('Are you sure you want to remove this client ?');">
								<i class="bi bi-trash"></i>
							</a>	
						</td>
					  </tr>
						<?php } ?>
					  </tbody>
					</table>
				  </div>
				  <!-- End Table -->

				  <!-- Footer -->
				  <div class="card-footer">
					  <!-- Pagination -->
					  <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
						<div class="col-sm mb-2 mb-sm-0">
						  <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
							<span class="me-2">Showing:</span>

							<!-- Select -->
							<div class="tom-select-custom">
							  <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
										"searchInDropdown": false,
										"hideSearch": true
									  }'>
								<option value="4">4</option>
								<option value="6">6</option>
								<option value="8" selected>8</option>
								<option value="12">12</option>
							  </select>
							</div>
							<!-- End Select -->

							<span class="text-secondary me-2">of</span>

							<!-- Pagination Quantity -->
							<span id="datatableWithSearchInput"></span>
						  </div>
						</div>
						<!-- End Col -->

						<div class="col-sm-auto">
						  <div class="d-flex justify-content-center justify-content-sm-end">
							<!-- Pagination -->
							<nav id="datatablePagination" aria-label="Activity pagination"></nav>
						  </div>
						</div>
						<!-- End Col -->
					  </div>
					  <!-- End Pagination -->
				  </div>
				  <!-- End Footer -->
				</div>
			</div> 
		</div>
	</div>
	<!-- End Content -->

    <!-- Footer -->

    <?php include('config/footer.php')?>

    <!-- End Footer -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- JS Implementing Plugins -->
  <script src="assets/js/vendor.min.js"></script>

  <!-- JS Front -->
  <script src="assets/js/theme.min.js"></script>
  
  <script src="assets/js/hs.theme-appearance.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      window.onload = function () {
        

        // INITIALIZATION OF NAVBAR VERTICAL ASIDE
        // =======================================================
        new HSSideNav('.js-navbar-vertical-aside').init()


        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        new HSFormSearch('.js-form-search')


        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        HSBsDropdown.init()


        // INITIALIZATION OF SELECT
        // =======================================================
        HSCore.components.HSTomSelect.init('.js-select')


        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        new HsNavScroller('.js-nav-scroller')


        // INITIALIZATION OF DROPZONE
        // =======================================================
        HSCore.components.HSDropzone.init('.js-dropzone')
      }
    })()
  </script>
</body>

</html>