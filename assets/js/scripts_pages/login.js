function validateForm() {
    var emailOrLogin = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (emailOrLogin.trim() === "") {
        alert("Por favor, preencha o campo de Email ou Login.");
        return false; // Impede o envio do formulário
    }

    if (password.trim() === "") {
        alert("Por favor, preencha o campo de Senha.");
        return false; // Impede o envio do formulário
    }

    // Redireciona para o painel de controle (dashboard)
    window.location.href = "dashboard";

    // Retorna false para evitar o envio do formulário
    return false;
}