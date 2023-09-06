document.addEventListener('DOMContentLoaded', function () {
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
    let inputCelular = document.getElementById('input_celular');
    let inputSenha = document.getElementById('input_senha');
    let inputCSenha = document.getElementById('input_csenha');
    let btnSubmitForm = document.getElementById('btnSubmitForm');
    
    setupValidation(
        [inputEmail, inputCelular, inputSenha, inputCSenha], btnSubmitForm
    );

    function setupValidation(fields, button) {
        fields.forEach(input => {
            input.addEventListener('input', () => validateFieldsAndToggleButton(fields, button));
            input.addEventListener('blur', () => validateField(input));
        });
    }

    // Função para validar campos e habilitar/desabilitar botão
    function validateFieldsAndToggleButton(fields, button) {
        const allFieldsValid = fields.every(field => field.value.trim() !== '');
        button.disabled = !allFieldsValid;
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

            if (field === inputCpf) {
                if (value.length !== 14) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid'); // Adiciona a classe à div

                    // Adiciona a mensagem de erro à div
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'CPF inválido.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputTel) {
                const telefoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
                if (!telefoneRegex.test(value)) {
                    field.classList.add('is-invalid');
                    inputGroup.classList.add('is-invalid');

                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'invalid-feedback';
                    errorMessage.textContent = 'Telefone inválido. Use o formato (00) 9999-9999 ou (00) 99999-9999.';
                    inputGroup.appendChild(errorMessage);
                }
            } else if (field === inputDataNascimento) {
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
            }
        }
    }

    btnEtapa1.addEventListener('click', function () {
        nextTab();
    });

    btnEtapa2.addEventListener('click', function () {
        nextTab();
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
});