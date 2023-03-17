/*
 Fazer um fetch a penas para a página pricipal, 
e usando replace, mudar a url para que seja compativel com o diretório do index
*/

const Head = document.getElementById('headInsert')
const Footer = document.getElementById('footerInsert')

fetch('./molde/header.html')
  .then(elemento => {
    return elemento.text()
  })
  .then(elementoText => {
    return elementoText
    .replace('../images/Logo-Delivery-SLG.png', './images/Logo-Delivery-SLG.png')
    .replace('../images/header/lupa-search.png', './images/header/lupa-search.png')

    .replace('../images/footer/instagram-sign.png', './images/footer/instagram-sign.png')
    .replace('../images/footer/facebook-sign.png', './images/footer/facebook-sign.png')
    .replace('../images/footer/twitter-sign.png', './images/footer/twitter-sign.png')
    .replace('../images/footer/linkedin-sign.png', './images/footer/linkedin-sign.png')

    .replace(/\.\.\/index\.html/g, './index.html')

  })
  .then(htmlNovo => {
    return Head.insertAdjacentHTML('beforeend', htmlNovo)
  })

fetch('./molde/footer.html')
  .then(elemento => {
    return elemento.text()
  })
  .then(elementoText => {
    return elementoText
    .replace('../images/footer/wave-divisor.svg', './images/footer/wave-divisor.svg')

    .replace('../images/footer/instagram-sign.png', './images/footer/instagram-sign.png')
    .replace('../images/footer/facebook-sign.png', './images/footer/facebook-sign.png')
    .replace('../images/footer/twitter-sign.png', './images/footer/twitter-sign.png')
    .replace('../images/footer/linkedin-sign.png', './images/footer/linkedin-sign.png')
    
    .replace('../images/Logo-Delivery-SLG.png', './images/Logo-Delivery-SLG.png')

    

    .replace('../pages/cadastroempresa.php', './pages/cadastroempresa.php"')
  })
  .then(htmlNovo => {
    Footer.insertAdjacentHTML('beforeend', htmlNovo)
  })