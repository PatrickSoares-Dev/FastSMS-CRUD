<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco de dados</title>
    <!-- Inclua o link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Banco de dados</h4>    
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link active"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home"
                            aria-controls="navs-pills-top-home"
                            aria-selected="true"
                        >
                            Modelo EER
                        </button>
                    </li>
                    <li class="nav-item">
                        <button
                            type="button"
                            class="nav-link"
                            role="tab"
                            data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile"
                            aria-controls="navs-pills-top-profile"
                            aria-selected="false"
                            id="copyDDLButton"
                        >
                            Código da Tabela
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <img src="assets\img\DER.png" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <p id="copyStatus"></p>
                        <img src="assets\img\DDLUsuarios.png" class="img-fluid">                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclua os scripts do Bootstrap (jQuery e Popper.js) e do Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.min.js"></script>

<script>
    const copyButton = document.getElementById('copyDDLButton');

    copyButton.addEventListener('click', () => {
        const ddlCode = `
        CREATE TABLE usuarios (
            id int(11) NOT NULL AUTO_INCREMENT,
            nome varchar(255) NOT NULL,
            mae varchar(255) NOT NULL,
            cpf varchar(14) NOT NULL,
            dataNascimento date NOT NULL,
            tel varchar(15) NOT NULL,
            sexo varchar(20) NOT NULL,
            cep varchar(10) NOT NULL,
            estado varchar(2) NOT NULL,
            cidade varchar(255) NOT NULL,
            numeroEndereco varchar(10) NOT NULL,
            endereco text NOT NULL,
            complemento varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            celular varchar(15) NOT NULL,
            senha varchar(255) NOT NULL,
            tipo_user enum('usuário','admin') NOT NULL,
            login varchar(20) DEFAULT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci`;

        const tempTextArea = document.createElement('textarea');
        tempTextArea.value = ddlCode;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        document.execCommand('copy');

        document.body.removeChild(tempTextArea);
        document.getElementById('copyStatus').textContent = 'Código DDL copiado para a área de transferência!';
    });
</script>
</body>
</html>
