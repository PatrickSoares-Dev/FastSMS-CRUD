<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Campanhas</title>
</head>
<body>

    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">  
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Conta</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <h5 class="card-header">Informações pessoais</h5>
                        <hr class="my-0" />
                        <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                                <div class="row mt-4">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nome</label>
                                        <input class="form-control" type="text" id="firstName" name="firstName" disabled />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="motherName" class="form-label">Nome da Mãe</label>
                                        <input class="form-control" type="text" id="motherName" name="motherName" disabled />
                                    </div>
                                    <!-- Adicione outros campos conforme necessário -->
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input class="form-control" type="text" id="cpf" name="cpf" disabled/>
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                                        <input class="form-control" type="date" id="dataNascimento" name="dataNascimento" disabled />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select id="sexo" class="select2 form-select" disabled>
                                         <option value="Outros">Outros</option>
                                          <option value="Masculino">Masculino</option>
                                          <option value="Feminino">Feminino</option>
                                        </select>
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="tel" class="form-label">Telefone</label>
                                        <input class="form-control" type="text" id="tel" name="tel" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="cel" class="form-label">Celular</label>
                                        <input class="form-control" type="text" id="cel" name="cel" />
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="cep" class="form-label">Cep</label>
                                        <input class="form-control" type="text" id="cep" name="cep" />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="form-label" for="estado">Estado</label>
                                      <select id="estado" name="estado" class="select2 form-select">
                                          <option value="AC">Acre</option>
                                          <option value="AL">Alagoas</option>
                                          <option value="AP">Amapá</option>
                                          <option value="AM">Amazonas</option>
                                          <option value="BA">Bahia</option>
                                          <option value="CE">Ceará</option>
                                          <option value="DF">Distrito Federal</option>
                                          <option value="ES">Espírito Santo</option>
                                          <option value="GO">Goiás</option>
                                          <option value="MA">Maranhão</option>
                                          <option value="MT">Mato Grosso</option>
                                          <option value="MS">Mato Grosso do Sul</option>
                                          <option value="MG">Minas Gerais</option>
                                          <option value="PA">Pará</option>
                                          <option value="PB">Paraíba</option>
                                          <option value="PR">Paraná</option>
                                          <option value="PE">Pernambuco</option>
                                          <option value="PI">Piauí</option>
                                          <option value="RJ">Rio de Janeiro</option>
                                          <option value="RN">Rio Grande do Norte</option>
                                          <option value="RS">Rio Grande do Sul</option>
                                          <option value="RO">Rondônia</option>
                                          <option value="RR">Roraima</option>
                                          <option value="SC">Santa Catarina</option>
                                          <option value="SP">São Paulo</option>
                                          <option value="SE">Sergipe</option>
                                          <option value="TO">Tocantins</option>
                                      </select>
                                  </div>
                                                                                                         
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <input class="form-control" type="text" id="cidade" name="cidade" />
                                    </div>    
                                    <div class="mb-3 col-md-6">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input class="form-control" type="text" id="complemento" name="complemento" />
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input class="form-control" type="text" id="endereco" name="endereco" />
                                        
                                    </div>      
                                    <div class="mb-3 col-md-6">
                                        <label for="numeroEndereco" class="form-label">Nº</label>
                                        <input class="form-control" type="text" id="numeroEndereco" name="numeroEndereco" />
                                    </div>                                                                         
                                </div>                                
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="login" class="form-label">Login</label>
                                        <input class="form-control" type="text" id="login" name="login" />
                                    </div>                                       
                                </div>

                                <!-- Adicione mais divs com campos adicionais conforme necessário -->
                                <div class="mt-2 d-flex justify-content-end">
                                    <button type="reset" class="btn btn-outline-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary me-2">Salvar alterações</button>                                    
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
              </div>
            </div>
            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
      <span class="text-primary" id='id_user'><?php echo $_SESSION['user_id'];?></span>  

      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
  </body>

  <script src="assets\js\scripts_pages\Profile\profile.js"></script>
</html>




