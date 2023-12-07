document.addEventListener('DOMContentLoaded', function () {
    function getUser() {
        $.ajax({
            url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/getUser',
            type: 'GET',
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                if (data.status === "success") {
                    console.log(data);
                    const usersData = data.data.data.map(user => ({
                        DT_RowId: user.id, 
                        ...user 
                    }));

                    console.log(usersData);

                    initDataTable(usersData);
                } else {
                    console.error('Erro ao buscar usuários:', data.message);
                }
            },
            error: function (error) {
                console.error('Erro ao buscar usuários:', error);
            }
        });
    }


    let updatedFields = {};

    function updateUser(userId, fieldName, fieldValue) {
        $.ajax({
          url: `http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/updateUserById?id=${userId}&${fieldName}=${fieldValue}`,
          type: 'POST',
          success: function (response) {
            if (response.status === 'success') {
              showToast('success', `Informações atualizadas com sucesso.`);
              $('#userDetailsModal').modal('hide');
              setTimeout(function() {
                location.reload(); // Recarrega a página após 3 segundos
              }, 3000);
            } else {
              showToast('error', 'Erro ao atualizar informações.');
            }
          },
          error: function (error) {
            showToast('error', 'Erro ao atualizar informações.');
          }
        });
      }

    function deleteUser(userId, userName) {
        $('#userNameToDelete').text(userName);
        $('#userToDelete').text(userName);
        $('#deleteUserModal').modal('show');
        
        $('#confirmDeleteBtn').off().on('click', function() {
            $.ajax({
                url: `http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/deleteUserById?id=${userId}`,
                type: 'POST',
                success: function (response) {
                    if (response.status === 'success') {
                        showToast('success', `Usuário ${userId} excluído com sucesso.`);
                        $('#deleteUserModal').modal('hide');
                        setTimeout(function() {
                            location.reload(); // Recarrega a página após 3 segundos
                        }, 3000);
                
                    } else {
                        showToast('error', `Erro ao excluir usuário ${userId}.`);
                        $('#deleteUserModal').modal('hide');
                    }
                },
                error: function (error) {
                    showToast('error', `Erro ao excluir usuário ${userId}.`);
                    $('#deleteUserModal').modal('hide');
                }
            });
        });
    }

    function registerUser(userData) {
        const formData = $.param(userData);

        console.log(formData);
    
        $.ajax({
            url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/registerUser',
            type: 'POST',
            contentType: 'application/x-www-form-urlencoded',
            data: formData,
            success: function (data) {
                if (data.data.status === 'success') {
                    const login = userData.login; // Obtém o login do usuário
                    showToast('success', `Usuário ${login} criado com sucesso`);
                    $('#deleteUserModal').modal('hide');
                    setTimeout(function() {
                      location.reload(); // Recarrega a página após 3 segundos
                    }, 3000);
                } else {
                    showToast('error', `Não foi possível criar o usuário.`);
                }
            },
            error: function (error) {
                showToast('error', `Error ` + error.statusText);
            }
        });
    }

    // Função para inicializar o DataTable
    function initDataTable(usersData) {
        const editor = new DataTable.Editor({
            ajax: {
                create: {
                    type: 'POST',
                    url: '',
                },
                edit: {
                    type: 'POST',
                    url: '',
                },
                remove: {
                    type: 'POST',
                    url: '', // Não é necessário definir uma URL aqui
                }
            },
            fields: [
                { label: 'ID:', name: 'id' },
                { label: 'Nome:', name: 'nome' },
                { label: 'Nome da Mãe:', name: 'mae' },
                { label: 'CPF:', name: 'cpf' },
                { label: 'Email:', name: 'email' },
                { label: 'Data de Nascimento:', name: 'dataNascimento' },
                { label: 'CEP:', name: 'cep' },
                { label: 'Telefone:', name: 'tel' },
                { label: 'Sexo:', name: 'sexo' },
                { label: 'Estado:', name: 'estado' },
                { label: 'Cidade:', name: 'cidade' },
                { label: 'Numero do Endereco:', name: 'numeroEndereco' },
                { label: 'Endereço:', name: 'endereco' },
                { label: 'Complemento:', name: 'complemento' },
                { label: 'Celular:', name: 'celular' },
                { label: 'Senha:', name: 'senha' },
                { label: 'Tipo de Usuário:', name: 'tipo_user' },
                { label: 'Login:', name: 'login' }
            ],
            table: '#TableUsers'
        });       

        const table = new DataTable('#TableUsers', {
            data: usersData,
            columns: [
                { data: null, defaultContent: '', className: 'select-checkbox form-check-input', orderable: false },
                { data: 'id'},
                { data: 'nome'},
                { data: 'mae'},
                { data: 'email'},
                { data: 'dataNascimento'},
                { data: 'cpf'},
                { data: 'cep'}
                
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
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Novo',
                    className: 'btn btn-primary',
                    action: function () {                                                                    

                        let userCreateModal = document.getElementById('userCreateModal');
                        let btnCreateUser = document.querySelector("#btnCreateUser");

                        $('#userCreateModal').find('input, select').on('change input', function() {
                            const field = this;
                            validateField(field);
                        });

                        $('#userCreateModal').on('shown.bs.modal', function () {}).modal('show');
                    
                        applyMasksToFields()                                                                       

                        function validateField(field) {
                            const value = field.value.trim();
                            const inputGroup = field.closest('.input-group');    
                            
                            var firstNameInput = userCreateModal.querySelector('#firstName');
                            var motherNameInput = userCreateModal.querySelector('#motherName');
                            var cpfInput = userCreateModal.querySelector('#cpf');
                            var emailInput = userCreateModal.querySelector('#email');
                            var dataNascInput = userCreateModal.querySelector('#dataNascimento');
                            var sexoSelect = userCreateModal.querySelector('#sexo');
                            var telInput = userCreateModal.querySelector('#tel');
                            var celInput = userCreateModal.querySelector('#cel');
                            var cepInput = userCreateModal.querySelector('#cep');
                            var estadoSelect = userCreateModal.querySelector('#estado');
                            var cidadeInput = userCreateModal.querySelector('#cidade');
                            var numeroEnderecoInput = userCreateModal.querySelector('#numeroEndereco');
                            var complementoInput = userCreateModal.querySelector('#complemento');
                            var enderecoInput = userCreateModal.querySelector('#endereco');
                            var loginInput = userCreateModal.querySelector('#login');
                            var tipoUserSelect = userCreateModal.querySelector('#tipo_user');
                            
                            if (value === '') {
                                field.classList.add('is-invalid');
                    
                                // Adiciona a mensagem de erro à div
                                const errorMessage = document.createElement('div');
                                errorMessage.className = 'invalid-feedback';
                                errorMessage.textContent = 'Campo obrigatório.';
                    
                                // Verifica se já existe uma mensagem de erro
                                const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                if (!existingErrorMessage) {
                                    inputGroup.appendChild(errorMessage);
                                }
                            } else {
                                // Remove qualquer mensagem de erro existente
                                const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                if (existingErrorMessage) {
                                    existingErrorMessage.remove();
                                }
                    
                                if (field.classList.contains("is-invalid")) {
                                    field.classList.remove("is-invalid");
                                }
                                if (field.id === firstNameInput.id || field.id === motherNameInput.id) {
                                    if (value.length < 15 || value.length > 80 || /\d/.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Este campo deve ter entre 15 e 80 caracteres e não deve conter números.';
                                        inputGroup.appendChild(errorMessage);
                                    } else {
                                        // Remove qualquer mensagem de erro existente
                                        const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                                
                                        if (field.classList.contains("is-invalid")) {
                                            field.classList.remove("is-invalid");
                                        }
                                    }
                                }                        
                                else if (field.id === cpfInput.id) {
                                    const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
                                    if (!cpfRegex.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid'); // Adiciona a classe à div
                        
                                        // Adiciona a mensagem de erro à div
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'CPF inválido.';
                                        inputGroup.appendChild(errorMessage);
                                    } else {
                                        // Verifique se o CPF é válido usando a função validarCPF
                                        const cpfValido = validarCPF(value);
                                        if (!cpfValido) {
                                            field.classList.add('is-invalid');
                                            inputGroup.classList.add('is-invalid'); // Adiciona a classe à div
                        
                                            // Adiciona a mensagem de erro à div
                                            const errorMessage = document.createElement('div');
                                            errorMessage.className = 'invalid-feedback';
                                            errorMessage.textContent = 'CPF inválido.';
                                            inputGroup.appendChild(errorMessage);
                                        }
                                    }            
                                } else if (field.id === telInput.id) {
                                    const telefoneRegex = /^\(\d{2}\) \d{4}-\d{4}$/;
                                    if (!telefoneRegex.test(value)) {
                                        field.classList.add('is-invalid');""
                                        inputGroup.classList.add('is-invalid');
                                
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Telefone inválido. Use o formato (00) 9999-9999.';
                                        inputGroup.appendChild(errorMessage);
                                    } else {
                                        // Remova qualquer mensagem de erro existente
                                        const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                                
                                        if (field.classList.contains("is-invalid")) {
                                            field.classList.remove("is-invalid");
                                        }
                                    }
                                }
                                    else if (field.id === celInput.id) {
                                        const celularRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
                                        if (!celularRegex.test(value)) {
                                            field.classList.add('is-invalid');
                                            inputGroup.classList.add('is-invalid');
                                    
                                            const errorMessage = document.createElement('div');
                                            errorMessage.className = 'invalid-feedback';
                                            errorMessage.textContent = 'Celular inválido. Use o formato (00) 99999-9999.';
                                            inputGroup.appendChild(errorMessage);
                                        } else {
                                            // Remova qualquer mensagem de erro existente
                                            const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                            if (existingErrorMessage) {
                                                existingErrorMessage.remove();
                                            }
                                    
                                            if (field.classList.contains("is-invalid")) {
                                                field.classList.remove("is-invalid");
                                            }
                                        }
                                    } 
                                    else if (field.id === dataNascInput.id) {
                                        const currentDate = new Date();
                                        const inputDate = new Date(value);
                    
                                        if (!value) {
                                            field.classList.add('is-invalid');
                                            inputGroup.classList.add('is-invalid');
                    
                                            const errorMessage = document.createElement('div');
                                            errorMessage.className = 'invalid-feedback';
                                            errorMessage.textContent = 'Campo obrigatório.';
                                            inputGroup.appendChild(errorMessage);
                                    } else if (inputDate > currentDate) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                    
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'A data não pode estar no futuro.';
                                        inputGroup.appendChild(errorMessage);
                                    } else {
                                        const age = currentDate.getFullYear() - inputDate.getFullYear();
                    
                                        if (age < 18) {
                                            field.classList.add('is-invalid');
                                            inputGroup.classList.add('is-invalid');
                    
                                            const errorMessage = document.createElement('div');
                                            errorMessage.className = 'invalid-feedback';
                                            errorMessage.textContent = 'O usuário deve ter pelo menos 18 anos de idade.';
                                            inputGroup.appendChild(errorMessage);
                                        }
                                    }
                                } else if (field.id === sexoSelect.id || field.id === tipoUserSelect.id) { // Verifica se é o campo selectSexo
                                    if (value === 'Selecione') {
                                        field.classList.add('is-invalid');
                            
                                        // Adiciona a mensagem de erro à div
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Selecione uma opção válida.';
                            
                                        // Verifica se já existe uma mensagem de erro
                                        const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                        if (!existingErrorMessage) {
                                            inputGroup.appendChild(errorMessage);
                                        }
                                    } else {
                                        // Remove qualquer mensagem de erro existente
                                        const existingErrorMessage = inputGroup.querySelector('.invalid-feedback');
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                            
                                        if (field.classList.contains("is-invalid")) {
                                            field.classList.remove("is-invalid");
                                        }
                                    }
                                } else if (field.id === emailInput.id) {
                                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                    if (!emailRegex.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                    
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Email inválido.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                 else if(field.id === loginInput.id){
                                    const loginRegex = /^[a-zA-Z]{6}$/;
                                    if (!loginRegex.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                    
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'O login deve conter exatamente 6 caracteres alfabéticos.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                 }
                                } if (field.id === inputSenha.id ) {
                                    const senhaRegex = /^[a-zA-Z]{8}$/;
                                    if (!senhaRegex.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'A senha deve conter exatamente 8 caracteres alfabéticos.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                } else if (field.id === cpassword.id ) {
                                    const senha = inputSenha.value.trim();
                                    if (value !== senha) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'As senhas não coincidem.';
                                        inputGroup.appendChild(errorMessage);
                                    }                                                   
                                } else if (field.id === cepInput.id) {
                                    const cepRegex = /^\d{5}-\d{3}$/;
                                    if (!cepRegex.test(value)) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                    
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'CEP inválido. Use o formato 99999-999.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                } else if (field.id === estadoSelect.id) {
                                    if (value === 'UF') {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                        
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Selecione um estado válido.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                } else if (field.id === numeroEndereco.id) {
                                    if (value === '') {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                        
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Campo obrigatório.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                } else if (field.id === enderecoInput.id || field === cidadeInput.id) {
                                    if (value === '' || value.length < 5) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                        
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Endereço deve conter pelo menos 5 caracteres.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                } else if (field.id === complementoInput.id) {
                                    if (value === '' || value.length < 5) {
                                        field.classList.add('is-invalid');
                                        inputGroup.classList.add('is-invalid');
                                        
                                        const errorMessage = document.createElement('div');
                                        errorMessage.className = 'invalid-feedback';
                                        errorMessage.textContent = 'Complemento é obrigatório e deve conter pelo menos 5 caracteres.';
                                        inputGroup.appendChild(errorMessage);
                                    }
                                }
                            }
                            
                        }
                                                                            
                        $('#btnCreateUser').on('click', function () {

                            var firstNameInput = userCreateModal.querySelector('#firstName');
                            var motherNameInput = userCreateModal.querySelector('#motherName');
                            var cpfInput = userCreateModal.querySelector('#cpf');
                            var emailInput = userCreateModal.querySelector('#email');
                            var dataNascInput = userCreateModal.querySelector('#dataNascimento');
                            var sexoSelect = userCreateModal.querySelector('#sexo');
                            var telInput = userCreateModal.querySelector('#tel');
                            var celInput = userCreateModal.querySelector('#cel');
                            var cepInput = userCreateModal.querySelector('#cep');
                            var estadoSelect = userCreateModal.querySelector('#estado');
                            var cidadeInput = userCreateModal.querySelector('#cidade');
                            var numeroEnderecoInput = userCreateModal.querySelector('#numeroEndereco');
                            var complementoInput = userCreateModal.querySelector('#complemento');
                            var enderecoInput = userCreateModal.querySelector('#endereco');
                            var inputSenha = userCreateModal.querySelector('#inputSenha')                            
                            var loginInput = userCreateModal.querySelector('#login');
                            var tipoUserSelect = userCreateModal.querySelector('#tipo_user');

                            const camposObrigatorios = [
                                firstNameInput, motherNameInput, cpfInput, dataNascInput, telInput,
                                sexoSelect, cepInput, estadoSelect, cidadeInput, numeroEnderecoInput , complementoInput,
                                enderecoInput, emailInput, loginInput, celInput, inputSenha, tipoUserSelect
                            ];
                            
                            const camposPreenchidos = camposObrigatorios .every(function (campo) {
                                return campo.value.trim() !== '';
                            });

                            if (camposPreenchidos) {
                                const userData = {
                                    nome: firstNameInput.value.trim(),
                                    mae: motherNameInput.value.trim(),
                                    cpf: cpfInput.value.trim(),
                                    dataNascimento: dataNascInput.value.trim(),
                                    tel: telInput.value.trim(),
                                    sexo: sexoSelect.value.trim(),
                                    cep: cepInput.value.trim(),
                                    estado: estadoSelect.value.trim(),
                                    cidade: cidadeInput.value.trim(),
                                    numeroEndereco: numeroEnderecoInput.value.trim(),
                                    complemento: complementoInput.value.trim(),
                                    endereco: enderecoInput.value.trim(),
                                    email: emailInput.value.trim(),
                                    login: loginInput.value.trim(),
                                    celular: celInput.value.trim(),
                                    senha: inputSenha.value.trim(),
                                    tipo_user: tipoUserSelect.value.trim()
                                };

                                registerUser(userData);

                            }else{
                                alert("Campos inválidos")
                            }
                            
                        });

                        function validarCPF(cpf) {
                            cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
                        
                            if (cpf.length !== 11) {
                                return false; // Um CPF válido deve ter 11 dígitos
                            }
                        
                            // Verifica se todos os dígitos são iguais, o que não é permitido
                            if (/^(\d)\1+$/.test(cpf)) {
                                return false;
                            }
                        
                            // Calcula o primeiro dígito verificador
                            let soma = 0;
                            for (let i = 0; i < 9; i++) {
                                soma += parseInt(cpf.charAt(i)) * (10 - i);
                            }
                            let resto = 11 - (soma % 11);
                            if (resto === 10 || resto === 11) {
                                resto = 0;
                            }
                            if (resto !== parseInt(cpf.charAt(9))) {
                                return false; // CPF inválido
                            }
                        
                            // Calcula o segundo dígito verificador
                            soma = 0;
                            for (let i = 0; i < 10; i++) {
                                soma += parseInt(cpf.charAt(i)) * (11 - i);
                            }
                            resto = 11 - (soma % 11);
                            if (resto === 10 || resto === 11) {
                                resto = 0;
                            }
                            if (resto !== parseInt(cpf.charAt(10))) {
                                return false; // CPF inválido
                            }
                        
                            return true; // CPF válido
                        }

                        function applyMasksToFields() {
                            

                            const maskOptions = [
                                { id: 'cpf', mask: '000.000.000-00' },
                                { id: 'tel', mask: '(00) 0000-0000' },
                                { id: 'cep', mask: '00000-000' },
                                { id: 'cel', mask: '(00) 00000-0000' }
                            ];
                        
                            maskOptions.forEach(option => {
                                const field = document.getElementById(option.id);
                                if (field) {
                                    IMask(field, { mask: option.mask });
                                }
                            });
                        }                                                                                     
                    }
                },
                {
                    extend: 'edit',
                    editor: editor,
                    text: 'Detalhes',
                    className: 'btn btn-primary',                    
                    action: function (e, dt, node, config) {
                        let selectedRows = dt.rows({ selected: true }).data();
                        if (selectedRows.length > 0) {
                            let userData = selectedRows[0]; // Dados do usuário selecionado

                            console.log(userData)
                            
                            let tittleUser = document.querySelector("#tittleUser")
                            tittleUser.textContent = ('Usuário: ' + userData.login + " - " + userData.id)

                            // Preencher o modal com os dados do usuário
                            let userDetailsModal = document.getElementById('userDetailsModal');
                            let firstNameInput = userDetailsModal.querySelector('#firstName');
                            let motherNameInput = userDetailsModal.querySelector('#motherName');
                            let cpfInput = userDetailsModal.querySelector('#cpf');
                            let emailInput = userDetailsModal.querySelector('#email');
                            let dataNascInput = userDetailsModal.querySelector('#dataNascimento');
                            let sexoSelect = userDetailsModal.querySelector('#sexo');
                            let telInput = userDetailsModal.querySelector('#tel');
                            let celInput = userDetailsModal.querySelector('#cel');
                            let cepInput = userDetailsModal.querySelector('#cep');
                            let estadoSelect = userDetailsModal.querySelector('#estado');
                            let cidadeInput = userDetailsModal.querySelector('#cidade');
                            let complementoInput = userDetailsModal.querySelector('#complemento');
                            let numeroEnderecoInput = userDetailsModal.querySelector('#numeroEndereco');
                            let enderecoInput = userDetailsModal.querySelector('#endereco');
                            let loginInput = userDetailsModal.querySelector('#login');
                            let tipoUserSelect = userDetailsModal.querySelector('#tipo_user');
                            
                            firstNameInput.value = userData.nome;
                            motherNameInput.value = userData.mae;
                            cpfInput.value = userData.cpf;
                            emailInput.value = userData.email;
                            dataNascInput.value = userData.dataNascimento;
                            sexoSelect.value = userData.sexo;
                            telInput.value = userData.tel;
                            celInput.value = userData.celular;
                            cepInput.value = userData.cep;
                            estadoSelect.value = userData.estado;
                            cidadeInput.value = userData.cidade;
                            complementoInput.value = userData.complemento;
                            numeroEnderecoInput.value = userData.numeroEndereco;
                            enderecoInput.value = userData.endereco;
                            loginInput.value = userData.login;
                            tipoUserSelect.value = userData.tipo_user;
                            
                            $('#userDetailsModal').modal('show');

                            $('#userDetailsModal').on('change', 'input, select', function () {
                                const fieldName = $(this).attr('name');
                                const fieldValue = $(this).val();
                                const userId = userData.id;
                                updatedFields[userId] = updatedFields[userId] || {};
                                updatedFields[userId][fieldName] = fieldValue;
                            });
                        
                            $('#userDetailsModal').on('click', '.btn-primary', function() {
                                const userId = userData.id;
                                const userUpdates = updatedFields[userId];
                        
                                for (const fieldName in userUpdates) {
                                    const fieldValue = userUpdates[fieldName];
                                    updateUser(userId, fieldName, fieldValue);
                                }
                                updatedFields[userId] = {}; // Limpar as alterações após o envio
                            });
                            
                        }
                    }
                },
                {
                    extend: 'remove',
                    editor: editor,
                    text: 'Remover',
                    className: 'btn btn-primary',
                    action: function (e, dt, node, config) {
                        let selectedRows = dt.rows({ selected: true }).data();
                        if (selectedRows.length > 0) {
                            let userId = selectedRows[0].id;
                            let userName = selectedRows[0].nome; 
                            deleteUser(userId, userName);
                        }
                    }
                }
            ],
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });

        // Ativar a edição inline ao clicar em uma célula da tabela
        table.on('click', 'tbody td:not(:first-child)', function (e) {
            editor.inline(this);
        });
        
    }

    getUser(); 
       
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
    
});
