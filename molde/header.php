<?php
include_once("../source/config/root_diretories.php");

?>

<header>
  <div class="max-width-page-limit">
    <section class="max-width-content-limit header-distribuition">
      <nav class="logo-and-nav">
        <input type="checkbox" id="menu-check">
        <label class="menu-hamburguer" for="menu-check">
          <i class="menu-bar fa-solid fa-bars"></i>
        </label>

        <!-- Menu Responsivo - Lateral do Site -->
        <div class="background-side-space">
          <label for="menu-check"></label>
        </div>

        <div class="menu-side-space">

          <div class="header-side-space">
            <div class="search-side-space">
              <input type="text" id="searchInputSideSpace" placeholder="Pesquisar">
            </div>
            <label class="close-menu" for="menu-check">
              <i class="fa-sharp fa-solid fa-xmark"></i>
            </label>
          </div>
          <hr>

          <div class="distribuition-butons-side-space">
            <div>
              <i class="fa-solid fa-shop"></i>
              <h3>Restaurantes</h3>
            </div>

            <div>
              <i class="fa-sharp fa-solid fa-circle-info"></i>
              <h3>Sobre Nós</h3>
            </div>

            <div>
              <i class="fa-solid fa-user"></i>
              <h3>Criar Conta</h3>
            </div>

            <div>
              <i class="fa-regular fa-user"></i>
              <h3>Entrar</h3>
            </div>
          </div>

          <div class="contact-side-space">
            <div class="info-side-space-contact">
              <h2>Entre em contato conosco</h2>
              <div>
                <span>Email: <br></span>
                <a href="#">conotato@deliveryslg.com</a>
              </div>
              <div class="social-side-space-contact">
                <a href="#"><img src="<?php echo ROOT_PATH ?>/assets/images/footer/instagram-sign.png" alt="Instagram Sign"></a>
                <a href="#"><img src="<?php echo ROOT_PATH ?>/assets/images/footer/facebook-sign.png" alt="Facebook Sign"></a>
                <a href="#"><img src="<?php echo ROOT_PATH ?>/assets/images/footer/twitter-sign.png" alt="Twitter Sign"></a>
                <a href="#"><img src="<?php echo ROOT_PATH ?>/assets/images/footer/linkedin-sign.png" alt="Linkedin Sign"></a>
              </div>
            </div>
          </div>
        </div>

        <!--  -->

        <a href="<?php echo ROOT_PATH . "/index.php" ?>" title="Início"><img src="<?php echo ROOT_PATH ?>/assets/images/Logo-Delivery-SLG.png" alt="Delivery SLG Logo"></a>
        <ul>
          <li><a href="<?php echo ROOT_PATH . "/index.php" ?>">Início</a></li>
          <li><a href="#">Restaurantes</a></li>
          <li><a href="#">Sobre Nós</a></li>
        </ul>
      </nav>
      <div class="search-products">
        <div class="search-bar">
          <input type="text" class="searchProductsInput" placeholder="Comida, empresa, lanche predileto!"
            maxlength="50">
          <img src="<?php echo ROOT_PATH ?>/assets/images/header/lupa-search.png" alt="">
        </div>
      </div>
      <div class="perfil-cad-login">
        <ul>
          <li><a href="#" title="Criar Conta">Criar Conta</a></li>
          <li><button>Entrar</button></li>
        </ul>
      </div>
    </section>
  </div>
</header>