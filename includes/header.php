<?php
// Verificar a partir da sessão se o usuário esta logado ou não, 
// e mostrar um cabeçalho diferente: perfil e carrinho
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/delivery-slg.com.br/source/config/error_message.php');

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
            <a href="#">
              <i class="fa-solid fa-shop"></i>
              <h3>Restaurantes</h3>
            </a>

            <a href="/delivery-slg.com.br/pages/cadastroempresa.php">
              <i class="fa-solid fa-shop"></i>
              <h3>Cadastrar Restaurante</h3>
            </a>

            <a href="/delivery-slg.com.br/index.php#sobre-nos-sessao" onclick="levarAoSobreNos()">
              <i class="fa-sharp fa-solid fa-circle-info"></i>
              <h3>Sobre Nós</h3>
            </a>

            <a href="/delivery-slg.com.br/pages/cadastrousuario.php">
              <i class="fa-solid fa-user"></i>
              <h3>Criar Conta</h3>
            </a>

            <a href="/delivery-slg.com.br/pages/login.php">
              <i class="fa-regular fa-user"></i>
              <h3>Entrar</h3>
            </a>
          </div>

          <div class="contact-side-space">
            <div class="info-side-space-contact">
              <h2>Entre em contato conosco</h2>
              <div>
                <span>Email: <br></span>
                <a href="#">contato@deliveryslg.com</a>
              </div>
              <div class="social-side-space-contact">
                <a href="#"><img src="/delivery-slg.com.br/assets/images/footer/instagram-sign.png" alt="Instagram Sign"></a>
                <a href="#"><img src="/delivery-slg.com.br/assets/images/footer/facebook-sign.png" alt="Facebook Sign"></a>
                <a href="#"><img src="/delivery-slg.com.br/assets/images/footer/twitter-sign.png" alt="Twitter Sign"></a>
                <a href="#"><img src="/delivery-slg.com.br/assets/images/footer/linkedin-sign.png" alt="Linkedin Sign"></a>
              </div>
            </div>
          </div>
        </div>
        <!--  -->

        <a href="/delivery-slg.com.br/index.php" title="Início">
          <img src="/delivery-slg.com.br/assets/images/Logo-Delivery-SLG.png" alt="Delivery SLG Logo">
        </a>
        <ul>
          <li><a href="/delivery-slg.com.br/index.php">Início</a></li>
          <li><a href="#">Restaurantes</a></li>
          <li><a href="#sobre-nos-sessao" onclick="levarAoSobreNos()">Sobre Nós</a></li>
        </ul>
      </nav>

      <div class="search-products">
        <div class="search-bar">
          <input id="searchProductsInput" type="text" class="searchProductsInput" placeholder="Ache seu lanche da vez!" maxlength="50">
          <img src="/delivery-slg.com.br/assets/images/header/lupa-search.png" alt="">
        </div>
      </div>

      <!-- <div class="perfil-cad-login">
        <ul>
          <li><a class="perfil-cad-criar-conta" href="/delivery-slg.com.br/pages/cadastrousuario.php" title="Criar Conta">Criar Conta</a></li>
          <li><a class="button-entrar" href="/delivery-slg.com.br/pages/login.php">Entrar</a></li>
        </ul>
      </div> -->

      <div class="perfil-logged">
        <ul>
          <li class="carrinho-container">
            <label for="carrinhoLateralInput">
              <i class="fa-solid fa-cart-shopping"></i>
            </label>
            <span>
              1
              <!-- Na tabela carrinho da para usar a função rowCount()
              para trazer o número de itens no carrinho -->
            </span>

          </li>
          <li class="login-container">
            <a title="Perfil" href="/delivery-slg.com.br/pages/perfilusuario.php">
              <i class="fa-solid fa-circle-user"></i>
            </a>
          </li>
        </ul>
      </div>

    </section>
  </div>
</header>

<input type="checkbox" id="carrinhoLateralInput">

<div class="carrinho-lateral-background">
  <label class="disable-carrinho-lateral" for="carrinhoLateralInput"></label>
  <div class="carrinho-lateral-container">
    
  </div>
</div>