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

const searchBar = document.getElementById('searchProductsInput');
let dropdownBusca = document.getElementById('dropdownBusca');
let containerResultados = document.getElementById('containerResultados');
let HTMLresultadoBusca = document.getElementById('HTMLresultadoBusca')
let timeout;

searchBar.addEventListener('input', () => {
  clearTimeout(timeout);
  timeout = setTimeout(() => {
    let searchBarValue = searchBar.value;

    HTMLresultadoBusca.innerHTML = `Resultado para "<span>${searchBarValue}</span>"`

    if (searchBarValue == '' || searchBarValue == null || searchBarValue == undefined) {
      HTMLresultadoBusca.innerHTML = '';
      dropdownBusca.classList.remove('mostrar');
      dropdownBusca.classList.add('esconder');

    } else {
      dropdownBusca.classList.remove('esconder');
      dropdownBusca.classList.add('mostrar');
      containerResultados.innerHTML = '';

      fetch(`/delivery-slg.com.br/source/controller/header_controller.php?busca=${searchBarValue}`)
        .then(res => res.json())
        .then(response => {
          let prods = response.dados;

          if (prods == [] || prods.length == 0) {
            HTMLresultadoBusca.innerHTML =
              `Não houve resultados para "<span>${searchBarValue}</span>"`
          } else {

            prods.forEach(row => {
              containerResultados.insertAdjacentHTML('beforeend', `
              <div class="resultado-produto">
                  <div class="resultado-image-container">
                    <img src="${row.imagem}" alt="${row.nome}">
                  </div>
                  <div class="produto-description">
                    <h2>${row.nome}</h2>
                    <p>${row.preco}</p>
                    <div onclick="adicionarAoCarrinho(${row.id})" class="resultado-adicionar-ao-carrinho">
                      Adicionar ao carrinho
                    </div>
                  </div>
                </div>
              `)
            })

          }

        })
        .catch(error => {
          console.log(error);
        })
    }
  }, 100);
})


function BuscarCarrinhoDoUsuario() {
  let valorEntregaCarrinho = document.getElementById('valorEntregaCarrinho')
  let subTotalCarrinho = document.getElementById('subTotalCarrinho');
  let valorTotalCarrinho = document.getElementById('valorTotalCarrinho');

  const labelNumberCar = document.getElementById('carrinhoContainer')
  const carrinhoContainer = document.getElementById('carrinhoItensContainer');

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
        if (data.dados == false) {
          let numProds = '0';
          labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `)
          carrinhoContainer.innerHTML = 'Sem produtos no carrinho ...'

          let valorSubTotal = 0.00;
          let valorEntrega = 0.00;
          let valorTotal = valorSubTotal + valorEntrega;

          valorEntregaCarrinho.innerHTML = `R$ 7,00 /restaurante = R$ ${valorEntrega.toFixed(2).replace('.', ',')}`
          subTotalCarrinho.innerHTML = `R$ ${valorSubTotal.toFixed(2).replace('.', ',')}`
          valorTotalCarrinho.innerHTML = `R$ ${valorTotal.toFixed(2).replace('.', ',')}`

        } else {
          let numProds = data.dados.length;

          labelNumberCar.insertAdjacentHTML('beforeend', `
          <span>
            ${numProds}
          </span>
          `
          )

          carrinhoContainer.innerHTML = ''

          let valorSubTotal = 0.00;
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

          let valorEntrega = Number(x.length * 7);
          valorEntregaCarrinho.innerHTML = `R$ 7,00 / restaurante = R$ ${valorEntrega.toFixed(2).replace('.', ',')}`

          subTotalCarrinho.innerHTML = `R$ ${valorSubTotal.toFixed(2).replace('.', ',')}`

          let valorTotal = valorSubTotal + valorEntrega;
          valorTotalCarrinho.innerHTML = `R$ ${valorTotal.toFixed(2).replace('.', ',')}`
        }
      }
    }
    )
    .catch(error => {
      console.log(error)
    })

}

function adicionarAoCarrinho(idProduto) {

  fetch(`/delivery-slg.com.br/source/controller/header_controller.php?adc-car=${idProduto}`)
    .then(res => {
      if (res.ok == false) {
        throw new Error('Erro em acessar o servidor.');
      }
      return res.json();
    })
    .then(data => {
      if (data.msg.login.ok == false) {
        const inputPedirLogin = document.getElementById('pedirLogin');
        inputPedirLogin.checked = true;

      }
    })
    .finally(() => {
      BuscarCarrinhoDoUsuario();
    })
    .catch(error => {
      console.error(error);
    });
}

function removerDoCarrinho(idNoCarrinho) {
  let formData = new FormData;
  formData.append('id', idNoCarrinho)

  fetch(`/delivery-slg.com.br/source/controller/header_controller.php`, {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .finally(() => {
      BuscarCarrinhoDoUsuario();
    })
    .catch(error => {
      console.log(error);
    })
}

function loading() {
  let HTML = `
  <svg class="teste-svg-loading" version = "1.1" id = "L9" xmlns = "http://www.w3.org/2000/svg" xmlns: xlink = "http://www.w3.org/1999/xlink" x = "0px"
  y = "0px" viewBox = "0 0 100 100" enable - background="new 0 0 0 0" xml: space = "preserve" >
    <path fill="#000"
      d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
      <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
        to="360 50 50" repeatCount="indefinite" />
    </path>
  </svg >
  `
  return HTML;
}

function FinalizarCarrinho() {
  const carrinhoContainer = document.getElementById('carrinhoItensContainer');

  fetch('/delivery-slg.com.br/source/controller/header_controller.php?action=finalizar-compra')
    .then(response => response.json())
    .then(res => {
      if (res.msg.carrinho.ok == false) {
        carrinhoContainer.innerHTML = `Não é possivel finalizar compra sem produtos ...`
      }

      if (res.msg.compra.ok == true) {
        carrinhoContainer.innerHTML =
          `<div class="compra-finalizada">
          <svg class="teste-svg-loading" version = "1.1" id = "L9" xmlns = "http://www.w3.org/2000/svg" xmlns: xlink = "http://www.w3.org/1999/xlink" x = "0px"
            y = "0px" viewBox = "0 0 100 100" enable - background="new 0 0 0 0" xml: space = "preserve" >
            <path fill="#000"
              d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
              <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
                to="360 50 50" repeatCount="indefinite" />
            </path>
          </svg >
          Compra finalizada com sucesso!! </br>
          <i class="fa-solid fa-circle-check"></i> </br>
        </div>`
      }
    })
    .finally(() => {
      setTimeout(() => {
        BuscarCarrinhoDoUsuario();
      }, 3000)
    })

}