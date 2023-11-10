const emailOrLoginInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const loginButton = document.getElementById('btnLogin');
const errorMessage = document.getElementById('error-message');
const confirmMessage = document.getElementById('confirm-message');
const successMessage = document.getElementById('success-message');
let idUser;

emailOrLoginInput.addEventListener('input', validateFieldsAndToggleButton);
passwordInput.addEventListener('input', validateFieldsAndToggleButton);
loginButton.addEventListener('click', handleLogin);

function validateFieldsAndToggleButton() {
    const emailOrLogin = emailOrLoginInput.value.trim();
    const password = passwordInput.value.trim();

    const isEmailValid = emailOrLogin.length > 6;
    const isPasswordValid = password.length >= 8;

    if (isEmailValid && isPasswordValid) {
        loginButton.disabled = false;
    } else {
        loginButton.disabled = true;
    }
}

function handleLogin() {
    const login = emailOrLoginInput.value.trim();
    const senha = passwordInput.value.trim();

    const userData = {
        login,
        senha,
    };
    // Enviar a solicitação AJAX
    sendRequest(userData);
}

function sendRequest(userData) {
    const formData = $.param(userData);

    $.ajax({
        url: 'http://localhost/GR-09%20-2023-2%20-%20BG%20-%20PATRICK%20OLIVEIRA/API/public_html/api/user/userLogin',
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded',
        data: formData,
        success: function (data) {
            if (data.data.status === 'success') {
                confirmMessage.textContent = "Confirme o segundo fator de autenticação.";
                confirmMessage.style.display = 'block';
                errorMessage.style.display = 'none';

                idUser = data.data.user_id;
    
                openModalWithRandomQuestion()

            } else {
                errorMessage.textContent = data.data.message;
                errorMessage.style.display = 'block';
                successMessage.style.display = 'none';
            }
        },
        error: function (error) {
            errorMessage.textContent = 'Erro na requisição: ' + error.statusText;
            errorMessage.style.display = 'block';
            successMessage.style.display = 'none';
        }
    });
    
}

// Array com perguntas de segurança
const questions = [
    {
        label: "Qual o nome da sua mãe?",
        placeholder: "Informe o nome da sua mãe",
        variable: "twofa_mae"
    },
    {
        label: "Qual a data do seu nascimento?",
        placeholder: "Informe a data do seu nascimento",
        variable: "twofa_data"
    },
    {
        label: "Qual o CEP do seu endereço?",
        placeholder: "Informe o CEP do seu endereço",
        variable: "twofa_cep"
    }
];

// Função para escolher aleatoriamente uma pergunta
function getRandomQuestion() {
    const randomIndex = Math.floor(Math.random() * questions.length);
    return questions[randomIndex];
}

// Função para abrir o modal com uma pergunta aleatória
function openModalWithRandomQuestion() {
    const randomQuestion = getRandomQuestion();

    // Atualizar o modal com a pergunta aleatória
    const modalTitle = document.getElementById('exampleModalLabel1');
    const labelElement = document.querySelector('.modal-body label');
    const inputElement = document.getElementById('nameBasic');

    modalTitle.textContent = "Pergunta de segurança";
    labelElement.textContent = randomQuestion.label;
    inputElement.placeholder = randomQuestion.placeholder;

    // Armazenar a pergunta atual em uma variável
    const currentQuestion = randomQuestion.variable;

    // Abrir o modal
    $('#basicModal').modal('show');

    // Adicionar um ouvinte de evento ao botão "Confirmar"
    const confirmButton = document.querySelector('.modal-body button');
    confirmButton.addEventListener('click', function() {
        const answer = inputElement.value; // Obter a resposta do usuário
        const userData = {
            id: idUser,
            question: currentQuestion,
            answer: answer
        };
        
        send2FARequest(userData);      
    });
}

function send2FARequest(userData) {
    const formData = $.param(userData);

    $.ajax({
        url: 'http://localhost/GR-09%20-2023-2%20-%20BG%20-%20PATRICK%20OLIVEIRA/API/public_html/api/user/twofa',
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded',
        data: formData,
        success: function (data) {
            if (data.data.status === 'success') {
                successMessage.textContent = "Autenticação bem-sucedida. Redirecionando...";
                confirmMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                successMessage.style.display = 'block';
                $('#basicModal').modal('hide');
            } else {
                // Mostrar mensagem de erro no modal
                const errorMessageModal = document.querySelector("#error-messageModal");
                errorMessageModal.textContent = "Respostas incorretas nas perguntas de autenticação";
                errorMessageModal.style.display = 'block';
            }
        },
        error: function (error) {
            // Lógica de tratamento de erro (se necessário)
            console.error(error);
        }
    });
}




