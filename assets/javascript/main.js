function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}

const notification = document.querySelector('.notification');
notification.classList.add('show');

const tempoVisivel = 5000;

// Define uma função para remover a notificação após o tempo visível
const removerNotification = () => {
  notification.classList.add('hidden');
  // Espera o tempo de transição do fade-out antes de remover o elemento
  setTimeout(() => {
    notification.remove();
  }, 500);
};

// Chama a função para remover a notificação após o tempo visível
setTimeout(removerNotification, tempoVisivel);


document.addEventListener('keydown', (event) => {

  if(event.key === 'Enter') {
    let searchBarValue = document.getElementById('searchProductsInput').value;
    window.location.href = `/delivery-slg.com.br/pages/produtos.php?busca=${searchBarValue}`;
  }

})