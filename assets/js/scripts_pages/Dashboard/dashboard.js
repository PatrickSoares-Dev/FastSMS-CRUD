console.log('Running')

let qtdUser = document.querySelector("#qtd_user")
let qtdUserCard = document.querySelector("#qtd_userCard")
let qtdLogs = document.querySelector("#qtd_logs")

$.ajax({
    url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/getUser',
    type: 'GET',
    contentType: 'application/x-www-form-urlencoded',
    success: function (data) {
                    
        qtdUser.textContent =  data.data.data.length
        qtdUserCard.textContent =  data.data.data.length

    },
    error: function (error) {
        console.error('Erro ao buscar usuários:', error);
    }
});

$.ajax({
    url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/getAllLogs',
    type: 'GET',
    contentType: 'application/x-www-form-urlencoded',
    success: function (data) {
        qtdLogs.textContent =  data.data.data.length
    },
    error: function (error) {
        console.error('Erro ao buscar logs:', error);
    }
});

