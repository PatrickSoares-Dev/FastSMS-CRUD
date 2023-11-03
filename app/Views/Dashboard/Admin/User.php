<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
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
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Nome da Mãe</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Data de Nascimento</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                        <td>1</td>
                        <td>Albert Cook</td>
                        <td>Lilian Fuller</td>
                        <td>123.456.789-00</td>
                        <td>albert@example.com</td>
                        <td>1980-01-15</td>
                        <td class="text-center"><button type="button" class="btn btn-primary">Detalhes</button></td>
                        </tr>
                        <tr>
                        <td>2</td>
                        <td>Barry Hunter</td>
                        <td>Sophia Wilkerson</td>
                        <td>987.654.321-00</td>
                        <td>barry@example.com</td>
                        <td>1975-07-20</td>
                        <td class="text-center"><button type="button" class="btn btn-primary">Detalhes</button></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>


            </div>
            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
  </body>

</html>
