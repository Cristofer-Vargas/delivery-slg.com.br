function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}

// Tempo da notificação na tela

const notification = document.querySelector('.notification');
const tempoVisivel = 5000;

if (notification !== null) {
  notification.classList.add('show');
}

const removerNotification = () => {
  notification.classList.add('hidden');
  setTimeout(() => {
    // Espera o tempo de transição do fade-out antes de remover o elemento
    notification.remove();
  }, 500);
};

if (notification !== null) {
  setTimeout(removerNotification, tempoVisivel);
}

// Input de busca do HEADER

document.getElementById('searchProductsInput')
.addEventListener('keydown', (event) => {

  if(event.key == 'Enter') {
    let searchBarValue = document.getElementById('searchProductsInput').value;
    window.location.href = `/delivery-slg.com.br/pages/produtos.php?busca=${searchBarValue}`;
  }

})