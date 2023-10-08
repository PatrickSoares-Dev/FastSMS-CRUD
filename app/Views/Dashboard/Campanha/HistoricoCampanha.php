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
              <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Campanhas /</span> Histórico de Campanhas</h4>

              <div class="card mb-4">
                <h5 class="card-header">Histórico</h5>
                <div class="card-body">
                  <div class="row gx-3 gy-2 align-items-center">
                  <div class="col-md-2">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Nome Campanha</label>
                            <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="Nome Campanha"
                            aria-describedby="defaultFormControlHelp"
                            />
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div>
                            <label for="defaultFormControlInput" class="form-label">Número</label>
                            <input
                            type="text"
                            class="form-control"
                            id="defaultFormControlInput"
                            placeholder="Patrick Oliveira"
                            aria-describedby="defaultFormControlHelp"
                            />
                      </div>
                    </div>
                    <div class="col-md-2" style="margin-top: -1px;">

                        <label for="html5-date-input" class="col-md-6 col-form-label">Data inicial</label>
                        <div class="col-md-12">
                        <input class="form-control" type="date" value="2023-06-18" id="html5-date-input" />
                        </div>
                
                    </div>    
                    <div class="col-md-2" style="margin-top: -1px;">

                        <label for="html5-date-input" class="col-md-6 col-form-label">Data final</label>
                        <div class="col-md-12">
                        <input class="form-control" type="date" value="2023-06-18" id="html5-date-input" />
                        </div>

                    </div>                              
                    <div class="col-md-2 float-right" style="margin-top: -1px;">
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
                        <th>ID Campanha</th>
                        <th>Data</th>   
                        <th>Nome Campanha</th>             
                        <th>Quantidade de números</th>  
                        <th>Taxa de Conversão Sim</th>  
                        <th>Taxa de Conversão Não</th>                                           
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                        <td>1</td>
                        <td>08/10/2023 20:50</td>
                        <td>Promoção IFood</td> 
                        <td>100</td>        
                        <td>94</td>  
                        <td>6</td>                                
                        </tr>
                        <tr>
                        <td>1</td>
                        <td>08/10/2023 20:50</td>
                        <td>Promoção IFood</td> 
                        <td>100</td>        
                        <td>94</td>  
                        <td>6</td>                                
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
