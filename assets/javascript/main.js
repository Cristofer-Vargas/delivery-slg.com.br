function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}

// Tempo da notificação na tela
{
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

}

// Input de busca do HEADER

{
  document.getElementById('searchProductsInput')
    .addEventListener('keydown', (event) => {

      if (event.key == 'Enter') {
        let searchBarValue = document.getElementById('searchProductsInput').value;
        window.location.href = `/delivery-slg.com.br/pages/produtos.php?busca=${searchBarValue}`;
      }

    })
}

// Adicionar conteudo ao carrinho

document.addEventListener('DOMContentLoaded', () => {
  BuscarProdutosDoUsuario();
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
    .then(data => {
      console.log(data);
      if (data.msg.login.ok == false) {
        const inputPedirLogin = document.getElementById('pedirLogin');
        inputPedirLogin.checked = true;

      }
    })
    .finally(() => {
      BuscarProdutosDoUsuario();
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

function BuscarProdutosDoUsuario() {
  //colocar icone carregando
  fetch(`/delivery-slg.com.br/source/controller/header_controller.php?action=buscar-prods-usuario`)
    .then(res => {
      if (res.ok == false) {
        throw new Error('Erro em acessar o servidor')
      }
      return res.json()
    })
    .then(data => {
      // console.log(data)
      if (data.msg.login.ok == false) {

      } else {
        let numProds = data.dados.length;
        const labelNumberCar = document.getElementById('carrinhoContainer')
        labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `
        )
      }
    }
    )
    .catch(error => {
      console.log(error)
    })
  // com finally, tirar icone de carregando
}

function Filtrar(campo, ordem) {
  let cardsContainer = document.getElementById('produtosCardLista');
  cardsContainer.innerHTML = '';

  fetch(`/delivery-slg.com.br/source/controller/produtos_controller.php?campo=${campo}&ordem=${ordem}`)
    .then(response => {
      if (response.ok == false) {
        throw new Error('Erro em acessar o servidor.');
      }
      return response.json();
    })
    .then(data => {
      console.log(data);
      let produto = data.dados

      if (Object.keys(produto).length === 0) {
        cardsContainer.innerHTML = 'A busca por produtos com esse filtro não trouxe resultados';
      } else {
        produto.forEach(row => {
          cardsContainer.insertAdjacentHTML('beforeend', `
          <div class="card-produto">
            <div class="nome-image-restaurante">
              <div class="restaurante-name">
                <i class="fa-solid fa-shop"></i>
                <span>
                  ${row.nome_restaurante}
                </span>
              </div>
              <div>
                <img src="${row.imagem}" alt="${row.nome}">
              </div>
            </div>
            <div class="informacoes-restaurante flip-card">
              <div class="produto-nome-preco card-front">
                <h2>${row.nome}</h2>
                <div class="produto-preco">
                  <span class="tipo-preco">
                    R$
                  </span>
                  <span class="valor-produto">
                    ${row.preco}
                  </span>
                </div>
              </div>
              <div class="card-back">
                <p>
                  ${row.descricao}
                </p>
                <button onclick="adicionarAoCarrinho(${row.id})" class="btn-adicionar-carrinho">
                  Adicionar ao carrinho
                </button>
              </div>
            </div>
          </div> `
          )
        });
      }
    })
    .finally(final => {

    })
    .catch(ex => {
      console.log(ex);
    })
}