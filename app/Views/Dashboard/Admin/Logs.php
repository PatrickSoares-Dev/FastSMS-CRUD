<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">  
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Lista de logs</h4>

              <div class="card mb-4">
                <h5 class="card-header">Logs</h5>
                <div class="card-body">
                  <div class="row gx-3 gy-2 align-items-center">
                  <div class="col-md-2">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Id</label>
                            <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="ID Usuário"
                            aria-describedby="defaultFormControlHelp"
                            />
                      </div>
                    </div>
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
                    <div class="col-md-3" style="margin-top: -1px;">

                        <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-12">
                        <input class="form-control" type="date" value="2023-06-18" id="html5-date-input" />
                        </div>
                
                    </div>                                
                    <div class="col-md-2 float-right">
                        <label class="form-label" for="showToastPlacement">&nbsp;</label>
                        <button id="showToastPlacement" class="btn btn-primary d-block">Filtrar</button>
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
                        <th>Email</th>  
                        <th>Acessado em</th>                  
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                        <td>1</td>
                        <td>Patrick Soares de Oliveira</td> 
                        <td>patrick.oliveira@gmail.com</td>        
                        <td>08/10/2023 20:50</td>
                        </tr>
                        <tr>
                        <td>2</td>
                        <td>Patrick Soares de Oliveira</td> 
                        <td>patrick.oliveira@gmail.com</td>        
                        <td>08/10/2023 20:50</td>
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
