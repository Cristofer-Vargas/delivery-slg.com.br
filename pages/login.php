<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - Delivery SLG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/flex.css">
    <link rel="stylesheet" href="../assets/style/all.css">
    <link rel="stylesheet" href="../assets/style/login.css">
</head>

<body>
    <?php include_once('../includes/header.php'); ?>
    <main>
        <div class="max-width-page-limit">
            <section class="max-width-content-limit main-content">
                <div class="main_content">
                    <h1>Login</h1>
                    <p class="text_bold"> <strong>Se já possui uma conta, faça o login</strong> ou crie o seu cadastro...
                    </p>
                    <div class="divdoform">
                        <form method="POST" action="../source/controller/login.controller.php" class="form-login">
                            <div class="form_align">
                                <label for="E-mail">E-mail ou CPF:</label>
                                <input type="text" class="cor" id="email" name="email">
                            </div>
                            <div class="form_align">
                                <label for="senha">Senha:</label>
                                <input type="password" class="cor" id="senha" name="senha">
                            </div>
                            <button type="submit" class="btn_logar">
                                <div>Logar</div>
                            </button>
                            <a href="#" class="btn_criarconta">
                                <div>Criar uma conta</div>
                            </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEsqueciSenha">Esqueci minha senha</a>
                            <?php
                            if (isset($_SESSION) && isset($_SESSION['mensagem'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $_SESSION['mensagem']; ?>
                                </div>
                            <?php }
                            unset($_SESSION['mensagem']);
                            ?>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <div class="modal fade" id="ModalEsqueciSenha" tabindex="-1" role="dialog" aria-labelledby="TituloEsqueciSenha" aria-hidden="true">
        <?php include_once('./alterasenha.php'); ?>
    </div>

    <?php include_once('../includes/footer.php'); ?>
</body>

</html>