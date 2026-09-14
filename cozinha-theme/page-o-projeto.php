<?php
/*
Template Name: O Projeto
*/
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <?php /* WordPress theme hooks. */ ?>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="O Projeto - Cozinha Solidária MTST">
    <meta property="og:site_name" content="Cozinha Solidária - MTST">
    <meta name="description" content="Conheça as Cozinhas Solidárias do MTST, uma rede de afeto e solidariedade que combate a fome nas periferias.">
    <meta property="og:description" content="Conheça as Cozinhas Solidárias do MTST, uma rede de afeto e solidariedade que combate a fome nas periferias.">
    <meta property="og:image" content="<?php echo esc_url(cozinha_solidaria_asset('/img/og-cozinha-solidaria.png')); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url(cozinha_solidaria_asset('/img/og-cozinha-solidaria.png')); ?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200"> 
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Cozinha Solidária - conheça e contribua">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="O Projeto - Cozinha Solidária MTST">
    <meta name="twitter:description" content="Conheça as Cozinhas Solidárias do MTST, uma rede de afeto e solidariedade que combate a fome nas periferias.">
    <meta name="twitter:image" content="<?php echo esc_url(cozinha_solidaria_asset('/img/og-cozinha-solidaria.png')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(cozinha_solidaria_asset('/img/icone.ico')); ?>">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Vídeo Modal -->
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(cozinha_solidaria_asset('/css/modal-video.min.css')); ?>">
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/jquery-modal-video.min.js')); ?>"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/vendor/swiper/swiper-bundle.css')); ?>" />
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/vendor/swiper/swiper-bundle.min.css')); ?>" /> 
    <link href="<?php echo esc_url(cozinha_solidaria_asset('/bootstrap/css/bootstrap-grid.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/css/modal.css')); ?>">
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/css/style.css?v1.0.11')); ?>">
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/css/menu-mobile.css?v1.0.4')); ?>">

    <title>Cozinha Solidária - MTST</title>

    <!-- Hotjar Tracking Code for https://cozinhasolidaria.com/ -->
    <script>
      (function(h,o,t,j,a,r){
          h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
          h._hjSettings={hjid:2565455,hjsv:6};
          a=o.getElementsByTagName('head')[0];
          r=o.createElement('script');r.async=1;
          r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
          a.appendChild(r);
      })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-54K84EXRFX"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-54K84EXRFX');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-205480195-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-205480195-1');
    </script>
  <?php wp_head(); ?>
  </head>
  
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="inicio" class="header-projeto">
      
      <nav id="menu-principal" class="menu-principal navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li><a class="nav-link nav-item" href="<?php echo esc_url(home_url('/#inicio')); ?>">Início</a></li>
            <li><a class="nav-link nav-item active" href="#">O Projeto</a></li>
            <li><a class="nav-link nav-item" href="<?php echo esc_url(home_url('/#contribuir')); ?>">Contribua</a></li>
            <li><a class="nav-link nav-item" href="<?php echo esc_url(home_url('/#imprensa')); ?>">Imprensa</a></li>
            <li><a class="nav-link nav-item" href="#" onclick="openModal();">Contato</a></li>
          </ul>
        </div>
      </nav>

      <nav role="navigation">
        <div id="menuToggle">
          <input type="checkbox" />
          <span></span>
          <span></span>
          <span></span>
          <ul id="menu">
            <li><a class="item-menu" href="<?php echo esc_url(home_url('/#inicio')); ?>">Início</a></li>
            <li><a class="item-menu" href="<?php echo esc_url(home_url('/#projeto')); ?>">O Projeto</a></li>
            <li><a class="item-menu" href="<?php echo esc_url(home_url('/#contribuir')); ?>">Contribua</a></li>
            <li><a class="item-menu" href="<?php echo esc_url(home_url('/#imprensa')); ?>">Imprensa</a></li>
            <li><a class="item-menu" href="#" onclick="openModal();">Contato</a></li>
          </ul>
        </div>
      </nav>

      <div class="container cont-projeto">
        <div class="titulo-secao row">
          <div class="titulo-secao">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/panela-amarela.png')); ?>" alt=""><h2>O Projeto</h2>
          </div>
        </div>
        <!-- <div class="row videos">
          <div class="col-lg-8 col-md-8">
            <a class="js-modal-btn" data-video-id="L0hK8LjcFTY" href="#"><figure class="thumb-maior"><img class="thumb-youtube" src="<?php echo esc_url(cozinha_solidaria_asset('/img/thumb-video-1.jpg')); ?>" alt=""><img class="player-maior" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
          </div>
          <div class="col-lg-4 col-md-4">
            <a class="js-modal-btn" data-video-id="08DpFkL513k" href="#"><figure class="thumb-menor"><img class="video-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/video-2.jpg')); ?>" alt=""><img class="player-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
            <a class="js-modal-btn" data-video-id="imEm1ANhWms" href="#"><figure class="thumb-menor"><img class="video-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/video-3.jpg')); ?>" alt=""><img class="player-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
          </div>
        </div> -->
        <div class="img-projeto">
          <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/o-projeto.png')); ?>" alt="">
        </div>
        <div class="txt-projeto">
          <?php echo wp_kses_post(cozinha_solidaria_get_formatted_field('project_header_intro', cozinha_solidaria_project_default('project_header_intro'))); ?>
        </div>
      </div>
      
      
    </header>

    <main>

      <section id="o-projeto" class="pagina-projeto">
        <div class="bg-projeto"></div>
        <div class="container mais-que-comida">
          <div class="row topo-projeto">
            <div class="col-md-12">
              
              <h3><?php echo esc_html(cozinha_solidaria_get_field('project_more_food_title', cozinha_solidaria_project_default('project_more_food_title'))); ?></h3>
              <div class="icones-proj"><img class="icon-projeto" src="<?php echo esc_url(cozinha_solidaria_asset('/img/panelinha-pr.png')); ?>"><img class="icon-projeto" src="<?php echo esc_url(cozinha_solidaria_asset('/img/coracao-pr.png')); ?>"></div>
              <?php echo wp_kses_post(cozinha_solidaria_get_formatted_field('project_more_food_content', cozinha_solidaria_project_default('project_more_food_content'))); ?>
            </div>
            <!-- <div class="col-md-5">
              <div class="imagem-topo-projeto">
                <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/MaisQueComida.png')); ?>" alt="">
              </div>
            </div> -->
          </div>
        </div>
      </section>

      <div class="bg-projeto-branco"></div>

      <section id="apoie">
        
        <div class="container">
          <div class="row acontecer">
            <div class="col-md-4">
              <div class="topo-pan">
                <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/icones-panelas-pr.png')); ?>" alt="Conjunto de panelas">
              </div>
              <img class="img-cozinheira" src="<?php echo esc_url(cozinha_solidaria_asset('/img/cozinheria-colher.png')); ?>" alt="Cozinheira">
              <!-- <div class="ver-mais hide-mobile">
                <a href="https://apoia.se/cozinhasolidaria" target="_blank" class="cta cta-azul">Faça parte desse time da solidariedade! Contamos com você, doe agora!</a>
              </div> -->
            </div>
            <div class="col-md-8 apoie-projeto">
              <div class="titulo-secao">
                <h2><?php echo esc_html(cozinha_solidaria_get_field('project_support_title', cozinha_solidaria_project_default('project_support_title'))); ?></h2>
              </div>
              <?php echo wp_kses_post(cozinha_solidaria_get_formatted_field('project_support_content', cozinha_solidaria_project_default('project_support_content'))); ?>
              <!-- <div class="ver-mais hide-desktop">
                <a href="https://apoia.se/cozinhasolidaria" target="_blank" class="cta cta-azul">Faça parte desse time da solidariedade! Contamos com você, doe agora!</a>
              </div> -->
            </div>
            <div class="ver-mais">
              <a href="<?php echo esc_url(cozinha_solidaria_get_field('project_support_button_link', cozinha_solidaria_project_default('project_support_button_link'))); ?>" target="_blank" class="cta cta-azul" style="background:#364A98;width:100%;font-size:22px;padding:20px;height:auto;"><?php echo esc_html(cozinha_solidaria_get_field('project_support_button_text', cozinha_solidaria_project_default('project_support_button_text'))); ?></a>
            </div>
          </div>
        </div>
      </section>
           
    </main>

    <div id="myModal" class="modal">
      <div class="container modal-content">
        <div class="cont-formulario">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <p><?php echo wp_kses_post(cozinha_solidaria_get_field('global_contact_intro', 'Quer ajudar de outra forma, saber mais das nossas Cozinhas Solidárias ou se informar sobre os locais para doações de alimentos e utensílios? Entre em contato com a gente:', 'option')); ?></p>
          <form id="contactForm" name="sentMessage" novalidate="novalidate">
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <input class="form-control" id="name" type="text" placeholder="Digite seu nome." required="required" data-validation-required-message="Digite seu nome" />
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <input class="form-control" id="email" type="email" placeholder="Digite seu email." required="required" data-validation-required-message="Qual é o seu email?" />
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                    <textarea class="form-control" id="message" rows="7" placeholder="Digite sua mensagem." required="required" data-validation-required-message="Escreva sua Mensagem"></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br />
            <div id="success"></div>
            <div class="form-group"><button class="cta cta-form" id="sendMessageButton" type="submit">Enviar</button></div>
          </form>
        </div>
      </div>
    </div>

    <?php ob_start(); ?>
    <footer class="footer-o-projeto">
      <div class="bg-footer"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <nav class="nav-footer">
              <ul>
                <li><a class="menu-footer" href="<?php echo esc_url(home_url('/#inicio')); ?>">Início</a></li>
                <li><a class="menu-footer" href="<?php echo esc_url(home_url('/#projeto')); ?>">O Projeto</a></li>
                <li><a class="menu-footer" href="<?php echo esc_url(home_url('/#contribuir')); ?>">Contribua</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-md-4 footer-medium">
            <img class="logo-rodape" src="<?php echo esc_url(cozinha_solidaria_asset('/img/logo-mtst-novo.png')); ?>" alt="">
            <div class="link-mtst">
              <a href="https://mtst.org/">https://mtst.org</a>
            </div>
            <ul class="redes-sociais">
              <li><a href="https://www.instagram.com/cozinhassolidariasmtst/" target="_blank"><img src="<?php echo esc_url(cozinha_solidaria_asset('/img/instagram.png')); ?>" alt="Instagram"></a></li>
              <li><a href="https://www.facebook.com/mtstbrasil" target="_blank"><img src="<?php echo esc_url(cozinha_solidaria_asset('/img/facebook.png')); ?>" alt="Facebook"></a></li>
              <li><a href="https://twitter.com/mtst" target="_blank"><img src="<?php echo esc_url(cozinha_solidaria_asset('/img/twitter.png')); ?>" alt="Twitter"></a></li>
              <li><a href="https://www.youtube.com/channel/UC3OzrZMhnmEgVtxpJoDRkeg" target="_blank"><img src="<?php echo esc_url(cozinha_solidaria_asset('/img/youtube.png')); ?>" alt="Youtube"></a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <nav class="nav-footer nav-right">
              <ul>
                <li><a class="menu-footer" href="<?php echo esc_url(home_url('/#imprensa')); ?>">Imprensa</a></li>
                <li><a class="menu-footer" href="<?php echo esc_url(home_url('/o-projeto/#contato')); ?>" onclick="openModal();">Contato</a></li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="link-nucleo">
          <p>Desenvolvido pelo <a href="https://nucleodetecnologia.com.br/" target="_blank">Núcleo de Tecnologia do MTST</a></p>
        </div>
      </div>
    </footer>
    <?php cozinha_solidaria_the_html_field('global_footer_html', ob_get_clean(), 'option'); ?>

    <script src="<?php echo esc_url(cozinha_solidaria_asset('/vendor/swiper/swiper-bundle.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/menu.js')); ?>"></script> -->
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/carrossel.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/modal.js')); ?>"></script>
    <!-- Contact form JS-->
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/mail/jqBootstrapValidation.js')); ?>"></script>
    <script>
      window.CozinhaSolidariaContact = {
        ajaxUrl: "<?php echo esc_url(admin_url('admin-ajax.php')); ?>",
        nonce: "<?php echo esc_attr(wp_create_nonce('cozinha_solidaria_contact')); ?>"
      };
    </script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/mail/contact_me.js?v1.0.1')); ?>"></script>

  <?php wp_footer(); ?>
  </body>
</html>
