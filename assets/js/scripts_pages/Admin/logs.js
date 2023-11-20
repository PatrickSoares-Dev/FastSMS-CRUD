document.addEventListener('DOMContentLoaded', function () {
    function getLogs() {
        $.ajax({
            url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/getAllLogs',
            type: 'GET',
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                if (data.status === "success") {
                    const logsData = data.data.data.map(log => ({
                        DT_RowId: log.id, 
                        ...log 
                    }));

                    initDataTable(logsData);
                } else {
                    console.error('Erro ao buscar logs:', data.message);
                }
            },
            error: function (error) {
                console.error('Erro ao buscar logs:', error);
            }
        });
    }

    function deleteUser(logId) {        
        $.ajax({
            url: `http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/deleteLog?id=${logId}`,
            type: 'POST',
            success: function (response) {
                if (response.status === 'success') {
                    showToast('success', `Registro ${logId} excluído com sucesso.`);
                    $('#deleteLogsModal').modal('hide');
                    setTimeout(function() {
                        location.reload(); // Recarrega a página após 3 segundos
                    }, 3000);
            
                } else {
                    showToast('error', `Erro ao excluir registro ${logId}.`);
                    $('#deleteLogsModal').modal('hide');
                }
            },
            error: function (error) {
                showToast('error', `Erro ao excluir registro ${logId}.`);
                $('#deleteLogsModal').modal('hide');
            }
        });       
    }

    getLogs();

    function initDataTable(logsData) {
        const editor = new DataTable.Editor({
            ajax: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/deleteLog',
            table: '#TableLogs',
            idSrc: 'id',
            fields: [
                { label: 'ID:', name: 'id' }
            ]
        });

        const table = new DataTable('#TableLogs', {
            data: logsData,
            columns: [
                { data: null, defaultContent: '', className: 'select-checkbox', orderable: false },
                { data: 'id' },
                { data: 'email_usuario' },
                { data: 'tipo_acao' },
                { data: 'descricao_log' },
                { data: 'data_log' }
            ],
            language: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },  
            select: {
                style: 'os',
                selector: 'td:first-child'
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'remove',
                    editor: editor,
                    text: 'Remover',
                    action: function (e, dt, node, config) {
                        let selectedRows = dt.rows({ selected: true }).data();
                        if (selectedRows.length > 0) {
                            let logId = selectedRows[0].id;

                            $('#deleteLogsModal').modal('show');
                            userToDelete.textContent = logId;
                            
                            $('#confirmDeleteBtn').off('click').on('click', function () {
                                deleteUser(logId);
                            });
                        }
                    }
                }
            ]
        });
    }
});

function showToast(status, message) {
    const icons = {
      success: 'success',
      error: 'error'
      // Adicione outros ícones conforme necessário
    };
  
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
  
    Toast.fire({
      icon: icons[status],
      title: message
    });
  }



// language: {
//     "sEmptyTable": "Nenhum registro encontrado",
//     "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
//     "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
//     "sInfoFiltered": "(Filtrados de _MAX_ registros)",
//     "sInfoPostFix": "",
//     "sInfoThousands": ".",
//     "sLengthMenu": "_MENU_ resultados por página",
//     "sLoadingRecords": "Carregando...",
//     "sProcessing": "Processando...",
//     "sZeroRecords": "Nenhum registro encontrado",
//     "sSearch": "Pesquisar",
//     "oPaginate": {
//         "sNext": "Próximo",
//         "sPrevious": "Anterior",
//         "sFirst": "Primeiro",
//         "sLast": "Último"
//     },
//     "oAria": {
//         "sSortAscending": ": Ordenar colunas de forma ascendente",
//         "sSortDescending": ": Ordenar colunas de forma descendente"
//     }
// },          

