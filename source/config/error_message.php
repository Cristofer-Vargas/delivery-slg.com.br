<?php

function MsgPerssonalizadaDeErro() {
  if (isset($_SESSION) && isset($_SESSION['mensagemError']) && $_SESSION['erroSucessOrFail'] == false) {
    ?>

      <div class="notification notification-error">
        <div class="notification-title notification-title-error">
          <i class="fa-solid fa-circle-xmark"></i>
          <span>A operação falhou!</span>
        </div>  
        <div class="notification-mesage">
          <?= $_SESSION['mensagemError'] ?> </br>
        </div>
      </div>

      <?php
      unset($_SESSION['mensagemError'], $_SESSION['erroSucessOrFail']);
  }
  
  if (isset($_SESSION) && isset($_SESSION['mensagemError']) && $_SESSION['erroSucessOrFail'] == true) {
    ?>

      <div class="notification notification-sucess">
        <div class="notification-title notification-title-sucess">
          <i class="fa-solid fa-circle-check"></i>
          <span>Sucesso!</span>
        </div>
        <div class="notification-mesage">
          <?= $_SESSION['mensagemError'] ?> </br>
        </div>
      </div>

    <?php
  unset($_SESSION['mensagemError'], $_SESSION['erroSucessOrFail']);
  }

}