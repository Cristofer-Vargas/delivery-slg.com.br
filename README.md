# Delivery-SLG

Projeto Integrador destinado ao curso Técnico em Informática do Senac São Luiz Gonzaga. 

## Grupo: 
Bruna Borck -  [Perfil](https://github.com/xnectunex)
Cristofer Vargas - [Perfil](https://github.com/Cristofer-Vargas)
Daniel Ferreira. - [Perfil](https://github.com/DanielFerreiraFeiden)

## Professor: 
Fabrício Esmério - [Perfil Professor](https://github.com/fabricioesmerio)

## Termos e Condições

Bem-vindo aos termos e condições do nosso site. Ao acessar e utilizar o nosso site, você concorda com os termos e condições descritos abaixo.

O nosso site contém conteúdo de terceiros que são disponibilizados gratuitamente e produtos sem valor comercial pelos seus respectivos proprietários. Esses conteúdos são fornecidos no nosso site para fins informativos e de entretenimento.

Ao utilizar o nosso site, você concorda em não vender ou distribuir comercialmente qualquer conteúdo disponível em nosso site sem a devida permissão do proprietário. Você também concorda em creditar os proprietários do conteúdo e fornecer um link para o site original, conforme necessário.

Os proprietários do conteúdo têm o direito de solicitar a remoção do conteúdo do nosso site a qualquer momento, e nós nos reservamos o direito de remover qualquer conteúdo que viole os direitos autorais ou outros direitos de propriedade intelectual.

Ao acessar e utilizar o nosso site, você concorda em cumprir todas as leis e regulamentos aplicáveis relacionados à propriedade intelectual e outros direitos de propriedade.

Ao utilizar o nosso site, você reconhece e concorda que o nosso site e todo o seu conteúdo são fornecidos "como estão" e que não somos responsáveis por quaisquer danos ou perdas resultantes do uso do nosso site ou do conteúdo disponível nele.

Ao utilizar o nosso site, você concorda em nos isentar de qualquer responsabilidade por qualquer dano, perda, reclamação ou despesa decorrente do uso do nosso site ou do conteúdo disponível nele.

Estes termos e condições podem ser atualizados periodicamente e as atualizações serão publicadas no nosso site. Ao continuar a utilizar o nosso site, você concorda com os termos e condições atualizados. Se você não concordar com os termos e condições, não utilize o nosso site.


Eu tenho esse arquivo de configuração para configurar o caminho root dos diretórios:

```php
<?php

class RootPath {

  public function DiretorioRaiz() {
    return $rootPath = $_SERVER['DOCUMENT_ROOT'] . '/Studies-courses/Delivery-SLG';

  }
```

eu chamo ele e tento tratar no arquivo header para que quando eu incorporar esse arquivo em qualquer outro arquivo e / ou diretório, ele chame sempre o mesmo arquivo usufruindo do caminho absoluto

Header:

```php
<?php
  include_once("PHP/config/root_diretories.php");
  $RootPath = new RootPath();
?>

...

<a href="#" title="Início"><img src="<?php echo $RootPath->DiretorioRaiz() ?>/images/Logo-Delivery-SLG.png" alt="Delivery SLG Logo"></a>

```

E no index eu chamo ele desta forma:

```php
  include_once('./molde/header.php') ?>
```

Estou usando o wamp server e minhas estrutura de pastas é a seguinte:

C:\wamp64\www\Studies-courses\Delivery-SLG

e dentro da pasta Delivery-SLG contem essa estrutura:

Delivery-SLG
 ┣ images
 ┃ ┣ footer
 ┃ ┃ ┣ facebook-sign.png
 ┃ ┃ ┣ instagram-sign.png
 ┃ ┃ ┣ linkedin-sign.png
 ┃ ┃ ┗ twitter-sign.png
 ┃ ┣ header
 ┃ ┃ ┗ lupa-search.png
 ┃ ┣ icones
 ┃ ┃ ┣ acai-icon.png
 ┃ ┃ ┣ cachorro-quente-icon.png
 ┃ ┃ ┣ frango-frito-icon.png
 ┃ ┃ ┣ hamburguer-icon.png
 ┃ ┃ ┣ pastel-icon.png
 ┃ ┃ ┣ pizza-icon.png
 ┃ ┃ ┣ sorvete-icon.png
 ┃ ┃ ┗ x-burger-icon.png
 ┃ ┣ main
 ┃ ┃ ┣ cadastroempresa
 ┃ ┃ ┗ index
 ┃ ┃ ┃ ┗ delivery-apresentation-svg.svg
 ┃ ┣ Logo-Delivery-SLG.png
 ┃ ┗ wave-divisor.svg
 ┣ js
 ┃ ┗ include.js
 ┣ molde
 ┃ ┣ footer.php
 ┃ ┗ header.php
 ┣ pages
 ┃ ┗ cadastroempresa.php
 ┣ PHP
 ┃ ┣ Classes
 ┃ ┣ Conexao
 ┃ ┣ config
 ┃ ┃ ┗ root_diretories.php
 ┃ ┗ DAO
 ┣ style
 ┃ ┣ media-queries
 ┃ ┃ ┣ sass
 ┃ ┃ ┃ ┗ all.scss
 ┃ ┃ ┣ all.css
 ┃ ┃ ┗ all.css.map
 ┃ ┣ sass
 ┃ ┃ ┣ all.scss
 ┃ ┃ ┣ cadastroempresa.scss
 ┃ ┃ ┗ index.scss
 ┃ ┣ all.css
 ┃ ┣ all.css.map
 ┃ ┣ cadastroempresa.css
 ┃ ┣ cadastroempresa.css.map
 ┃ ┣ index.css
 ┃ ┗ index.css.map
 ┣ index.php
 ┣ LICENSE
 ┗ README.md

 
 Eu tenho uma sugestão. Como não tratamos isso em aula ainda viu te adiantar aqui 
 Considere colocar imgs, css, js dentro de uma pasta assets 
 E onde tá PHP trocar por src ou source 
 PHP fica muito genérico e meio sem sentido 
 Mas é apenas uma sugestão