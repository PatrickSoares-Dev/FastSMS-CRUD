<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="container-xl mt-5"> <!-- Adicione uma margem superior (mt-5) para centralizar verticalmente -->
    <div class="row justify-content-center"> <!-- Centralize horizontalmente -->
        <div class="col-md-6"> <!-- Defina o tamanho do container, por exemplo, col-md-6 -->
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-2">Bem-vindo ao Fast SMS</h4>
                            <p class="mb-4">Faça login na sua conta e comece as suas campanhas</p>
                            <!-- Seu formulário aqui -->

                            <div id="error-message" class="alert alert-danger" style="display: none; text-align: center;"></div>
                            <div id="confirm-message" class="alert alert-primary" style="display: none; text-align: center;"></div>
                            <div id="success-message" class="alert alert-success" style="display: none; text-align: center;"></div>

                            <form id="formAuthentication" class="mb-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email ou Login</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="email"
                                        name="email-username"
                                        placeholder="Insira seu Email ou Login"
                                        autofocus
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Senha</label>
                                    <a href="forgot">
                                    <small>Esqueceu sua senha?</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                    autocomplete="off"
                                    />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me"> Lembrar senha </label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" type="button" id='btnLogin'>Login</button>
                                </div>

                            </form>
                            <p class="text-center">
                                <span>Novo na plataforma?</span>
                                <a href="register">
                                    <span>Criar uma conta.</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Login -->

                    <!-- Modal -->
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">                              
                                <h5 class="modal-title" id="exampleModalLabel1">Pergunta de segurança</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                              <div id="error-messageModal" class="alert alert-danger" style="display: none; text-align: center;"></div>
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameBasic" class="form-label"></label>
                                    <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name" />
                                  </div>
                                </div>
                                <div id="divButton" style="display: flex;justify-content: flex-end;">
                                    <button type="button" class="btn btn-primary" id="btntwofa">Confirmar</button>
                                </div>                          
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/scripts_pages/Login/login.js"></script>

</body>
</html>
