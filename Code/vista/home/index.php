<?php 
  if (!isset($_SESSION)) session_start();

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    require('../../modelo/Login/redirigir.php');
  }
?>

<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <?php require('head.php'); ?>
  <body class="mdl-demo mdl-color--grey-100 mdl-color-text--grey-700 mdl-base" id="fondo">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
      <?php require('nav.php'); ?>
      <main class="mdl-layout__content">
        <div class="mdl-layout__tab-panel is-active" id="overview">
          <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
            <header class="section__play-btn mdl-cell mdl-cell--3-col-desktop mdl-cell--2-col-tablet mdl-cell--4-col-phone mdl-color--teal-100 mdl-color-text--white">
              <img src="../../images/home/ferreteria.jpg" width="100%" height="100%">
            </header>
            <div class="mdl-card mdl-cell mdl-cell--9-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone">
              <div class="mdl-card__supporting-text">
                <h4>Quienes Somos?</h4>
                Somos una empresa dedicada a la distribución de productos ferreteros en la ciudad de barranquilla, comparte nuestro sitio en tus redes sociales
              </div>
              <div class="mdl-card__actions">
                <a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);window.location.href=('http://twitter.com/?status='+tit2+'%20'+dir+'');" class="mdl-button">Twitter</a>
                <a href="javascript:var dir=window.document.URL;var tit=window.document.title;var tit2=encodeURIComponent(tit);var dir2= encodeURIComponent(dir);window.location.href=('http://www.facebook.com/share.php?u='+dir2+'&amp;t='+tit2+'');" class="mdl-button">Facebook</a>
                <a href="javascript:window.location.href='https://plus.google.com/share?url='+encodeURIComponent(location);void0;" class="mdl-button">Google+</a>
              </div>
            </div>
            <!--<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn1">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn1">
              <li class="mdl-menu__item">Lorem</li>
              <li class="mdl-menu__item" disabled>Ipsum</li>
              <li class="mdl-menu__item">Dolor</li>
            </ul>-->
          </section>
          <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
            <div class="mdl-card mdl-cell mdl-cell--12-col">
              <div class="mdl-card__supporting-text mdl-grid mdl-grid--no-spacing">
                <h4 class="mdl-cell mdl-cell--12-col">Nuestras Ofertas</h4>
                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                  <div class="section__circle-container__circle mdl-color--primary"><img src="../../images/home/1.jpg" width="100%" height="100%"></div>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                  <h5>Pinturas</h5>
                  durante todos estos años nos hemos esforzado por ofrecerles a nuestros clientes pinturas de la mas alta calidad, es por esto que ofrecemos pinturas <a href="http://www.pintuco.com/" target="_blank">pintuco</a>.
                </div>
                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                  <div class="section__circle-container__circle mdl-color--primary"><img src="../../images/home/2.png" width="100%" height="100%"></div>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                  <h5>Herramientas Construccion & Hogar</h5>
                  Comprometidos con nuestro compromiso con la calidad solo ofrecemos productos <a href="http://www.blackanddecker.com.co/" target="_blank">Black+Decker</a>.
                </div>
                <div class="section__circle-container mdl-cell mdl-cell--2-col mdl-cell--1-col-phone">
                  <div class="section__circle-container__circle mdl-color--primary"><img src="../../images/home/3.jpg" width="100%" height="100%"></div>
                </div>
                <div class="section__text mdl-cell mdl-cell--10-col-desktop mdl-cell--6-col-tablet mdl-cell--3-col-phone">
                  <h5>Asesorias</h5>
                  Nuestro altamente certificado grupo de expertos te guiaran acerca de los productos que debes adquirir de acuerdo a tus necesidades
                </div>
              </div>
              <!--<div class="mdl-card__actions">
                <a href="#" class="mdl-button">Read our features</a>
              </div>-->
            </div>
            <!--<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn2">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn2">
              <li class="mdl-menu__item">Lorem</li>
              <li class="mdl-menu__item" disabled>Ipsum</li>
              <li class="mdl-menu__item">Dolor</li>
            </ul>-->
          </section>
          <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
            <div class="mdl-card mdl-cell mdl-cell--12-col">
              <div class="mdl-card__supporting-text">
                <h4>Tecnologia</h4>
                Utilizamos productos de la más alta calidad, esto con la finalidad de mejorar nuestro funcionamiento interno para brindarles a nuestros clientes siempre una respuesta optima a sus necesidades.
              </div>
              <!--<div class="mdl-card__actions">
                <a href="#" class="mdl-button">Read our features</a>
              </div>-->
            </div>
            <!--puede servir para el responsive<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="btn3">
              <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="btn3">
              <li class="mdl-menu__item">Lorem</li>
              <li class="mdl-menu__item" disabled>Ipsum</li>
              <li class="mdl-menu__item">Dolor</li>
            </ul>-->
          </section>
        </div>
        <?php require('footer.php');?>
      </main>
    </div>
    <!--<a href="https://github.com/google/material-design-lite/blob/mdl-1.x/templates/text-only/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">View Source</a>-->
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
