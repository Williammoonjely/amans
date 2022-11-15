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
      <div class="row justify-content-lg-center">
        <div class="col-lg-11">
		
						<?php
						mysqli_set_charset ($dbc,'utf8');
						if(isset($_GET['product'])){						
						$peditid = $_GET['product'];
						
							$productq = "SELECT * FROM tbl_products WHERE `product_id`='$peditid'";
							$productrun = mysqli_query($dbc, $productq);
							while($productrow=mysqli_fetch_assoc($productrun)){
							$productpi_id 				= mysqli_real_escape_string($dbc, $productrow['product_id']);
							$productp_name	 			= mysqli_real_escape_string($dbc, $productrow['product_name']);
							$productp_product_shotdec	= mysqli_real_escape_string($dbc, $productrow['product_shotdec']);
							$product_catid				= mysqli_real_escape_string($dbc, $productrow['product_catid']);
							$product_summery			= mysqli_real_escape_string($dbc, $productrow['product_summery']);
							$product_status				= mysqli_real_escape_string($dbc, $productrow['product_status']);
							
							
							mysqli_set_charset ($dbc,'utf8');
							$pimgq = "SELECT * FROM `tbl_productimage` WHERE `pimg_productid`='$productpi_id'";
							$pimgrun = mysqli_query($dbc, $pimgq);
							while($pimgrow=mysqli_fetch_assoc($pimgrun)){
								$pimg_id  		= $pimgrow['pimg_id'];
								$pimg_name 		= $pimgrow['pimg_name'];
								$pimg_productid = $pimgrow['pimg_productid'];
							}
							mysqli_set_charset ($dbc,'utf8');
							$catq = "SELECT * FROM `tbl_category` WHERE `category_id`='$product_catid'";
							$catrun = mysqli_query($dbc, $catq);
							while($catrow=mysqli_fetch_assoc($catrun)){
								$category_id   		= $catrow['category_id'];
								$category_name 		= $catrow['category_name'];
								$category_status	= $catrow['category_status'];
							
							}
						
						?>
						<div class="card">
							<div class="card-header">
								<form action="adminaction.php" method="post" enctype="multipart/form-data">
									  <div class="mb-3">
										<label class="form-label" for="productname">Product Name</label>
										<input type="text" id="productname" name="productname" class="form-control" value="<?php echo $productp_name; ?>" required>
									  </div>
									  <div class="mb-3">
										<label class="form-label" for="productcategory">Select Category</label>
										<select id="productcategory" name="productcategory" class="form-control" required>
										  <option value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
										  <?php
											mysqli_set_charset ($dbc,'utf8');
											$catq1 = "SELECT * FROM `tbl_category`";
											$catrun1 = mysqli_query($dbc, $catq1);
											while($catrow1=mysqli_fetch_assoc($catrun1)){
												$category_id1   		= $catrow1['category_id'];
												$category_name1 		= $catrow1['category_name'];
												$category_status1		= $catrow1['category_status'];
														
											?>
										  <option value="<?php echo $category_id1; ?>"><?php echo $category_name1;?> </option>
											<?php } ?>
										</select>
									  </div>
									  <div class="mb-3">
										<label class="form-label" for="productshotdec">Product Short Description</label>
										<textarea id="productshotdec" name="productshotdec" class="form-control" rows="4" required><?php echo $product_summery; ?></textarea>
									  </div>
									  <div class="mb-3">
										<label class="form-label" for="productsummery">Product Summery</label>
										<textarea id="productsummery" name="productsummery" class="form-control" rows="4" required><?php echo $product_summery; ?></textarea>
									  </div>
									  <input type="hidden" id="productupdateddate" name="productupdateddate" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
									  <input type="hidden" id="productadduser" name="productadduser" class="form-control" value="<?php echo $pageid; ?>" required>
									  <input type="hidden" id="productid" name="productid" class="form-control" value="<?php echo $productpi_id; ?>" required>
									  <div class="form-group mt-4 float-end">
										<button type="submit" name="ProductEdit" class="btn btn-primary btn-block"> Save Changes</button>
									  </div>
								</form>	
							</div>		
						</div>
						<?php } } ?>
		  
		  
		  
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