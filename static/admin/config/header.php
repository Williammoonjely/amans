<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
      <!-- Logo -->
      <a class="navbar-brand" href="../index.php" aria-label="Front">
        <img class="navbar-brand-logo" src="../uploads/<?php echo $logoname; ?>" alt="Logo" style="height:50px; width:50px;" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo" src="../uploads/<?php echo $logoname; ?>" alt="Logo" style="height:50px; width:50px;" data-hs-theme-appearance="dark">
        <img class="navbar-brand-logo-mini" src="../uploads/<?php echo $logoname; ?>" alt="Logo" style="height:50px; width:50px;" data-hs-theme-appearance="default">
        <img class="navbar-brand-logo-mini" src="../uploads/<?php echo $logoname; ?>" alt="Logo" style="height:50px; width:50px;" data-hs-theme-appearance="dark">
      </a>
      <!-- End Logo -->

      <div class="navbar-nav-wrap-content-start">
        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->

        
      </div>

      <div class="navbar-nav-wrap-content-end">
        <!-- Navbar -->
        <ul class="navbar-nav">
          
            
          </li>

          <li class="nav-item d-none d-sm-inline-block">
            
          </li>

          <li class="nav-item d-none d-sm-inline-block">
            
          </li>

          <li class="nav-item">
            <!-- Account -->
            <div class="dropdown">
              <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                <div class="avatar avatar-sm avatar-circle">
                  <img class="avatar-img" src="../uploads/<?php echo $page['user_image']; ?>" alt="Image Description">
                  <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                </div>
              </a>

              <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                <div class="dropdown-item-text">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm avatar-circle">
                      <img class="avatar-img" src="../uploads/<?php echo $page['user_image']; ?>" alt="Image Description">
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <h5 class="mb-0"><?php echo $page['user_name']; ?></h5>
                      <p class="card-text text-body"><?php echo $page['user_email']; ?></p>
                    </div>
                  </div>
                </div>

                <div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Profile &amp; account</a>
                <div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.php">Sign out</a>
              </div>
            </div>
            <!-- End Account -->
          </li>
        </ul>
        <!-- End Navbar -->
      </div>
    </div>
  </header>