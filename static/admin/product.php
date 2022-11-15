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
				<h1 class="page-header-title">Products</h1>
			  </div>
			  <!-- End Col -->

			  <div class="col-auto">
				<a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NewProduct">
				  <i class="bi-plus-circle me-1"></i> New Product
				</a>
			  </div>
			  <!-- Modal -->
				<div class="modal fade" id="NewProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
					  <div class="modal-header">
						<h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Product</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					  </div>
					  <div class="modal-body">
						<form action="adminaction.php" method="post" enctype="multipart/form-data">
						  <div class="mb-3">
							<label class="form-label" for="productname">Product Name</label>
							<input type="text" id="productname" name="productname" class="form-control" placeholder="Product Name" required>
						  </div>
						  <div class="mb-3">
							<label class="form-label" for="productcategory">Select Category</label>
							<select id="productcategory" name="productcategory" class="form-control" required>
							  <option value="">Choose an option</option>
							  <?php
								mysqli_set_charset ($dbc,'utf8');
								$catq = "SELECT * FROM `tbl_category`";
								$catrun = mysqli_query($dbc, $catq);
								while($catrow=mysqli_fetch_assoc($catrun)){
									$category_id   		= $catrow['category_id'];
									$category_name 		= $catrow['category_name'];
									$category_status	= $catrow['category_status'];
											
								?>
							  <option value="<?php echo $category_id; ?>"><?php echo $category_name;?> </option>
								<?php } ?>
							</select>
						  </div>
						  <div class="mb-3">
							<label class="form-label" for="productshotdec">Product Short Description</label>
							<textarea id="productshotdec" name="productshotdec" class="form-control" placeholder="Product Short Description" rows="4" required></textarea>
						  </div>
						  <div class="mb-3">
							<label class="form-label" for="productsummery">Product Summery</label>
							<textarea id="productsummery" name="productsummery" class="form-control" placeholder="Product Summery" rows="4" required></textarea>
						  </div>
						  
						  <div class="mb-3">
							<label class="form-label" for="productimage">Product Image</label>
							<input type="file" id="productimage" name="productimage" class="form-control" placeholder="" required>
						  </div>
						  <div class="mb-3">
							<label class="form-label" for="productstatus">Product Status</label>
							<select id="productstatus" name="productstatus" class="form-control" required>
							  <option value="">Choose an option</option>
							  <option value="0">In Active</option>
							  <option value="1">Active</option>
							</select>
						  </div>
						  <input type="hidden" id="productadddate" name="productadddate" class="form-control" value="<?php echo date("Y-m-d"); ?>" required>
						  <input type="hidden" id="productadduser" name="productadduser" class="form-control" value="<?php echo $pageid; ?>" required>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" name="NewProduct" class="btn btn-primary">Upload</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
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
						  <h5 class="card-header-title">Products</h5>
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
							<input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search Product" aria-label="Search Product">
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
								   "Product": [],
								   "search": "#datatableWithSearchInput",
								   "isResponsive": false,
								   "isShowPaging": true,
								   "pagination": "datatablePagination"
								 }'>
					  <thead class="thead-light">
					  <tr class="text-center">
						<th>Product ID</th>
						<th>Name</th>
						<th>Category</th>
						<th>Image</th>
						<th>Status</th>
						<th>Action</th>
					  </thead>

					  <tbody>
						<?php
							mysqli_set_charset ($dbc,'utf8');
							$productq = "SELECT * FROM tbl_products";
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
					  
					  <tr>
						<td class="text-center"><?php echo $productpi_id; ?></td>
						<td class="text-center"><?php echo $productp_name; ?></td>
						<td class="text-center"><?php echo $category_name; ?></td>
						
						<td class="text-center">
						  <div class="avatar avatar-lg avatar-4x3">
							  <img class="avatar-img" src="../uploads/<?php echo $pimg_name; ?>" alt="Image Description">
						  </div>
						</td>
						<td class="text-center">
							<?php 
							if ($product_status == "1") { ?>
							  <span class="badge bg-success">Active</span>
							<?php } else { ?>
							  <span class="badge bg-danger">In-Active</span>
							<?php }
							?>
						</td>
						<td>
						  <div class="btn-group" role="group">
							<a class="btn btn-white btn-sm" href="product-edit.php?product=<?php echo $productpi_id; ?>">
							  <i class="bi-pencil-fill me-1"></i> Edit
							</a>
							<!-- Button Group -->
							<div class="btn-group">
							  <button type="button" class="btn btn-white btn-icon btn-sm dropdown-toggle dropdown-toggle-empty" id="productsEditDropdown<?php echo $productpi_id; ?>" data-bs-toggle="dropdown" aria-expanded="false"></button>

							  <div class="dropdown-menu dropdown-end-end mt-1" aria-labelledby="productsEditDropdown<?php echo $productpi_id; ?>">
								<button  class="dropdown-item" data-bs-toggle="modal" data-bs-target="#productview<?php echo $productpi_id; ?>">
								  <i class="bi bi-eye dropdown-item-icon"></i> View
								</button>
								<a class="dropdown-item" href="product-image.php?product=<?php echo $productpi_id; ?>">
									<i class="bi-cloud-upload-fill dropdown-item-icon"></i> Manage Images
								</a>
								
								<?php 
								if ($product_status == "1") { ?>
								  <a class="dropdown-item" href="adminaction.php?unpublish=<?php echo $productpi_id; ?>">
									<i class="bi-x-lg dropdown-item-icon"></i> UnPublish
								  </a>
								<?php } else { ?>
								  <a class="dropdown-item" href="adminaction.php?publish=<?php echo $productpi_id; ?>">
									<i class="bi-upload dropdown-item-icon"></i> Publish
								  </a>
								<?php }
								?>
								
								
								
							  </div>
							</div>
							<!-- End Button Group -->
							<!-- Modal -->
								<div class="modal fade" id="productview<?php echo $productpi_id; ?>" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="staticBackdropLabel"><?php echo $productp_name; ?></h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									  </div>
									  <div class="modal-body">
										<div class="card">
											<div class="card-header">
												<h3 class="card-header-title">Product information</h3>
											</div>
											
											<div class="card-body">
												<div class="mb-4">
													<label class="form-label">Product Name</label>
													<input type="text" name="priceName" id="priceNameLabel" class="form-control" value="<?php echo $productp_name; ?>" disabled>
												</div>
												<div class="mb-4">
													<label class="form-label">Product Short Description</label>
													<textarea name="priceName" id="priceNameLabel" class="form-control" rows="4" disabled><?php echo $productp_product_shotdec; ?></textarea>
												</div>
												<div class="mb-4">
													<label class="form-label">Product Summery</label>
													<textarea name="priceName" id="priceNameLabel" class="form-control" rows="4" disabled><?php echo $product_summery; ?></textarea>
												</div>
												<div class="mb-4">
													<label class="form-label">Product Category</label>
													<input type="text" name="priceName" id="priceNameLabel" class="form-control" value="<?php echo $category_name; ?>" disabled>
												</div>
												<!-- Card -->
												<div class="card mb-3 mb-lg-5">
													<div class="card-body">
														<!-- Gallery -->
														  <div id="fancyboxGallery" class="js-fancybox row justify-content-sm-center gx-3">
															<?php
															mysqli_set_charset ($dbc,'utf8');
															$pimgq2 = "SELECT * FROM `tbl_productimage` WHERE `pimg_productid`='$productpi_id'";
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

																	
																	<!-- End Col -->
																  </div>
																  <!-- End Row -->
																</div>
																<!-- End Col -->
															  </div>
															  <!-- End Card -->
															</div>
															<!-- End Col -->
															<?php } ?>
														  </div>
												
													</div>
												</div>
											</div>
										</div>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
								<!-- End Modal -->
						  </div>
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