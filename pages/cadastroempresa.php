<?php 
  include_once("../source/config/root_diretories.php");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cadastro de empresa</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="../assets/images/Logo-Delivery-SLG.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/assets/style/all.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/assets/style/cadastroempresa.css">
  
  <link rel="stylesheet" href="<?php echo ROOT_PATH ?>/assets/style/media-queries/all.css">

</head>

<body>
  <?php 
  include(ROOT_PATH . '/molde/header.php'); ?>

  <main>
    <div class="max-width-page-limit">
      <section class="max-width-content-limit main-content">
        Conteúdo de <span class="destaque-teste">Cadastro para empresa</span>
      </section>
    </div>
  </main>

  <?php include(ROOT_PATH . '/molde/footer.php'); ?>

</body>

</html>