<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/controller/produtos_controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');
// header("Cache-Control: no-cache, must-revalidate");
?>

  <?php include_once('../includes/metas_gerais.php'); ?>
  <title>Produtos</title>

  <link rel="stylesheet" href="../assets/style/produtos.css">

  <link rel="stylesheet" href="../assets/style/media-queries/all.css">
  <link rel="stylesheet" href="../assets/style/media-queries/produtos.css">
</head>

<body>
  <?php include('../includes/header.php'); ?>
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
        <?php 
          if (!isset($_GET['busca'])) {
            ?>
          <div class="produtos-filtro">
            <div class="filtros-container">
              <h2 class="filtro-title">Filtros</h2>
              <div class="filtro-btn">
                <?php
                if (isset($_GET) && isset($_GET['campo']) || isset($_GET['ordem'])) {
                  ?>
                    <div class="filtro limpar-filtro"><a href="produtos.php">Limpar Filtro</a></div>
                  <?php
                }
                ?>
                <div class="filtro"><a href="produtos.php?campo=preco&ordem=desc">Maior Preço</a></div>
                <div class="filtro"><a href="produtos.php?campo=preco&ordem=asc">Menor Preço</a></div>
                <div class="filtro"><a href="produtos.php?campo=categoria&ordem=desc">Categoria Decrescente</a></div>
                <div class="filtro"><a href="produtos.php?campo=categoria&ordem=asc">Categoria Crescente</a></div>
                <div class="filtro"><a href="produtos.php?campo=id_Restaurante&ordem=desc">Restaurante Decrescente</a></div>
                <div class="filtro"><a href="produtos.php?campo=id_Restaurante&ordem=asc">Restaurante Crescente</a></div>
              </div>
            </div>
          </div>
            <?php
          }
        ?>

          <div class="produtos-cards-lista">

          <?php 
          $controller = new ProdutosController();
          if (isset($_GET) && (isset($_GET['campo']) && isset($_GET['ordem'])) || isset($_GET['busca'])) {

            if (isset($_GET['campo']) && isset($_GET['ordem'])){
              $campo = addslashes(filter_input(INPUT_GET, 'campo'));
              $ordem = addslashes(filter_input(INPUT_GET, 'ordem'));
              try {
                $produtos = $controller->BuscarProdutosComFiltro($campo, $ordem);
              } catch (Exception $ex) {
                MsgPerssonalizadaDeErro();
              }
            }

            if (isset($_GET['busca'])) {
              $busca = addslashes(filter_input(INPUT_GET, 'busca'));
              try {
                $produtos = $controller->BuscarProdutosPorNome($busca);
              } catch (Exception $ex) {
                MsgPerssonalizadaDeErro();
              }
            }

          } else {
            $produtos = $controller->BuscarProdutos();
          }


          if (!empty($produtos)) {
            foreach ($produtos as $row) : 
            ?>

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
                  <a href="./produtos.php?adc-car=<?= $row->getId() ?>" class="btn-adicionar-carrinho">
                    Adicionar ao carrinho
                  </a>
                </div>
              </div>
            </div>

            <?php endforeach; 
          } else {
            echo "Não foi possível retornar resusltados!";
          }
          ?>

          </div>
        </div>
      </section>
    </div>

  </main>
  <?php include_once('../includes/footer.php'); ?>
</body>

</html>