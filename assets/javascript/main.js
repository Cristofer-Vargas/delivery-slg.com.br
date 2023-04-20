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

// Adicionar conteudo ao carrinho

document.addEventListener('DOMContentLoaded', () => {
  buscarQuantidadeNoCarrinho()
})

function adicionarAoCarrinho(idProduto) {
  // colocar com classe ou algo do tipo, um icone de carregando
  fetch(`/delivery-slg.com.br/source/controller/header_controller.php?adc-car=${idProduto}`)
  .then(res => {
    if (res.ok == false) {
      throw new Error('Erro em acessar o servidor.');
    }
    return res.json();
  })
  .then(response => {
    console.log(response);
  })
  // .then((data) => {
  //   console.log(data);
    
  //   // let html = document.getElementById('notificationPhpJsContainer')
  //   // html.insertAdjacentHTML('beforeend', NotificationDiv(true, data))
  //   // html.classList.add('mostrar')
  //   // setTimeout(() => {
  //   //   html.classList.add('esconder')
  //   //   setTimeout(() => {
  //   //     html.remove();
  //   //   }, 500)
  //   // }, 3000)
  //})
  .finally(() => {
    buscarQuantidadeNoCarrinho();
  })
  .catch(error => {
    console.error(error);
  });
  // com finally tirar o icone de adicionado com sucesso
}

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

function buscarQuantidadeNoCarrinho() {
  //colocar icone carregando
  fetch(`/delivery-slg.com.br/source/controller/header_controller.php?action=bsc-qtde-car`)
  .then(res => {
    if (res.ok == false) {
      throw new Error('Erro em acessar o servidor')
    }
    return res.json()
  })
  .then(response => {
    console.log(response)
    const labelNumberCar = document.getElementById('carrinhoContainer')
    labelNumberCar.insertAdjacentHTML('beforeend', `
      <span>
        ${response.buscaNumProds.dados}
      </span>
    `)
  })
  .catch(error => {
    console.log(error)
  })
  // com finally, tirar icone de carregando
}

function BuscarProdutos() {
  fetch('/delivery-slg.com.br/source/controller/header_controller.php?action=buscar-prods')
  .then(res => {
    return res.json();
  })
  .then(data => {
    console.log(data);
  })
}