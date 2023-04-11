<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/controller/produtos_controller.php');
?>

  <?php include_once('../includes/metas_gerais.php'); ?>
  <title>Produtos</title>

  <link rel="stylesheet" href="../assets/style/produtos.css">

  <link rel="stylesheet" href="../assets/style/media-queries/all.css">
  <link rel="stylesheet" href="../assets/style/media-queries/produtos.css">
</head>

<body>
  <?php include_once('../includes/header.php'); ?>
  <main>

    <div class="max-width-page-limit">
      <picture class="banner-delivery">
        <source media="(max-width: 480px)" srcset="../assets/images/main/produtos/banner-delivery-480">
        <source media="(max-width: 768px)" srcset="../assets/images/main/produtos/banner-delivery-768">
        <img src="../assets/images/main/produtos/banner-delivery-medio-baixo.jpg" alt="Banner delivery slg A cozinha que você ama, entregue na sua casa.">
      </picture>
    </div>

    <div class="max-width-page-limit">
      <section class="max-width-content-limit main-content">
        <div class="produtos-main-container">

          <div class="produtos-filtro">
            <div class="filtros-container">
              <h2 class="filtro-title">Filtros</h2>
              <div class="filtro-btn">
                <div class="filtro"><a href="./produtos.php?filtro=preco&ordem=desc">Maior Preço</a></div>
                <div class="filtro">Menor Preço</div>
                <div class="filtro">Categoria Crescente</div>
                <div class="filtro">Categoria Decrescente</div>
                <div class="filtro">Restaurante Crescente</div>
                <div class="filtro">Restaurante Decrescente</div>
              </div>
            </div>
          </div>

          <div class="produtos-cards-lista">

          <?php 
          $controller = new ProdutosController();
          //Verificar se tem item no $_GET e armazenar na variavel que vai buscar no foreach se nao, busca por todos mesmo
          if (isset($_GET)) {
            $preco = addslashes(filter_input(INPUT_GET, 'preco'));
            $ordem = addslashes(filter_input(INPUT_GET, 'ordem'));
            $controller->BuscarProdutosComFiltro($preco, $ordem);
          } else {
            $controller->BuscarProdutos();
          }

          foreach ($controller as $row) : ?>

            <div class="card-produto">
              <div class="nome-image-restaurante">
                <div class="restaurante-name">
                  <i class="fa-solid fa-shop"></i>
                  <span>
                  <?= $controller->BuscarNomeRestaurante($row->getId_Restaurante()) ?></span>
                </div>
                <div>
                  <img src="<?= $row->getImagem() ?>" alt="<?= $row->getNome() ?>">
                </div>
              </div>
              <div class="informacoes-restaurante flip-card">
                <div class="produto-nome-preco card-front">
                  <h2><?= $row->getNome() ?></h2>
                  <div class="produto-preco">
                    <span class="tipo-preco">
                      R$
                    </span>
                    <span class="valor-produto">
                      <?= $row->getPreco() ?>
                    </span>
                  </div>
                </div>
                <div class="card-back">
                  <p>
                    <?= $row->getDescricao() ?>
                  </p>
                  <button class="btn-adicionar-carrinho">
                    Adicionar ao carrinho
                  </button>
                </div>
              </div>
            </div>

            <?php endforeach; ?>

          </div>
        </div>
      </section>
    </div>

  </main>
  <?php include_once('../includes/footer.php'); ?>
</body>

</html>