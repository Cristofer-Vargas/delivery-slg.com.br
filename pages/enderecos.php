<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/controller/enderecos.controller.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro de Endereço - Delivery SLG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/style/flex.css">
    <link rel="stylesheet" href="../assets/style/all.css">
    <link rel="stylesheet" href="../assets/style/media-queries/all.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <?php include_once('../includes/header.php'); ?>
    <?php
    $controller = new EnderecosController();
    $enderecos = $controller->buscarEnderecos($_SESSION['id_usuario']);
    $end = new Enderecos();
    $end->setId_Usuario($_SESSION['id_usuario']);
    if (isset($_GET) && isset($_GET['key'])) {
        $id = filter_input(INPUT_GET, 'key');
        $controller = new EnderecosController();
        $end = $controller->buscarPorId($id);
    }
    ?>
    <main>
        <div class="max-width-page-limit">
            <section class="max-width-content-limit main-content">
                <h1>Cadastro de Endereço</h1>
                <form method="POST" action="../source/controller/enderecos.controller.php?acao=salvar">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-9">
                            <label for="rua" class="form-label">Rua:</label>
                            <input type="text" class="form-control" name="rua" value="<?= $end->getRua() ?>">
                            <input type="hidden" value="<?= $end->getId_Usuario() ?>" name="id_usuario">
                            <input type="hidden" value="<?= $end->getId() ?>" name="id">
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <label for="numero" class="form-label">Número:</label>
                            <input type="text" class="form-control" name="numero" value="<?= $end->getNumero() ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="complemento" class="form-label">Complemento:</label>
                            <input type="text" class="form-control" name="complemento" value="<?= $end->getComplemento() ?>">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="bairro" class="form-label">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" value="<?= $end->getBairro() ?>">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary">Cadastrar Endereço</button>
                        <a href="enderecos.php" class="btn">Limpar Campos</a>
                    </div>
                </form>
                <?php
                if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == true) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?= $_SESSION['mensagem']; ?>
                    </div>
                <?php
                }
                if (isset($_SESSION) && isset($_SESSION['sucesso']) && $_SESSION['sucesso'] == false) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $_SESSION['mensagem']; ?>
                    </div>
                <?php
                }
                unset($_SESSION['mensagem']);
                unset($_SESSION['sucesso']);
                ?>
                <hr>
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rua</th>
                            <th scope="col">Número</th>
                            <th scope="col">Complemento</th>
                            <th scope="col">Bairro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($enderecos as $e) :
                        ?>
                            <tr>
                                <td><?= $e->getId(); ?></td>
                                <td><?= $e->getRua(); ?></td>
                                <td><?= $e->getNumero(); ?></td>
                                <td><?= $e->getComplemento(); ?></td>
                                <td><?= $e->getBairro(); ?></td>
                                <td>
                                    <a class="btn btn-light" href="enderecos.php?key=<?= $e->getId() ?>">Editar</a>
                                    <a class="btn btn-light" href="../source/config/excluir_endereco.php?key=<?= $e->getId() ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>

            </section>
        </div>
    </main>



    <?php include_once('../includes/footer.php'); ?>
</body>

</html>