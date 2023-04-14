<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/media-queries/all.css">
    <link rel="stylesheet" href="../assets/style/login.css">
    <link rel="stylesheet" href="../assets/style/cadastrousuario.css">
    <title>Cadastro de Usuario</title>
</head>

<body>
    <?php include_once('../includes/header.php'); ?>

    <?php
    require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../source/classes/usuarios.class.php");
    require_once(str_replace('\\', '/', dirname(__FILE__, 2)) . "../source/controller/cadusuario.controller.php");

    $usuarios = new Usuarios ();

        $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    
        if ($nome && $cpf) {
    
            $usuarios->setNome($nome);
            $usuarios->setEmail($email);
            $usuarios->setSenha($senha);
            $usuarios->setCpf($cpf);
            $usuarios->setTelefone($telefone);
    
            $dao = new cadUsuarioController();
            $resultado = $dao->cadastrarUsuario($usuarios);
            if ($resultado) {
                $_SESSION['mensagem'] = "Criado com sucesso.";
                $_SESSION['sucesso'] = true;
            } else {
                $_SESSION['mensagem'] = "Erro ao criar.";
                $_SESSION['sucesso'] = false;
            }
            
        } else {
            $_SESSION['mensagem'] = "Campos obrigatórios : Nome e CPF devem ser informados.";
            $_SESSION['sucesso'] = false;
            
        }
    
    




    ?>
    <main>

        <div class="max-width-page-limit">
            <section class="max-width-content-limit main-content">
                <div class="cadastrousuario-main-container">
                    <h1>Cadastro</h1>
                    <p>Cadastrar com e-mail e senha</p>
                    <form class="form-usuario" method="POST">
                        <div class="nome">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="email">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="senha">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                        </div>
                        <div class="cpf">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf">
                        </div>
                        <div class="telefone">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone">
                        </div>

                        <button type="submit" class="btn-btn-primary btn_logar">Cadastrar</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
    <footer>
        <?php include_once('../includes/footer.php'); ?>

    </footer>
</body>

</html>