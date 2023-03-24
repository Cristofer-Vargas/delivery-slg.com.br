<?php
include_once("./source/config/root_diretories.php");
include_once(ROOT_PATH . "/molde/estilo_geral.php");
?>


<?php include_once(ROOT_PATH . '/molde/estilo_geral.php') ?>>
<title>Página Inicial</title>
<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/assets/style/index.css">

<link rel="stylesheet" href="<?php echo ROOT_PATH ?>/style/media-queries/all.css" media="(max-width: 1100px)">

</head>

<body>

  <!-- <div id="headInsert"></div> -->
  <?php include_once(ROOT_PATH . '/molde/header.php'); ?>

  <main>
    <div class="max-width-page-limit">
      <section class="max-width-content-limit main-content">
        <div class="apresentation-section">
          <div class="apresentation-text">
            <h1>Nós temos o que você procura!</h1>
            <p>Bem-vindo ao nosso <span class="apresentation-mark">serviço de delivery</span>! Com nosso cardápio
              variado, você pode pedir suas comidas
              favoritas e recebê-las em <span class="apresentation-mark">casa</span>. Não se preocupe com o trânsito,
              estacionamento ou filas nos restaurantes -
              nós levamos a comida até você. Temos opções para todos os gostos e necessidades, desde pratos <span class="apresentation-mark">veganos</span> e
              <span class="apresentation-mark">vegetarianos</span> até opções sem <span class="apresentation-mark">glúten</span>. Faça seu pedido agora e experimente a comodidade e a qualidade
              dos
              nossos serviços de delivery!
            </p>
          </div>
          <div class="svg-apresentation">
            <img src="./images/main/index/delivery-apresentation-svg.svg" alt="Apresentação Delivery, mulher com lanche">
          </div>
        </div>
      </section>
    </div>

    <div class="categoria-section">
      <div class="title-tag-section">
        O Que Temos
      </div>
      <div class="categoria-wave">
        <img class="first-wave" src="./images/wave-divisor.svg" alt="">
      </div>

      <div class="categoria-icones">
        <div>
          <div>
            <img src="./images/icones/sorvete-icon.png" alt="Sorvete categoria">
          </div>
          <p>Sorvete</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/pastel-icon.png" alt="Pastel categoria">
          </div>
          <p>Pastel</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/pizza-icon.png" alt="Pizza categoria">
          </div>
          <p>Pizza</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/acai-icon.png" alt="Açai categoria">
          </div>
          <p>Açai</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/frango-frito-icon.png" alt="Frango frito categoria">
          </div>
          <p>Frango Frito</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/hamburguer-icon.png" alt="Hamburguer categoria">
          </div>
          <p>Hamburguer</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/cachorro-quente-icon.png" alt="Cachorro quente categoria">
          </div>
          <p>Cachorro Quente</p>
        </div>

        <div>
          <div>
            <img src="./images/icones/x-burger-icon.png" alt="X-Burguer categoria">
          </div>
          <p>X-Burguer</p>
        </div>

      </div>

      <div class="categoria-wave">
        <img class="last-wave" src="./images/wave-divisor.svg" alt="">
      </div>
    </div>


    <div class="max-width-page-limit">
      <section class="max-width-content-limit main-content">

      </section>
    </div>
  </main>

  <?php include_once(ROOT_PATH . '/molde/footer.php'); ?>

  <!-- <div id="footerInsert"></div> -->

  <!-- <script src="./js/include.js"></script> -->
</body>

</html>