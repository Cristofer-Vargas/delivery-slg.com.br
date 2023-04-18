<?php

if (isset($_POST) && !empty($_POST['adc-car'])) {
  $idProduto = addslashes(filter_input(INPUT_POST, 'adc-car'));

  
}