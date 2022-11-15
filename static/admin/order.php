<?php include('config/db.php')?>
<?php include('config/dbc.php')?>
<?php include("config/user.php");?>
<?php include('config/function.php')?>
<?php include('config/setup.php')?>
<?php include('config/session.php')?>
<?php $pagename = "Dashboard";?>
<?php $ip_add = getenv("REMOTE_ADDR"); ?>
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
<?php $ip_add = getenv("REMOTE_ADDR"); ?>

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
				<h1 class="page-header-title">Orders</h1>
			  </div>
			  <!-- End Col -->

			  <div class="col-auto">
				<a class="btn btn-primary" href="javascript:;" data-bs-toggle="modal" data-bs-target="#inviteUserModal">
				  <i class="bi-plus-circle me-1"></i> New Order
				</a>
			  </div>
			  <!-- End Col -->
			</div>
			<!-- End Row -->
		  </div>
		<!-- End Page Header -->
      <div class="row justify-content-sm-center text-center">
        <div class="col-sm-12 col-md-12 col-lg-12">
			<div class="card">
			  <!-- Header -->
			  <div class="card-header">
				<div class="row justify-content-between align-items-center flex-grow-1">
				  <div class="col-12 col-md">
					<div class="d-flex justify-content-between align-items-center">
					  <h5 class="card-header-title">Orders</h5>
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
						<input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search Orders" aria-label="Search Orders">
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
							   "isShowPaging": false,
							   "pagination": "datatableWithSearchPagination"
							 }'>
				  <thead class="thead-light">
				  <tr>
					<th>User</th>
					<th>Order Id</th>
					<th>Order Placed</th>
					<th>Order Status</th>
					
				  </thead>

				  <tbody>
					<?php
						mysqli_set_charset ($dbc,'utf8');
						$cartquery = "SELECT * FROM tbl_cart WHERE`cart_status`=0 GROUP BY`cart_orderid`;";
						$cartrun = mysqli_query($dbc, $cartquery);
						while($cartrow=mysqli_fetch_assoc($cartrun)){
						$cartid 			= mysqli_real_escape_string($dbc, $cartrow['cart_id']);
						$cartproductid 		= mysqli_real_escape_string($dbc, $cartrow['cart_productid']);
						$cartuserid			= mysqli_real_escape_string($dbc, $cartrow['cart_userid']);
						$cartqty 			= mysqli_real_escape_string($dbc, $cartrow['cart_qty']);
						$cartorderstatus	= mysqli_real_escape_string($dbc, $cartrow['cart_orderstatus']);
						$cartorderid		= mysqli_real_escape_string($dbc, $cartrow['cart_orderid']);
						$cartorderplace		= mysqli_real_escape_string($dbc, $cartrow['cart_orderplace']);
						
						mysqli_set_charset ($dbc,'utf8');
						$productq = "SELECT * FROM tbl_products WHERE product_id='$cartproductid'";
						$productrun = mysqli_query($dbc, $productq);
						while($productrow=mysqli_fetch_assoc($productrun)){
						$productpi_id 				= mysqli_real_escape_string($dbc, $productrow['product_id']);
						$productp_name	 			= mysqli_real_escape_string($dbc, $productrow['product_name']);
						$productp_product_shotdec	= mysqli_real_escape_string($dbc, $productrow['product_shotdec']);
						}
						mysqli_set_charset ($dbc,'utf8');
						$pimgq = "SELECT * FROM `tbl_productimage` WHERE `pimg_productid`='$productpi_id'";
						$pimgrun = mysqli_query($dbc, $pimgq);
						while($pimgrow=mysqli_fetch_assoc($pimgrun)){
							$pimg_id  		= $pimgrow['pimg_id'];
							$pimg_name 		= $pimgrow['pimg_name'];
							$pimg_productid = $pimgrow['pimg_productid'];
						}
						mysqli_set_charset ($dbc,'utf8');
						$userq1 = "SELECT * FROM `tbl_users` WHERE `user_id`='$cartuserid'";
						$userrun1 = mysqli_query($dbc, $userq1);
						while($userrow1=mysqli_fetch_assoc($userrun1)){
							$user_id1  		= $userrow1['user_id'];
							$user_name1 	= $userrow1['user_name'];
							$user_image1	= $userrow1['user_image'];
						}						
					?>
				  
				  <tr class="text-center">
					<td>
					  <a class="d-flex align-items-center" href="users-view?user=<?php echo $cartuserid; ?>">
						<div class="avatar avatar-circle">
						  <img class="avatar-img" src="../uploads/<?php echo $user_image1; ?>" alt="Image Description">
						</div>
						<div class="ms-3">
						  <span class="d-block h5 text-inherit mb-0"><?php echo $user_name1; ?></span>
						</div>
					  </a>
					</td>
					<td>
					  <a class="d-flex align-items-center" href="order-view.php?order=<?php echo $cartorderid; ?>">
						<span class="d-block h5 mb-0"><?php echo $cartorderid; ?></span>
					  </a>	
					</td>
					<td><?php echo $cartorderplace; ?></td>
					<td>
					  <span class="legend-indicator bg-success"></span>Active
					</td>
					<!-- <td class="text-center">
						<a class="btn btn-soft-info" href="order-view?user=<?php echo $cartuserid; ?>">
							<i class="bi bi-cloud-download"></i>
						</a>	
					</td> --> 
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
                <span id="datatableWithPaginationInfoTotalQty"></span>
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
      <!-- End Row -->
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
  <script src="./assets/js/hs.datatable.js"></script>

<script>
  (function () {
    // INITIALIZATION OF DATATABLES
    // =======================================================
    HSCore.components.HSDatatables.init('.js-datatable')
  })()
</script>
</body>

</html>