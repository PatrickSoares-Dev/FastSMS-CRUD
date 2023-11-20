<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>

    <link rel="stylesheet" href="assets\css\dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets\vendor\css\data_tables_editor\editor.bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\vendor\css\buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets\vendor\css\dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets\vendor\css\editor.dataTables.min.css">
    <link rel="stylesheet" href="assets\vendor\css\font-awesome.min.css">
    <link rel="stylesheet" href="assets\vendor\css\jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets\vendor\css\select.dataTables.min.css">
 
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">  
          <div class="content-wrapper">            
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Lista de usuários</h4>

              <div class="card mb-4">
                <h5 class="card-header">Filtro de usuários</h5>
                <div class="card-body">
                  <div class="row gx-3 gy-2 align-items-center">
                    <div class="col-md-3">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Nome</label>
                            <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="Patrick Oliveira"
                            aria-describedby="defaultFormControlHelp"
                            />
                      </div>
                    </div>
                    <div class="col-md-2">

                        <label for="defaultSelect" class="form-label">UF</label>
                        <select id="defaultSelect" class="form-select">
                        <option>RJ</option>
                        <option value="1">RJ</option>
                        <option value="2">SP</option>
                        <option value="3">MG</option>
                        </select>

                    </div>
                    
                    <div class="col-md-3">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Cidade</label>
                            <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="Rio de Janeiro"
                            aria-describedby="defaultFormControlHelp"
                            />
                      </div>
                    </div>
                    <div class="col-md-2 float-right">
                        <label class="form-label" for="showToastPlacement">&nbsp;</label>
                        <button id="showToastPlacement" class="btn btn-primary d-block">Buscar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card mb-4">
                <h5 class="card-header">Usuários</h5>     
                <div class="table-responsive text-nowrap">
                <table id="TableUsers" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nome da Mãe</th>
                            <th>Email</th>
                            <th>Data de Nascimento</th>
                            <th>CPF</th>
                            <th>CEP</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                </div>
            </div>


            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>
          
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>  
</div>


<div class="modal fade" id="userCreateModal" tabindex="-1" aria-labelledby="userCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-4">
                    <h5 class="" id="tittleUser">Criar novo usuário</h5>
                    <div class="card-body">
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                                <div class="row mt-4">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Nome</label>
                                        <div class="input-group input-group-merge">
                                          <input class="form-control" type="text" id="firstName" name="firstName" />                                                      
                                        </div>                                                             
                                    </div>
                                    <div class="mb-3 col-md-6">                                      
                                        <label for="motherName" class="form-label">Nome da Mãe</label>
                                        <div class="input-group input-group-merge">
                                          <input class="form-control" type="text" id="motherName" name="motherName" />
                                      </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group input-group-merge">
                                          <input class="form-control" type="text" id="email" name="email" />
                                        </div>                                        
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <div class="input-group input-group-merge">
                                          <input class="form-control" type="text" id="cpf" name="cpf"/>  
                                        </div>                                        
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                                        <div class="input-group input-group-merge">                                          
                                          <input class="form-control" type="date" id="dataNascimento" name="dataNascimento" />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <div class="input-group input-group-merge">  
                                          <select id="sexo" class="select2 form-select">
                                            <option disabled selected>Selecione</option>
                                            <option value="Outros">Outros</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Feminino">Feminino</option>
                                          </select>
                                        </div>             
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="tel" class="form-label">Telefone</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="tel" name="tel" />
                                        </div>                                        
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="cel" class="form-label">Celular</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="cel" name="cel" />
                                        </div>                                       
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="cep" class="form-label">Cep</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="cep" name="cep" />
                                        </div>                                        
                                    </div>

                                    <div class="mb-3 col-md-6">
                                      <label class="form-label" for="estado">Estado</label>
                                      <div class="input-group input-group-merge">  
                                        <select id="estado" name="estado" class="select2 form-select">
                                            <option disabled selected>UF</option>
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
                                                                                                         
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="cidade" class="form-label">Cidade</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="cidade" name="cidade" />
                                        </div>                                        
                                    </div>    
                                    <div class="mb-3 col-md-6">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="complemento" name="complemento" />
                                        </div>                                        
                                    </div>                                          
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="endereco" name="endereco" />
                                        </div>
                                                                                
                                    </div>      
                                    <div class="mb-3 col-md-6">
                                        <label for="numeroEndereco" class="form-label">Nº</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="numeroEndereco" name="numeroEndereco" />
                                        </div>                                        
                                    </div>                                                                         
                                </div>                                 
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="login" class="form-label">Login</label>
                                        <div class="input-group input-group-merge">  
                                          <input class="form-control" type="text" id="login" name="login" />
                                        </div>
                                        
                                    </div>                                    
                                    <div class="mb-3 col-md-6">
                                      <label for="login" class="form-label">Tipo_user</label>
                                      <div class="input-group input-group-merge">  
                                        <select id="tipo_user" name="tipo_user" class="select2 form-select">
                                          <option disabled selected value='Selecione'> Selecione </option>
                                          <option value="User">User</option>
                                          <option value="Admin">Admin</option>
                                        </select>
                                      </div>
                                      
                                    </div>                                          
                                </div>

                                <div class="row">
                                    <div class="mb-3 col-md-6">                                      
                                        <label for="password" class="form-label">Senha</label>
                                        <div class="input-group input-group-merge"> 
                                        <input class="form-control" type="password" id="inputSenha" name="inputSenha" />
                                      </div>                                        
                                    </div>                                    
                                    <div class="mb-3 col-md-6">                                      
                                      <label for="login" class="form-label">Confirme sua senha</label>
                                      <div class="input-group input-group-merge"> 
                                        <input class="form-control" type="password" id="cpassword" name="cpassword" />  
                                      </div>                                      
                                    </div>                                          
                                </div>

                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary me-2" id='btnCreateUser'>Criar usuário</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="userDetailsModal" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-4">
                    <h5 class="" id="tittleUser">Usuário</h5>
                    <div class="card-body">
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
                                        <input class="form-control" type="date" id="dataNascimento" name="dataNascimento" />
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
                                    <div class="mb-3 col-md-6">
                                      <label for="login" class="form-label">Tipo_user</label>
                                      <select id="tipo_user" name="tipo_user" class="select2 form-select">
                                        <option value="User">User</option>
                                        <option value="Admin">Admin</option>
                                      </select>
                                    </div>                                          
                                </div>
                                <!-- Adicione mais divs com campos adicionais conforme necessário -->
                                <div class="mt-2">
                                    <button type="button" class="btn btn-primary me-2">Salvar alterações</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Excluir usuário - <span id="userNameToDelete"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Você deseja excluir o usuário <span id="userToDelete"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir usuário</button>
            </div>
        </div>
    </div>
</div>

</body>
 
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="assets\js\datatables.min.js"></script>
  <script src="assets\vendor\js\data_tables_editor\dataTables.editor.min.js"></script>
  <script src="assets\js\dataTables.dateTime.min.js"></script>
  <script src="assets\js\scripts_pages\Admin\user.js"></script>
</html>


<!-- <div id="successToast" class="bs-toast toast fade bg-success" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Sucesso</div>
          <small>11 mins ago</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
          Toast de sucesso: ação realizada com êxito.
      </div>
  </div>

  <div id="errorToast" class="bs-toast toast fade bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
          <i class="bx bx-bell me-2"></i>
          <div class="me-auto fw-semibold">Erro</div>
          <small>11 mins ago</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
          Toast de erro: algo deu errado.
      </div>
  </div> -->