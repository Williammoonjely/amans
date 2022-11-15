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
	  
	  <?php
		mysqli_set_charset ($dbc,'utf8');
		if(isset($_GET['product'])){						
		$peditid = $_GET['product'];
		?>
		<!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h1 class="page-header-title">Manage Product Image</h1>
          </div>
          <!-- End Col -->

          <div class="col-auto">
            <a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#addnewimage<?php echo $peditid; ?>">
              <i class="bi-plus-circle me-1"></i> Add Image
            </a>
          </div>
		  <!-- Modal -->
			<div class="modal fade" id="addnewimage<?php echo $peditid; ?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Add New Image</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<form action="adminaction.php" method="post" enctype="multipart/form-data">
						<div class="card">
							<div class="card-body">
						
								<div class="mb-3">
									<label class="form-label" for="pvimage">Product Image</label>
									<input type="file" id="pvimage" name="pvimage" class="form-control" placeholder="" required>
								</div>
							</div>	
						</div>
						<input type="hidden" id="productid" name="productid" class="form-control" value="<?php echo $peditid; ?>" required>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="EditPImage" class="btn btn-primary">Upload</button>
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
		<?php } ?>
	  
	  <div class="row justify-content-lg-center">
        <div class="col-lg-10">
						
											<!-- Card -->
												<div class="card mb-3 mb-lg-5">
													<div class="card-body">
														<!-- Gallery -->
														  <div id="fancyboxGallery" class="js-fancybox row justify-content-sm-center gx-3">
															<?php
															mysqli_set_charset ($dbc,'utf8');
															if(isset($_GET['product'])){						
															$peditid = $_GET['product'];
															mysqli_set_charset ($dbc,'utf8');
															$pimgq2 = "SELECT * FROM `tbl_productimage` WHERE `pimg_productid`='$peditid'";
															$pimgrun2 = mysqli_query($dbc, $pimgq2);
															while($pimgrow2=mysqli_fetch_assoc($pimgrun2)){
																$pimg_id2  			= $pimgrow2['pimg_id'];
																$pimg_name2 		= $pimgrow2['pimg_name'];
																$pimg_productid2 	= $pimgrow2['pimg_productid'];
															
															?>
															<div class="col-6 col-sm-4 col-md-3 mb-3 mb-lg-5">
															  <!-- Card -->
															  <div class="card card-sm">
																<img class="card-img-top border-bottom" src="../uploads/<?php echo $pimg_name2; ?>" alt="Image Description">

																<div class="card-body">
																  <div class="row col-divider text-center">
																	<div class="col">
																	  <a class="text-body" href="../uploads/<?php echo $pimg_name2; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="View" data-fslightbox="gallery">
																		<i class="bi-eye"></i>
																	  </a>
																	</div>
																	<!-- End Col -->
																	
																	<div class="col">
																	  <a class="text-danger" href="adminaction.php?ImageRemove=<?php echo $pimg_id2;?>" class="lead" onclick="return confirm('Are you sure you want to remove this product ?');" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
																		<i class="bi-trash"></i>
																	  </a>
																	</div>

																	
																	<!-- End Col -->
																  </div>
																  <!-- End Row -->
																</div>
																<!-- End Col -->
															  </div>
															  <!-- End Card -->
															</div>
															<!-- End Col -->
															<?php } }?>
														  </div>
												
													</div>
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