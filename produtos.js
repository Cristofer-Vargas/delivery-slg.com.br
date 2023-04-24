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
                  ${row.nomeRestaurante}
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
    // .finally(final => {

    // })
    .catch(ex => {
      console.log(ex);
    })
}