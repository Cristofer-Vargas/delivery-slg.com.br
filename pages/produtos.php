<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/controller/produtos_controller.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');
// header("Cache-Control: no-cache, must-revalidate");
?>

<?php include_once('../includes/metas_gerais.php'); ?>
<title>Produtos</title>

<link rel="stylesheet" href="../assets/style/all.css">
<link rel="stylesheet" href="../assets/style/produtos.css">

<link rel="stylesheet" href="../assets/style/media-queries/all.css">
<link rel="stylesheet" href="../assets/style/media-queries/produtos.css">
<script src="/delivery-slg.com.br/assets/javascript/produtos.js" defer></script>
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
        <?php
        if (isset($_GET['busca']) && !empty($_GET['busca'])) {
        ?>
          <div class="resultado-busca">
            <p>Resutado para "<span class="busca"><?= $_GET['busca'] ?></span>"</p>
          </div>
        <?php
        } else if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
        ?>
          <div class="resultado-busca">
            <p>Resutado para categoria "<span class="busca"><?= $_GET['categoria'] ?></span>"</p>
          </div>
        <?php
        }
        ?>
        <div class="produtos-main-container">
          <div class="produtos-filtro">
            <div class="filtros-container">
              <h2 class="filtro-title">Filtros</h2>
              <div class="filtro-btn">
                <?php
                if (isset($_GET['busca']) || isset($_GET['categoria'])) {
                  ?>
                    <div class="filtro limpar-filtro"><a href="produtos.php">Limpar Filtro</a></div>
                  <?php
                } else {
                  ?>
                  <div class="filtro"><p onclick="Filtrar('preco', 'desc')">Maior Preço</p></div>
                  <div class="filtro"><p onclick="Filtrar('preco', 'asc')">Menor Preço</p></div>
                  <div class="filtro"><p onclick="Filtrar('categoria', 'desc')">Categoria Decrescente</p></div>
                  <div class="filtro"><p onclick="Filtrar('categoria', 'asc')">Categoria Crescente</p></div>
                  <div class="filtro"><p onclick="Filtrar('id_Restaurante', 'asc')">Restaurante Decrescente</p></div>
                  <div class="filtro"><p onclick="Filtrar('id_Restaurante', 'desc')">Restaurante Crescente</p></div>
                  <?php
                }
                ?>
              </div>
            </div>
          </div>

          <div class="produtos-cards-lista" id="produtosCardLista">

            <?php
            $controller = new ProdutosController();
            if (isset($_GET) && (isset($_GET['campo']) && isset($_GET['ordem'])) || isset($_GET['busca']) || isset($_GET['categoria'])) {

              if (isset($_GET['busca'])) {
                $busca = addslashes(filter_input(INPUT_GET, 'busca'));
                try {
                  $produtos = $controller->BuscarProdutosPorNome($busca);
                } catch (Exception $ex) {
                  MsgPerssonalizadaDeErro();
                }
              } else if (isset($_GET['categoria'])) {
                $categoria = addslashes(filter_input(INPUT_GET, 'categoria'));
                try {
                  $produtos = $controller->BuscarProdutosPorCategoria($categoria);
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
                    <button onclick="adicionarAoCarrinho(<?= $row->getId() ?>)" class="btn-adicionar-carrinho">
                      Adicionar ao carrinho
                    </button>
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