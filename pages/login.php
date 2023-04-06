<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - Delivery SLG</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/all.css">
    <link rel="stylesheet" href="../assets/style/style_login.css">
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
                        <form method="post">
                            <div class="form_align">
                                <label for="E-mail">E-mail ou CPF:</label>
                                <input type="text" id="email" class="cor">
                            </div>
                            <div class="form_align">
                                <label for="number">Senha:</label>
                                <input type="text" id="senha" class="cor">
                            </div>
                            <button type="button" class="btn_logar">
                                <div>Logar</div>
                            </button>
                            <button type="button" class="btn_criarconta">
                                <div>Criar uma conta</div>
                            </button>
                            <a href="#">Esqueci minha senha</a>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include_once('../includes/footer.php'); ?>
</body>

</html>