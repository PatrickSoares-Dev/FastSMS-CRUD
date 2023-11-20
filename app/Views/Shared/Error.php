<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Error</title>
    <style>
        .misc-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-text,
        .mt-3 img {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container-xxl container-p-y div-container">
        <div class="misc-wrapper">
            <div class="error-text">
                <h2 class="mb-2 mx-2">Página de Error</h2>
                <?php
                    // Exibe a mensagem de erro diretamente do array
                    if (isset($resultadoVerificacaoUsuario['message'])) {
                        echo '<p class="mb-4 mx-2">' . htmlspecialchars($resultadoVerificacaoUsuario['message']) . '</p>';
                    } else {
                        echo '<p>Ocorreu um erro.</p>';
                    }
                ?>
                <a href="http://localhost/GR-06-2023-2-BG-PATRICK-OLIVEIRA/login" class="btn btn-primary">Volte para a página inicial.</a>
            </div>           
        </div>
        <div class="misc-wrapper">            
            <div class="mt-3">
            <img
                src="assets\img\illustrations\page-misc-error-light.png"
                alt="page-misc-error-light"
                width="300"
                class="img-fluid"
                data-app-dark-img="illustrations/page-misc-error-dark.png"
                data-app-light-img="illustrations/page-misc-error-light.png"
                style="margin-left: 10%; width:80%;"
            />
            </div>
        </div>
    </div>

</body>
</html>