<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container-sm mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="authentication-wrapper authentication-basic container-p-y">
                    <div class="authentication-inner py-4">
                        <!-- Forgot Password -->
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-2">Esqueceu a senha? 🔒</h4>
                                <p class="mb-4">Digite seu e-mail e enviaremos instruções para redefinir sua senha.</p>
                                <form id="formAuthentication" class="mb-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            placeholder="Insira seu e-mail"
                                            autofocus
                                        />
                                    </div>
                                    <button id="btnSendEmail" class="btn btn-primary d-grid w-100">Redefinir senha</button>
                                </form>
                                <div id="errorDisplay" class="text-danger"></div> <!-- Elemento para exibir erros -->
                                <div class="text-center">
                                    <a href="login" class="d-flex align-items-center justify-content-center">
                                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                        Voltar para login
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /Forgot Password -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="assets/js/scripts_pages/Forgot/forgot.js"></script>
</body>
</html>
