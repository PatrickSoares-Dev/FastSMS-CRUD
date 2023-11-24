document.addEventListener('DOMContentLoaded', function () {
    let userId = document.getElementById('id_user').textContent.trim();

    function getUser() {
        $.ajax({
            url: 'http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/API/public_html/api/user/getUser?id=' + userId,
            type: 'GET',
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                console.log(data);

                let response = data.data.data

                if (data.status === "success") {
                   
                    const dataResponse = response

                    // Criando o objeto 'data' com base nos dados do usuário
                    let userData = {
                        celular: dataResponse.celular,
                        cep: dataResponse.cep,
                        cidade: dataResponse.cidade,
                        complemento: dataResponse.complemento,
                        cpf: dataResponse.cpf,
                        dataNascimento: dataResponse.dataNascimento,
                        email: dataResponse.email,
                        endereco: dataResponse.endereco,
                        estado: dataResponse.estado,
                        id: dataResponse.id,
                        login: dataResponse.login,
                        mae: dataResponse.mae,
                        nome: dataResponse.nome,
                        numeroEndereco: dataResponse.numeroEndereco,
                        senha: dataResponse.senha,
                        sexo: dataResponse.sexo,
                        tel: dataResponse.tel,
                        tipo_user: dataResponse.tipo_user
                    };

                    initDataTable(userData);
                } else {
                    console.error('Erro ao buscar usuários:', data.message);
                }
            },
            error: function (error) {
                console.error('Erro ao buscar usuários:', error);
            }
        });
        
        function initDataTable (userData){

            console.log(userData)                   
            // Preencher o modal com os dados do usuário
            let firstNameInput = document.querySelector('#firstName');
            let motherNameInput = document.querySelector('#motherName');
            let cpfInput = document.querySelector('#cpf');
            let emailInput = document.querySelector('#email');
            let dataNascInput = document.querySelector('#dataNascimento');
            let sexoSelect = document.querySelector('#sexo');
            let telInput = document.querySelector('#tel');
            let celInput = document.querySelector('#cel');
            let cepInput = document.querySelector('#cep');
            let estadoSelect = document.querySelector('#estado');
            let cidadeInput = document.querySelector('#cidade');
            let complementoInput = document.querySelector('#complemento');
            let numeroEnderecoInput = document.querySelector('#numeroEndereco');
            let enderecoInput = document.querySelector('#endereco');
            let loginInput = document.querySelector('#login');
            
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
            
            // $('#userDetailsModal').modal('show');

            // $('#userDetailsModal').on('change', 'input, select', function () {
            //     const fieldName = $(this).attr('name');
            //     const fieldValue = $(this).val();
            //     const userId = userData.id;
            //     updatedFields[userId] = updatedFields[userId] || {};
            //     updatedFields[userId][fieldName] = fieldValue;
            // });
        
            // $('#userDetailsModal').on('click', '.btn-primary', function() {
            //     const userId = userData.id;
            //     const userUpdates = updatedFields[userId];
        
            //     for (const fieldName in userUpdates) {
            //         const fieldValue = userUpdates[fieldName];
            //         updateUser(userId, fieldName, fieldValue);
            //     }
            //     updatedFields[userId] = {}; // Limpar as alterações após o envio
            // });
                         
        }
        
    }

    getUser();
    
});