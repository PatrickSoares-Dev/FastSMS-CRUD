<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>

    <div class="content">
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <?php if ($_SESSION['tipo_user'] === 'Admin'): ?>
                        <div class="col-lg-8 mb-4 order-0">                        
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                        <h5 class="card-title text-primary">Relatório de Administrador</h5>
                                            <p class="mb-4">
                                                Parabéns! Você atingiu um total de <span class="fw-bold" id="qtd_user"></span> usuários na sua plataforma Fast SMS.
                                            </p>

                                            <a href="users" class="btn btn-sm btn-outline-primary">Ver usuários</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img src="assets\img\illustrations\man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="assets\img\icons\unicons\chart-success.png" alt="chart success" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                    <a class="dropdown-item" href="users">Detalhes</a>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Usuários</span>
                                        <h3 class="card-title mb-1" id="qtd_userCard"></h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>% 20</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-start justify-content-between">
                                            <div class="avatar flex-shrink-0">
                                                <img src="assets\img\icons\unicons\wallet-info.png" alt="Credit Card" class="rounded" />
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                    <a class="dropdown-item" href="logs">Detalhes</a>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="fw-semibold d-block mb-1">Logs</span>
                                        <h3 class="card-title mb-1" id="qtd_logs"></h3>
                                        <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> % 15 </small>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    <?php else: ?>
                        <div class="col-lg-12 mb-4 order-0">
                            <h5 class="card-title text-default" style="font-size: 25px;">Bem-vindo, <span class="text-primary" style="text-transform: uppercase;"><?php echo $_SESSION['user_name']; ?></span></h5>    
                            <!-- <div class="card">
                                
                                <div class="card-body">                                    
                                    <!-- Conteúdo específico para usuários não-Admin -->
                                    <!-- <span class="fw-semibold d-block">Você agora pode utilizar de nossos serviços.</span>                                    
                                </div>
                            </div> -->
                        </div>
                    <?php endif; ?>                    
        </div>                    
</body>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="assets/js/scripts_pages/Dashboard/dashboard.js"></script>

</html>