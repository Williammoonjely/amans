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
				<h1 class="page-header-title">Vendors</h1>
			  </div>
			  <!-- End Col -->

			  <div class="col-auto">
				<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewVendors">
				  <i class="bi-plus-circle me-1"></i> New Vendors
				</a>
			  </div>
			  <!-- End Col -->
			  <!-- Modal -->
				<div class="modal fade" id="NewVendors" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add New Vendors</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="adminaction.php" method="post" enctype="multipart/form-data">
						  <div class="mb-3">
							<label class="form-label" for="vendorname">Vendor Name</label>
							<input type="text" id="vendorname" name="vendorname" class="form-control" placeholder="Vendor Name" required>
						  </div>
						  
						  <div class="mb-3">
							<label class="form-label" for="vendorlogo">Vendor Logo</label>
							<input type="file" id="vendorlogo" name="vendorlogo" class="form-control" placeholder="Vendor Logo" required>
						  </div>
						  
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="NewVendor" class="btn btn-primary">Upload</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				<!-- End Modal -->
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
						  <h5 class="card-header-title">Vendors</h5>
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
						<th>Vendor ID</th>
						<th>Vendor Name</th>
						<th>Delete</th>
					  </thead>

					  <tbody>
						<?php
						mysqli_set_charset ($dbc,'utf8');
						$vq1 = "SELECT * FROM `tbl_vendor`";
						$vrun1 = mysqli_query($dbc, $vq1);
						while($vrow1=mysqli_fetch_assoc($vrun1)){
							$vendor_id    	= $vrow1['vendor_id'];
							$vendor_name 	= $vrow1['vendor_name'];
							$vendor_logo	= $vrow1['vendor_logo'];
						
						
						?>
					  
					  <tr class="text-center">
						<td><?php echo $vendor_id; ?></td>
						<td class="text-center">
							<a class="d-flex justify-content-center">
								<div class="avatar avatar-circle">
									<img class="avatar-img" src="../uploads/<?php echo $vendor_logo;?>" alt="Image Description">
								</div>
								<div class="ms-3 mt-3">
									<span class="d-block h5 text-inherit mb-0"><?php echo $vendor_name;?> </span>
								</div>
							</a>	
						</td>
						<td class="text-center">
							<a class="btn btn-ghost-danger" href="adminaction.php?VendorDelete=<?php echo $vendor_id;?>" class="link-sm link-secondary small lead" onclick="return confirm('Are you sure you want to remove this vendor ?');">
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