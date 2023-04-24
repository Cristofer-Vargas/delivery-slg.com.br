function levarAoSobreNos() {
  if (window.location.href.indexOf("/delivery-slg.com.br/index.php") > -1) {
    document.getElementById('sobreNosSsessao').scrollIntoView({ behavior: 'smooth' });

  } else {
    window.location.href = "/delivery-slg.com.br/index.php#sobreNosSsessao";
  }
}

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
      console.log(data);
      if (data.msg.login.ok == false) {

      } else {
        let numProds;
        const labelNumberCar = document.getElementById('carrinhoContainer')

        if (data.dados == false) {
          numProds = '0';
        } else {
          numProds = data.dados.length;


          labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `
          )

          const carrinhoContainer = document.getElementById('carrinhoItensContainer');
          carrinhoContainer.innerHTML = ''
          let prodsCar = data.dados;
          prodsCar.forEach(row => {
            console.log(row);
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
                  <a href="#">Remover</a>
                </div>
              </div>
            `)  
          });
        }
      }
    }
    )
    .catch(error => {
      console.log(error)
    })
  // com finally, tirar icone de carregando
}

document.addEventListener('DOMContentLoaded', () => {
  BuscarCarrinhoDoUsuario();
})