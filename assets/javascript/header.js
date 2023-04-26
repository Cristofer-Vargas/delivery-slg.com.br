function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}

document.addEventListener('DOMContentLoaded', () => {
  BuscarCarrinhoDoUsuario();
})

document.getElementById('searchProductsInput')
  .addEventListener('keydown', (event) => {

    if (event.key == 'Enter') {
      let searchBarValue = document.getElementById('searchProductsInput').value;
      window.location.href = `/delivery-slg.com.br/pages/produtos.php?busca=${searchBarValue}`;
    }
  })

function BuscarCarrinhoDoUsuario() {
  //colocar icone carregando
  fetch(`/delivery-slg.com.br/source/controller/header_controller.php?action=buscar-prods-usuario`)
    .then(res => {
      if (res.ok == false) {
        throw new Error('Erro em acessar o servidor')
      }
      return res.json()
    })
    .then(data => {
      if (data.msg.login.ok == false) {

      } else {
        const labelNumberCar = document.getElementById('carrinhoContainer')
        const carrinhoContainer = document.getElementById('carrinhoItensContainer');
        console.log(data.dados)
        if (data.dados == false) {
          let numProds = '0';
          labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `)
          carrinhoContainer.innerHTML = '';
        } else if(data.dados == null || data.dados == undefined) {
          carrinhoContainer.innerHTML = ''
          carrinhoContainer.insertAdjacentHTML('beforeend' , '')

        } else {
          let numProds = data.dados.length;

          labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `
          )

          carrinhoContainer.innerHTML = ''

          let valorSubTotal = 0;
          const prodsCar = data.dados;
          const idRes = [];

          prodsCar.forEach(row => {
            carrinhoContainer.insertAdjacentHTML('beforeend', `
              <div class="pedido-item">
                <div class="image-container">
                  <div class="image" style="background-image: url('${row.produto_Imagem}')">
                  </div>
                  <div class="carrinho-restaurante-nome">
                    <i class="fa-solid fa-shop"></i>
                    <span>${row.nome_Restaurante}</span>
                  </div>
                </div>
                <div class="carrinho-nome-produto">
                  <h4>${row.produto_Nome}</h4>
                  <span class="carrinho-produto-valor">${row.produto_Preco}</span>
                  <div class="carrinho-quantidade-items">
                    <i class="fa-solid fa-caret-left"></i>
                    <span class="quantidade-item">${row.quantidade}</span>
                    <i class="fa-solid fa-caret-right"></i>
                  </div>
                  <p class="remover-prod" onclick="removerDoCarrinho(${row.id})">Remover</p>
                </div>
              </div>
            `)
            valorSubTotal += Number(row.produto_Preco);

            idRes.push(row.id_Restaurante);
          });

          const x = [...new Set(idRes)]

          let valorEntregaCarrinho = document.getElementById('valorEntregaCarrinho')
          let valorEntrega = Number(x.length * 7);
          valorEntregaCarrinho.innerHTML = `R$ 7,00 / restaurante = R$ ${valorEntrega.toFixed(2).replace('.', ',')}`

          let subTotalCarrinho = document.getElementById('subTotalCarrinho');
          subTotalCarrinho.innerHTML = `R$ ${valorSubTotal.toFixed(2).replace('.', ',')}`

          let valorTotalCarrinho = document.getElementById('valorTotalCarrinho');
          let valorTotal = valorSubTotal + valorEntrega;
          valorTotalCarrinho.innerHTML = `R$ ${valorTotal.toFixed(2).replace('.', ',')}`
        }
      }
    }
    )
    .catch(error => {
      console.log(error)
    })
  // com finally, tirar icone de carregando
}

function removerDoCarrinho(idNoCarrinho) {
  let formData = new FormData;
  formData.append('id', idNoCarrinho)

  fetch(`/delivery-slg.com.br/source/controller/header_controller.php`, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(res => {
      // if (res.msg.validacao.ok == true) {
      //   console.log(res.msg.validacao.mensagem);
      // }
    })
    .finally(() => {
      BuscarCarrinhoDoUsuario();
    })
    .catch(error => {
      console.log(error);
    })
}