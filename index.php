<head>
    <meta charset="utf-8">
    <title>Registre-se</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/css/register.css">
	
	<style>
		.nav-pills .nav-link.active, .nav-pills .nav-link.active:hover, .nav-pills .nav-link.active:focus{
			background-color: #0071c7;
		}
		body {
			min-height: 50vh;
			margin: 0;
			padding: 0;
			font-family: 'Public Sans', sans-serif;
		}

		.wrapper {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		#image-holder {
			background: url('assets/img/backgrounds/background-sms.png') no-repeat;
			height: 75vh;
			flex: 1;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		#image-holder img {
			display: block;
			max-width: 100%;
			max-height: 100%;
			height: auto;
			width: auto;
		}

		.user-tabe{
			min-width: 41rem;
		}
			
		.nav-align-top{
			min-width: 45rem;
			margin-right: 5rem;
		}

		form {
			width: 100%;
			height: 100%;
		}

		@media (max-width: 1600px) {
			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				background: url('assets/img/backgrounds/background-sms.png') no-repeat;
				height: 80vh;
				margin-left: 5rem;
				flex: 1;
				display: flex;
				align-items: center;
				justify-content: center;

			}
			.nav-align-top{
				min-width: 35rem;
				margin-right: 5rem;
			}

			.user-tabe{
				min-width: 31rem;
			}
		}	
		
		@media (max-width: 1300px) {

			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				background: url('assets/img/backgrounds/background-sms.png') no-repeat;
				height: 60vh;
				margin-left: 5rem;
				flex: 1;
				display: flex;
				align-items: center;
				justify-content: center;

			}
			.nav-align-top{
				min-width: 31rem;
				margin-right: 8rem;
			}

			.user-tabe{
				min-width: 21rem;
			}
		}	

		@media (max-width: 1024px;) {

			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				background: url('assets/img/backgrounds/background-sms.png') no-repeat;
				height: 60vh;
				margin-left: 5rem;
				flex: 1;
				display: flex;
				align-items: center;
				justify-content: center;

			}
			.nav-align-top{
				min-width: 30rem;
				margin-right: 9rem;
			}

		}		
		@media (max-width: 800px) {

			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				display: none;
			}
			.nav-align-top{
				
				display: flex;
				align-items: center;
				flex-direction: column;
				
			}
		}
		@media (max-width: 630px) {

			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				display: none;
			}
			.nav-align-top{
				margin-left: 10rem;
				
			}
		}

		@media (max-width: 500px) {

			form {
				width: 100%;
				height: 100%;
			}

			#image-holder {
				display: none;
			}
			.nav-align-top{
				margin-left: 10rem;
				min-width: 25rem;
				
			}
		}

		@media (max-width: 375px) {

			#image-holder {
				display: none;
			}
			.nav-align-top{
				min-width: 14rem;				
			}

			.nav-align-top .tab-content{
				min-width: 1rem;
			}
			
		}	
	</style>

</head>

