document.addEventListener('DOMContentLoaded', function () {

    let etapaAtual = 1;
    let usuario = {}; 

    // Primeiro formulário
    let inputNome = document.getElementById('input_nome');
    let inputMae = document.getElementById('input_mae');
    let inputCpf = document.getElementById('input_cpf');
    let inputDataNascimento = document.getElementById('input_dataNascimento');
    let inputTel = document.getElementById('input_tel');
    let selectSexo = document.getElementById('select_sexo');
    let btnEtapa1 = document.getElementById('btnEtapa1');
      
    setupValidation(
        [inputNome, inputMae, inputCpf, inputDataNascimento, inputTel, selectSexo], btnEtapa1
    );

    // Segundo formulário
    let inputCep = document.getElementById('input_cep');
    let selectEstado = document.getElementById('select_estado');
    let inputCidade = document.getElementById('input_cidade');
    let inputNumeroEndereco = document.getElementById('input_numeroEndereco');
    let textEndereco = document.getElementById('text_endereco');
    let inputComplemento = document.getElementById('input_complemento');
    let btnEtapa2 = document.getElementById('btnEtapa2');
    
    setupValidation(
        [inputCep, selectEstado, inputCidade, inputNumeroEndereco, textEndereco, inputComplemento], btnEtapa2
    );

    // Terceiro formulário
    let inputEmail = document.getElementById('input_email');
    let inputLogin = document.getElementById('input_login');
    let inputCelular = document.getElementById('input_celular');
    let inputSenha = document.getElementById('input_senha');
    let inputCSenha = document.getElementById('input_csenha');
    let btnSubmitForm = document.getElementById('btnSubmitForm');
    
    setupValidation(
        [inputEmail, inputLogin, inputCelular, inputSenha, inputCSenha], btnSubmitForm
    );

    btnEtapa1.disabled = true;
    btnEtapa2.disabled = true;
    btnSubmitForm.disabled = true;

    function applyMasksToFields() {
        const maskOptions = [
            { id: 'input_cpf', mask: '000.000.000-00' },
            { id: 'input_tel', mask: '(00) 0000-0000' },
            { id: 'input_cep', mask: '00000-000' },
            { id: 'input_celular', mask: '(00) 00000-0000' }
        ];
    
        maskOptions.forEach(option => {
            const field = document.getElementById(option.id);
            if (field) {
                IMask(field, { mask: option.mask });
            }
        });
    }
    
    // Chame a função para aplicar as máscaras aos campos desejados
    applyMasksToFields();

    function setupValidation(fields, button) {
        fields.forEach(input => {
            // Evento de Button
            input.addEventListener('input', () => validateFieldsAndToggleButton(fields, button));            
            input.addEventListener('keydown', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('keyup', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('click', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('focus', () => validateFieldsAndToggleButton(fields, button));
            
            // Evento de Fields
            input.addEventListener('blur', () => validateField(input));
            input.addEventListener('keydown', () => validateField(input));
            input.addEventListener('keyup', () => validateField(input));
            input.addEventListener('click', () => validateField(input));
            input.addEventListener('focus', () => validateField(input));
        });
    }
    

    // Função para validar campos e habilitar/desabilitar botão
    function validateFieldsAndToggleButton(fields, button) {
        const isFormValid = fields.every(field => {
            // Verifica se o campo está vazio ou tem a classe 'is-invalid'
            if (field.value.trim() === '' || field.classList.contains('is-invalid')) {
                return false; // Este campo não é válido
            }
            return true; // Este campo é válido
        });
    
        button.disabled = !isFormValid;
    }


    function validateField(field) {
        const value = field.value.trim();
        const inputGroup = field.closest('.input-group'); // Encontra o elemento .input-group pai

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
            if (field === inputNome || field === inputMae) {
                if (value.length < 15 || value.length > 80) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
        
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Este campo deve ter entre 15 e 80 caracteres.';
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
            else if (field === inputCpf) {
                const cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
                if (!cpfRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid'); // Adiciona a classe à div

                    // Adiciona a mensagem de erro à div
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'CPF inválido.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputTel) {
                const telefoneRegex = /^\(\d{2}\) \d{4}-\d{4}$/;
                if (!telefoneRegex.test(value)) {
                    field.classList.add('is-invalid');
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
                else if (field === inputCelular) {
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
                else if (field === inputDataNascimento) {
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
            } else if (field === selectSexo) { // Verifica se é o campo selectSexo
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
            } else if (field === inputEmail) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');

                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Email inválido.';
                    inputGroup.appendChild(errorMessage);
                }
             else if(field === inputLogin){
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
            } else if (field === inputSenha) {
                const senhaRegex = /^[a-zA-Z]{8}$/;
                if (!senhaRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
    
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'A senha deve conter exatamente 8 caracteres alfabéticos.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputCep) {
                const cepRegex = /^\d{5}-\d{3}$/;
                if (!cepRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');

                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'CEP inválido. Use o formato 99999-999.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === selectEstado) {
                if (value === 'UF') {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
                    
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Selecione um estado válido.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputNumeroEndereco) {
                if (value === '') {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
                    
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Campo obrigatório.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === textEndereco) {
                if (value === '' || value.length < 5) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
                    
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Endereço deve conter pelo menos 5 caracteres.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputComplemento) {
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

    btnEtapa1.addEventListener('click', function () {
        if (etapaAtual === 1 || etapaAtual === 2) {
            // Salvar informações do Formulário 1 no objeto de usuário
            usuario.nome = inputNome.value;
            usuario.mae = inputMae.value;
            usuario.cpf = inputCpf.value;
            usuario.dataNascimento = inputDataNascimento.value;
            usuario.tel = inputTel.value;
            usuario.sexo = selectSexo.value;

            nextTab();
            etapaAtual = 2;
        }
    });

    btnEtapa2.addEventListener('click', function () {
        if (etapaAtual === 2 || etapaAtual === 3) {
            // Salvar informações do Formulário 2 no objeto de usuário
            usuario.cep = inputCep.value;
            usuario.estado = selectEstado.value;
            usuario.cidade = inputCidade.value;
            usuario.numeroEndereco = inputNumeroEndereco.value;
            usuario.endereco = textEndereco.value;
            usuario.complemento = inputComplemento.value;

            nextTab();
            etapaAtual = 3;
        }
    });

    btnSubmitForm.addEventListener('click', function () {
        // Salvar informações do Formulário 3 no objeto de usuário
        usuario.email = inputEmail.value;
        usuario.celular = inputCelular.value;
        usuario.senha = inputSenha.value;
    
        // Enviar objeto de usuário via AJAX para o backend
        enviarDadosParaBancoDeDados(usuario);
    });
    
    function enviarDadosParaBancoDeDados(usuario) {
        console.log(usuario)
        $.ajax({
            url: 'http://localhost/FastSMS/API/public_html/api/user/registerNewUser',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(usuario),
            success: function (response) {
                alert('Resposta do servidor: ' + response.message);
            },
            error: function (xhr, status, error) {
                alert('Erro ao registrar usuário: ' + xhr.responseText);
            }
        });
    }
    

    function nextTab() {
        // Encontra a tab ativa atual e sua próxima tab
        var activeTab = document.querySelector('.nav-pills .nav-link.active');
        var nextTab = activeTab.parentElement.nextElementSibling.querySelector('.nav-link');

        // Encontra o índice da próxima tab na lista de tabs
        var tabList = Array.from(document.querySelectorAll('.nav-pills .nav-item'));
        var nextTabIndex = tabList.indexOf(nextTab.parentElement);

        // Remove a classe 'active' da tab atual e a adiciona à próxima tab
        activeTab.classList.remove('active');
        nextTab.classList.add('active');

        // Remove a classe 'show' e 'active' do conteúdo da tab atual
        var activeTabContent = document.querySelector('.tab-content .tab-pane.active.show');
        activeTabContent.classList.remove('active', 'show');

        // Adiciona a classe 'active' e 'show' ao conteúdo da próxima tab
        var nextTabContent = document.querySelectorAll('.tab-content .tab-pane')[nextTabIndex];
        nextTabContent.classList.add('active', 'show');
    }
});