document.addEventListener('DOMContentLoaded', function () {

    let etapaAtual = 1;
    let usuario = {}; // Objeto de usuário

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

    // Chame a função para aplicar as máscaras aos campos desejados.
    applyMasksToFields();

    // Aplicar a função aos campos.
    inputNome.addEventListener('input', removeNumbers);
    inputMae.addEventListener('input', removeNumbers);
    selectEstado.addEventListener('input', removeNumbers);
    inputCidade.addEventListener('input', removeNumbers);

    function setupValidation(fields, button) {
        fields.forEach(input => {

            // Evento de Button
            input.addEventListener('input', () => validateFieldsAndToggleButton(fields, button));            
            input.addEventListener('keydown', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('keyup', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('click', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('focus', () => validateFieldsAndToggleButton(fields, button));
            
            // Evento de Fields
            input.addEventListener('input', () => validateField(input));
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
            } else if (field === inputTel) {
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
            } if (field === inputSenha) {
                const senhaRegex = /^[a-zA-Z]{8}$/;
                if (!senhaRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
            
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'A senha deve conter exatamente 8 caracteres alfabéticos.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputCSenha) {
                const senha = inputSenha.value.trim();
                if (value !== senha) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');
            
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'As senhas não coincidem.';
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
    
    // Função para enviar a requisição AJAX
    function sendRequest(userData) {

        console.log(JSON.stringify(userData));

        $.ajax({
            url: 'http://localhost/FastSMS/API/public_html/api/user/registerUser',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(userData),
            success: function (data) {
                // Verificar a resposta da API
                if (data.status === 'success') {                    
                                                            
                } else {

                    console.log("Status: " + data.status);
                    console.log("Erro: " + data.message); // Deve ser data.data.message
                }
            },
            error: function (error) {
                // Erro na requisição
                console.error('Erro na requisição:', error);
                alert('Erro na requisição. Tente novamente.');
            }
        });        
    }

    // Adicione um evento de clique ao botão
    btnSubmitForm.addEventListener('click', function () {
        // Array com os campos obrigatórios
        const camposObrigatorios = [
            inputNome, inputMae, inputCpf, inputDataNascimento, inputTel,
            selectSexo, inputCep, selectEstado, inputCidade, inputNumeroEndereco,
            textEndereco, inputEmail, inputLogin, inputCelular, inputSenha
        ];

        // Verifique se todos os campos obrigatórios estão preenchidos e não estão vazios
        const camposPreenchidos = camposObrigatorios.every(function (campo) {
            return campo.value.trim() !== '';
        });

        // Se todos os campos obrigatórios estiverem preenchidos
        if (camposPreenchidos) {
            // Coletar os valores dos campos
            const nome = inputNome.value.trim();
            const mae = inputMae.value.trim();
            const cpf = inputCpf.value.trim();
            const dataNascimento = inputDataNascimento.value.trim();
            const tel = inputTel.value.trim();
            const sexo = selectSexo.value.trim();
            const cep = inputCep.value.trim();
            const estado = selectEstado.value.trim();
            const cidade = inputCidade.value.trim();
            const numeroEndereco = inputNumeroEndereco.value.trim();
            const endereco = textEndereco.value.trim();
            const email = inputEmail.value.trim();
            const login = inputLogin.value.trim();
            const celular = inputCelular.value.trim();
            const senha = inputSenha.value.trim();
            const tipo_user = 'User'; // Substitua pelo valor correto

            // Construir um objeto com os dados do usuário
            const userData = {
                nome,
                mae,
                cpf,
                dataNascimento,
                tel,
                sexo,
                cep,
                estado,
                cidade,
                numeroEndereco,
                endereco,
                email,
                login,
                celular,
                senha,
                tipo_user
            };

            console.log(userData);

            // Chame a função sendRequest para enviar a requisição AJAX
            sendRequest(userData);
        } else {
            // Campos obrigatórios não preenchidos
            alert('Preencha todos os campos obrigatórios.');
        }
    });


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

    // Função para remover números de um campo de entrada de texto
    function removeNumbers(event) {
        const value = event.target.value;
        if (/\d/.test(value)) {
            event.target.value = value.replace(/\d/g, '');
        }
    }
    
});
