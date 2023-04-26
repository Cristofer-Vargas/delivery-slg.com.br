<?php
require_once('../includes/metas_gerais.php');
?>
    <title>Página de Login - Delivery SLG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style/flex.css">
    <link rel="stylesheet" href="../assets/style/all.css">
    <link rel="stylesheet" href="../assets/style/login.css">
    <link rel="stylesheet" href="../assets/style/media-queries/login.css">
    <link rel="stylesheet" href="../assets/style/media-queries/all.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                                <label class="style_label" for="E-mail">E-mail ou CPF:</label>
                                <input type="text" class="cor" id="email" name="email">
                            </div>
                            <div class="form_align">
                                <label class="style_label" for="senha">Senha:</label>
                                <input type="password" class="cor" id="senha" name="senha">
                            </div>
                            <button type="submit" class="btn_logar">
                                <div>Logar</div>
                            </button>
                            <a href="/delivery-slg.com.br/pages/cadastrousuario.php" class="btn_criarconta">
                                <div>Criar uma conta</div>
                            </a>
                            <a href="#" class="style_link" data-bs-toggle="modal" data-bs-target="#ModalEsqueciSenha">Esqueci minha senha</a>
                            <?php
                            if (isset($_SESSION) && isset($_SESSION['mensagem'])) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $_SESSION['mensagem']; ?>
                                </div>
                            <?php unset($_SESSION['mensagem']);
                            }
                            ?>
                            <div class="separador">
                                <hr>
                                <span>OU</span>
                                <hr>
                            </div>
                            <a href="./loginempresa.php" class="btn_loginempresa">Logar como empresa</a>
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