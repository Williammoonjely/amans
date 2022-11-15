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
			<div class="card p-1">
				<div class="card-header">
					<div class="row justify-content-between align-items-center flex-grow-1">
						<div class="col-md">
							<h4 class="card-header-title">Order</h4>
						</div>
						<?php
						if(isset($_GET['order'])){
							$page_id2 = $_GET['order'];
						?>	
						<div class="col-auto float-end">
							<a class="btn btn-ghost-primary " href="order-download.php?order=<?php echo $page_id2; ?>">
								<i class="bi bi-cloud-download"></i>
							</a>
						</div>
						<?php } ?>
					</div>		
				</div>
				
				<div class="card-body">
					<div class="table-responsive datatable-custom">
					  <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
							 data-hs-datatables-options='{
									 "order": []
								   }'>
						<thead class="thead-light">
						<tr class="text-center">
						  <th>Product Image</th>
						  <th>Product Name</th>
						  <th>quantity</th>
						  
						</tr>
						</thead>

						<tbody>
						
						<?php
							mysqli_set_charset ($dbc,'utf8');
							if(isset($_GET['order'])){
							$page_id1 = $_GET['order'];
							$cartquery = "SELECT * FROM tbl_cart WHERE`cart_orderid`='$page_id1'";
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
							<div class="avatar avatar-lg avatar-4x3">
								<img class="avatar-img" src="../uploads/<?php echo $pimg_name; ?>" alt="Product">
							</div>
						  </td>
						  <td>
							<span class="d-block h5 mb-0"><?php echo $productp_name; ?></span>
						  </td>
						  <td><?php echo $cartqty; ?></td>
						  
						</tr>
						<?php }} ?>
						
						</tbody>
					  </table>
					</div>
				</div>
				<div class="card-footer">
					<p>
					The user <?php echo $user_name1; ?> created this order on <?php echo $cartorderplace; ?></div>				
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