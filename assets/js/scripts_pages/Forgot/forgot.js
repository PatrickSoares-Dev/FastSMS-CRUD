document.addEventListener('DOMContentLoaded', function () {
    const questions = [
        {
            label: "Qual o nome da sua mãe?",
            placeholder: "Informe o nome da sua mãe",
            variable: "mae"
        },
        {
            label: "Qual a data do seu nascimento?",
            placeholder: "Informe a data do seu nascimento",
            variable: "dataNascimento"
        },
        {
            label: "Qual o CEP do seu endereço?",
            placeholder: "Informe o CEP do seu endereço",
            variable: "cep"
        }
    ];

    function getRandomQuestion() {
        const randomIndex = Math.floor(Math.random() * questions.length);
        return questions[randomIndex];
    }

    const btnSendEmail = document.getElementById('btnSendEmail');
    btnSendEmail.addEventListener('click', function(event) {
        event.preventDefault();

        const email = document.getElementById('email').value;

        // Fazendo requisição para verificar se o email existe no banco de dados
        $.ajax({
            url: `http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/checkEmailExists?email=${email}`,
            method: 'POST',
            success: function(response) {
                if (response.data.message != 'Email não encontrado no banco de dados.') {
                    
                    const randomQuestion = getRandomQuestion();

                    const errorDisplay = document.getElementById('errorDisplay');

                    if(errorDisplay.style.display != 'none') {
                        errorDisplay.style.display = 'none';
                    }                    

                    document.getElementById('formAuthentication').innerHTML = `
                        <div class="mb-3">
                            <label for="answer" class="form-label">${randomQuestion.label}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="answer"
                                name="answer"
                                placeholder="${randomQuestion.placeholder}"
                            />
                        </div>
                        <button id="btnVerifyAnswer" class="btn btn-primary d-grid w-100">Verificar resposta</button>
                    `;
                    
                    const btnVerifyAnswer = document.getElementById('btnVerifyAnswer');
                    btnVerifyAnswer.addEventListener('click', function(event) {
                        event.preventDefault();
                        const answer = document.getElementById('answer').value;

                        $.ajax({
                            url: `http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/forgotUser?email=${email}&question=${randomQuestion.variable}&answer=${answer}`,
                            method: 'GET',
                            success: function(response) {
                                
                                console.log(response.data.status);

                                if (response.data.status === 'success') {

                                    if(errorDisplay.style.display != 'none') {
                                        errorDisplay.style.display = 'none';
                                    }  

                                    document.getElementById('formAuthentication').innerHTML = `
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">Senha</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="newPassword"
                                                name="newPassword"
                                                placeholder="Digite a nova senha"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirmar Senha</label>
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="confirmPassword"
                                                name="confirmPassword"
                                                placeholder="Confirme a nova senha"
                                            />
                                        </div>
                                        <button id="btnChangePassword" class="btn btn-primary d-grid w-100">Alterar senha</button>
                                    `;

                                    const btnChangePassword = document.getElementById('btnChangePassword');
                                    btnChangePassword.addEventListener('click', function(event) {
                                        event.preventDefault();
                                        const newPassword = document.getElementById('newPassword').value;
                                        const confirmPassword = document.getElementById('confirmPassword').value;
                                
                                        if (newPassword !== confirmPassword) {
                                            
                                            const errorDisplay = document.getElementById('errorDisplay');
                                            if(errorDisplay.style.display != 'block') {
                                                errorDisplay.style.display = 'block';
                                            } 
                                            errorDisplay.textContent = 'As senhas não coincidem. Tente novamente.';
                                            return;
                                        }
                                
                                        const data = {
                                            email: email,
                                            novaSenha: newPassword
                                        };                    

                                        $.ajax({
                                            url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/updateForgotUser',
                                            method: 'POST',
                                            contentType: 'application/x-www-form-urlencoded',
                                            data: $.param(data),
                                            success: function(updateResponse) {

                                                console.log(updateResponse)

                                                if (updateResponse.data.message === 'Usuário atualizado com sucesso!') {

                                                    if(errorDisplay.style.display != 'none') {
                                                        errorDisplay.style.display = 'none';
                                                    }  
                
                                                    const formAuthentication = document.getElementById('formAuthentication');
                                                    formAuthentication.innerHTML = '<p class="text-success">Senha alterada com sucesso!</p>';

                                                    setTimeout(function () {
                                                        window.location.href = 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/login'; // Substitua 'URL_DA_TELA_DE_LOGIN' pela URL da sua tela de login
                                                    }, 2000);
                                                } else {
                                                    

                                                    const errorDisplay = document.getElementById('errorDisplay');
                                                    if(errorDisplay.style.display != 'block') {
                                                        errorDisplay.style.display = 'block';
                                                    } 
                                                    errorDisplay.textContent = 'Ocorreu um erro ao alterar a senha.';
                                                }
                                            },
                                            error: function() {

                                                const errorDisplay = document.getElementById('errorDisplay');
                                                if(errorDisplay.style.display != 'block') {
                                                    errorDisplay.style.display = 'block';
                                                } 
                                                errorDisplay.textContent = 'Ocorreu um erro ao processar a solicitação.';
                                            }
                                        });
                                    });
                                } else {
                                    const errorDisplay = document.getElementById('errorDisplay');
                                    if(errorDisplay.style.display != 'block') {
                                        errorDisplay.style.display = 'block';
                                    } 
                                    errorDisplay.textContent = 'Resposta de segurança incorreta. Por favor, tente novamente.';
                                }
                            },
                            error: function() {
                                const errorDisplay = document.getElementById('errorDisplay');
                                if(errorDisplay.style.display != 'block') {
                                    errorDisplay.style.display = 'block';
                                } 
                                errorDisplay.textContent = 'Ocorreu um erro ao processar a solicitação.';
                            }
                        });
                    });
                } else {
                    const errorDisplay = document.getElementById('errorDisplay');
                    if(errorDisplay.style.display != 'block') {
                        errorDisplay.style.display = 'block';
                    } 
                    errorDisplay.textContent = 'Email não encontrado no banco de dados. Por favor, verifique o email fornecido.';
                }
            },
            error: function() {
                const errorDisplay = document.getElementById('errorDisplay');
                if(errorDisplay.style.display != 'block') {
                    errorDisplay.style.display = 'block';
                } 
                errorDisplay.textContent = 'Ocorreu um erro ao processar a solicitação.';
            }
        });
    });
});