<body>
	<div class="wrapper">
		<div class="image-holder">
			<img src="assets/img/backgrounds/background-sms.png" id="image-holder" alt="">
		</div>
		<div class="nav-align-top mb-4 mt-2">
			<!-- Navigation tabs -->
			<ul class="nav nav-pills mb-2 nav-fill" role="tablist" style="margin-right: 1.3rem;">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
						data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
						aria-selected="true">
						<i class="tf-icons bx bx-user"></i> Informações Pessoais
					</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
						data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
						aria-selected="false">
						<i class='bx bx-current-location'></i> Endereços
					</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
						data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
						aria-selected="false">
						<i class='bx bx-lock-alt'></i> Conta
					</button>
				</li>
			</ul>
			<!--/ Navigation tabs /-->

			 <!-- Form Informações Pessoais -->
			<div class="tab-content" style="margin-right: 20px ; margin-top: 10px;">
				<div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
					<form action="">
						<div class="mb-3">
							<label class="form-label" for="basic-icon-default-fullname">Nome Completo</label>
							<div class="input-group input-group-merge">
								<span id="basic-icon-default-fullname2" class="input-group-text"><i
										class="bx bx-user"></i></span>
								<input type="text" class="form-control" id="input_nome"
									placeholder="Patrick Oliveira" aria-label="Patrick Oliveira"
									aria-describedby="input_nome" />
							</div>
						</div>
						<div class="mb-3">

							<label class="form-label" for="basic-icon-default-fullname">Nome Materno</label>
							<div class="input-group input-group-merge">
								<span id="basic-icon-default-fullname2" class="input-group-text"><i
										class="bx bx-user"></i></span>
								<input type="text" class="form-control" id="input_mae"
									placeholder="Maria Da Silva" aria-label="Maria Da Silva"
									aria-describedby="input_mae" />
							</div>

						</div>
						<div class="row">
							<div class="mb-3 col-lg-6 col-md-12 col-sm-12">

								<label class="form-label" for="basic-icon-default-company">CPF</label>
								<div class="input-group input-group-merge">
									
									<span id="basic-icon-default-company2" class="input-group-text"><i
											class="bx bxs-user-rectangle"></i></span>
									<input type="text" id="input_cpf" class="form-control"
										placeholder="111.222.333-44" aria-label="111.222.333-44"
										aria-describedby="input_cpf" />
								</div>

							</div>
							<div class="mb-3 col-lg-6 col-md-12 col-sm-12">

								<label for="select_sexo" class="form-label">Sexo</label>
								<select id="select_sexo" class="form-select">
									<option disabled selected>Selecione</option>
									<option value="1">Masculino</option>
									<option value="2">Feminino</option>
									<option value="3">Outros</option>
								</select>

							</div>
						</div>
						<div class="row">
							
							<div class="mb-3 col-lg-6 col-md-12 col-sm-12">
								<label class="form-label" for="input_dataNascimento">Data de nascimento</label>
								<div class="input-group input-group-merge"> 
									<input class="form-control" type="date" value="" id="input_dataNascimento" />
								</div>
							</div>

							<div class="mb-3 col-lg-6 col-md-12 col-sm-12">
								<label class="form-label" for="basic-icon-default-phone">Telefone</label>
								<div class="input-group input-group-merge">
									<span id="basic-icon-default-phone2" class="input-group-text"><i
											class="bx bx-phone"></i></span>
									<input type="text" id="input_tel" class="form-control phone-mask"
										placeholder="(21) 11111-2222" aria-label="(21) 11111-2222"
										aria-describedby="input_tel" />
								</div>
							</div>
						</div>

						<button type="button" class="btn btn-primary w-100 mt-2" id="btnEtapa1">Próxima etapa</button>
					</form>
					<p class="text-center" style="margin-top: 15px; margin-bottom: -10px;">
						<span>Já tem uma conta?</span>
						<a href="auth-login-basic.html">
							<span>Faça login</span>
						</a>
					</p>
				</div>
				<div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">

					<form action="">
						<div class="row">
							<div class="mb-3 col-sm-8 col-md-8 col-lg-8">
								<label class="form-label" for="basic-icon-default-fullname">CEP</label>
								<div class="input-group input-group-merge">
									<span id="basic-icon-default-fullname2" class="input-group-text"><i
											class='bx bx-current-location'></i></span>
									<input type="text" class="form-control" id="input_cep"
										placeholder="12345-678" aria-label="12345"
										aria-describedby="input_cep" />
								</div>
							</div>
							
							<div class="mb-3 col-sm-4 col-md-4 col-lg-4">
								<label for="select_estado" class="form-label">Estado</label>
								<select id="select_estado" class="form-select">
									<option disabled selected>UF</option>
									<option value="1">RJ</option>
									<option value="2">SP</option>
									<option value="3">MG</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="mb-3 col-sm-8 col-md-8 col-lg-8">
								<label class="form-label" for="input_cidade">Cidade</label>
								<div class="input-group input-group-merge">
									<span id="basic-icon-default-company2" class="input-group-text"><i
											class='bx bxs-city'></i></span>
									<input type="text" id="input_cidade" class="form-control"
										placeholder="Rio de Janeiro" aria-label="Rio de Janeiro"
										aria-describedby="input_cidade" />
								</div>
							</div>
							<div class="mb-3 col-sm-4 col-md-4 col-lg-4">
								<label class="form-label" for="input_numeroEndereco">Número</label>
								<div class="input-group input-group-merge">
									<span id="basic-icon-default-bx-buildings" class="input-group-text"><i
											class='bx bx-buildings'></i></span>
									<input type="text" class="form-control" id="input_numeroEndereco"
										placeholder="N°" aria-label="N°"
										aria-describedby="input_numeroEndereco" />
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label for="text_endereco" class="form-label">Endereço</label>
							<div class="input-group">
								<textarea class="form-control" id="text_endereco" rows="2"></textarea>
							</div>						
						</div>
						<div class="mb-3">
							<label class="form-label" for="input_complemento">Complemento</label>
							<div class="input-group input-group-merge">
								<span id="basic-icon-default-fullname2" class="input-group-text"><i
										class='bx bxs-home'></i></span>
								<input type="text" class="form-control" id="input_complemento"
									placeholder="Complemento (apartamento, bloco, etc.)" aria-label="N°"
									aria-describedby="input_complemento" />
							</div>
						</div>
						
						<button type="button" class="btn btn-primary w-100 mt-2" id="btnEtapa2">Próxima etapa</button>
					</form>
					<p class="text-center" style="margin-top: 15px; margin-bottom: -10px;">
						<span>Já tem uma conta?</span>
						<a href="auth-login-basic.html">
							<span>Faça login</span>
						</a>
					</p>

				</div>
				<div class="tab-pane fade user-tabe" id="navs-pills-justified-messages" role="tabpanel" style="width: 27rem;">
					<div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">

						<form action="" style="">
							<div class="mb-3">
								<label class="form-label" for="input_email">Email</label>
								<div class="input-group input-group-merge">
									<input type="text" class="form-control" placeholder="patrick.oliveira"
										aria-label="patrick.oliveira" aria-describedby="input_email" id="input_email" />
									<span class="input-group-text" id="basic-addon33">@example.com</span>
								</div>
							</div>

							<div class="mb-3">
								<label class="form-label" for="input_celular">Celular</label>
								<div class="input-group input-group-merge">
									<span id="basic-icon-default-phone2" class="input-group-text"><i
											class="bx bx-phone"></i></span>
									<input type="text" id="input_celular" class="form-control phone-mask"
										placeholder="(21) 11111-2222" aria-label="(21) 11111-2222"
										aria-describedby="input_celular" />
								</div>
							</div>
							<div class="mb-3">
								<div class="form-password-toggle">
									<label class="form-label" for="input_senha">Senha</label>
									<div class="input-group input-group-merge">
										<input type="password" class="form-control" id="input_senha"
											placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
											aria-describedby="input_senha" autocomplete="new-password" />
										<span class="input-group-text cursor-pointer" id="basic-default-password"><i
												class="bx bx-hide"></i></span>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<div class="form-password-toggle">
									<label class="form-label" for="input_csenha">Confirmar senha</label>
									<div class="input-group input-group-merge">
										<input type="password" class="form-control" id="input_csenha"
											placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
											aria-describedby="input_csenha" />
										<span class="input-group-text cursor-pointer" id="basic-default-password"><i
												class="bx bx-hide"></i></span>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" id="terms-conditions"
										name="terms" />
									<label class="form-check-label" for="terms-conditions">
										Eu aceito os
										<a href="javascript:void(0);">termos de privacidade</a>
									</label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary w-100 mt-1" id="btnSubmitForm">Finalizar Cadastro</button>
						</form>
						<p class="text-center" style="margin-top: 15px; margin-bottom: -10px;">
							<span>Já tem uma conta?</span>
							<a href="auth-login-basic.html">
								<span>Faça login</span>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	
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
	<script src="assets/js/scripts_pages/register.js"></script>
	<script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>