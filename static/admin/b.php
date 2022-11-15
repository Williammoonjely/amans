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
        <div class="col-lg-10">
          
		  
		  
		  
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