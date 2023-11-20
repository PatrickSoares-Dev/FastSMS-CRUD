<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>

    
    <link rel="stylesheet" href="assets\css\dataTables.dateTime.min.css">
    <link rel="stylesheet" href="assets\vendor\css\data_tables_editor\editor.bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets\css\style.css">
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
              <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Lista de registros</h4>              

              <div class="card mb-4">
                <h5 class="card-header">Relatório de logs</h5>     
                <div class="table-responsive text-nowrap">
                  <table id="TableLogs" class="display" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th></th>
                              <th>ID</th>
                              <th>Email Usuário</th>
                              <th>Ação</th>
                              <th>Descrição Log</th>
                              <th>Data log</th>
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

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <div class="modal fade" id="deleteLogsModal" tabindex="-1" aria-labelledby="deleteLogsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLogsModalLabel">Excluir registro<span id="logToDelete"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body deleteModal">
                    <p>Você deseja excluir o registro: <span id="userToDelete"></span>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- / Layout wrapper -->
  </body>

  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="assets\js\datatables.min.js"></script>
  <script src="assets\vendor\js\data_tables_editor\dataTables.editor.min.js"></script>
  <script src="assets\js\dataTables.dateTime.min.js"></script>
  <script src="assets\js\scripts_pages\Admin\logs.js"></script>

</html>
