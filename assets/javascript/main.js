function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}