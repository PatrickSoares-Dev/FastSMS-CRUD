<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <a href="dashboard">
            <div class="menu-logo">
              <img src="assets\img\logo-sms.png" class="img-fluid" alt="Logo" />
            </div>
          </a>
          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Layouts">Admin</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="users" class="menu-link">
                    <div data-i18n="Without menu">Usuários</div>
                  </a>
                </li>  
                <li class="menu-item">
                  <a href="logs" class="menu-link">
                    <div data-i18n="Without menu">Logs</div>
                  </a>
                </li>    
                <li class="menu-item">
                  <a href="bd" class="menu-link">
                    <div data-i18n="Without menu">Banco de dados</div>
                  </a>
                </li>            
              </ul>          
            </li>

            <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Serviços</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-message-square-detail"></i> <!-- Ícone relacionado a SMS -->
                    <div data-i18n="Gerenciar Campanhas">Campanhas</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="campanha" class="menu-link">
                            <div data-i18n="Enviar SMS">Enviar SMS</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="history" class="menu-link">
                            <div data-i18n="Notifications">Histórico</div>
                        </a>
                    </li>
                </ul>
            </li>
                  
        </aside>

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                
              <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets\img\icons\1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets\img\icons\1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">Patrick Oliveira</span>
                            <small class="text-muted">User</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">

              <?php
                if ($currentPage === 'dashboard') {
                    require_once "app/Views/Dashboard/Dashboard.php";        
                } else if ($currentPage === 'users') {
                    require_once "app\Views\Dashboard\Admin\User.php";
                    
                }else if ($currentPage === 'logs') {
                  require_once "app\Views\Dashboard\Admin\Logs.php";
                  
                }else if ($currentPage === 'bd') {
                  require_once "app\Views\Dashboard\Admin\BancoDeDados.php";
                  
                }else if ($currentPage === 'campanha') {
                  require_once "app\Views\Dashboard\Campanha\CampanhaSMS.php";
                  
                }else if ($currentPage === 'history') {
                  require_once "app\Views\Dashboard\Campanha\HistoricoCampanha.php";
                  
              } else {
                    require_once "app\Views\Shared\Error.php";
                }
              ?>

            </div>            
          </div>

        </div>

      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"></script>
  <script>
      $(document).ready(function(){
        $('.menu-toggle').click(function(){
          $(this).next('.menu-sub').slideToggle();
        });
      });
    </script>

  <script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/jquery.form-validator.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/vendor/libs/jquery/jquery.js"></script>
	<script src="assets/vendor/libs/popper/popper.js"></script>
	<script src="assets/vendor/js/bootstrap.js"></script>
	<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.0.5/imask.min.js"></script>	
	<script src="assets/vendor/js/menu.js"></script>
	<script src="assets/js/main.js"></script>
	<script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>