function NotificationDiv(bool, conteudo) {

  if (bool == true) {
    let notification = `
      <div class="notificationJS notificationTrue">
        ${conteudo}
      </div>
    `
    return notification

  } else if (bool == false) {
    let notification = `
      <div class="notificationJS notificationFalse">
        ${conteudo}
      </div>
    `
    return notification
  } else {
    let divErro = `
    <div>
      <p>Erro com a integração da notificação</p>
    </div>
    `
    return divErro
  }
}

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