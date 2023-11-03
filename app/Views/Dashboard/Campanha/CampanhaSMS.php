<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campanha SMS</title>
</head>
<body>
    
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Campanha/</span> Envio de SMS</h4>
        <!-- Basic Layout & Basic with Icons -->
        <div class="row">
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Envio de SMS</h5>
                        <small class="text-muted float-end">Não nos responsabilizamos por números inseridos errados.</small>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nome da campanha</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname" placeholder="Promoção iFood: Lanches por até R$ 4,99!" aria-label="Campanha IFood" aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-phone">Número</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                                    <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" placeholder="21996026077" aria-label="658 799 8941" aria-describedby="basic-icon-default-phone2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-message">Mensagem</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                                    <textarea id="basic-icon-default-message" class="form-control" placeholder="O iFood traz uma oferta especial para você satisfazer aquela fome com deliciosos lanches por um preço incrível! Por tempo limitado." aria-label="" aria-describedby="basic-icon-default-message2" cols="4"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="phone-frame">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="phone-message">
                            <h2></h2>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->

<script>
    // JavaScript
    const phoneFrame = document.querySelector('.phone-frame');
    const phoneMessage = document.querySelector('.phone-message');

    // Atualiza a mensagem do celular com os valores dos inputs
    function updatePhoneMessage() {
        const campanha = document.querySelector('#basic-icon-default-fullname').value;
        const mensagem = document.querySelector('#basic-icon-default-message').value;

        phoneMessage.innerHTML = `
            <h2>${campanha}</h2>
            <p>${mensagem}</p>
        `;
    }

// Atualiza a mensagem do celular quando os inputs são alterados
document.querySelector('form').addEventListener('input', updatePhoneMessage);
</script>

<style>
.phone-frame {
  position: relative;
  width: 360px;
  height: 600px;
  margin: auto;
  border: 16px #f2f2f2 solid;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  background-color: white;
}

.phone-notch {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 10rem;
  height: 40px;
  background-color: #5b5b5b;
}

.phone-screen {
  position: relative;
  width: 320px;
  height: 560px;
  margin: auto;
  border: 1px black #b5b5b5;
  border-radius: 10px;
}

.phone-message {
  position: absolute;
  top: 100px;
  left: 50px;
  width: 220px;
  height: 400px;
  background-color: white;
  padding: 20px;
  border-radius: 10px;
}

.phone-screen::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 320px;
  height: 560px;
  background-color: black;
  opacity: 0.1;
  border-radius: 10px;
}

.phone-screen::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 320px;
  height: 10px;
  background-color: black;
  opacity: 0.2;
  border-radius: 10px;
}

h2 {
  font-size: 20px;
  margin-bottom: 10px;
  font-family: Helvetica, sans-serif;
  font-weight: bold;
}

p {
  font-size: 16px;
  line-height: 24px;
  font-family: Helvetica, sans-serif;
}
</style>

</body>
</html>
