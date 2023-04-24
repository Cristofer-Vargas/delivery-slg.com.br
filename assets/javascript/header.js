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

document.addEventListener('DOMContentLoaded', () => {
  BuscarProdutosDoUsuario();
})