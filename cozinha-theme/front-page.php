
<!doctype html>
<html lang="pt-br">
  <head>
    <?php /* WordPress theme hooks. */ ?>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="Cozinha Solidária - MTST">
    <meta property="og:site_name" content="Cozinha Solidária - MTST">
    <meta name="description" content="Cozinhas Solidárias. Distribuindo refeições gratuitas em diversos estados no Brasil, ajudando a combater a fome nas periferias">
    <meta property="og:description" content="Cozinhas Solidárias. Distribuindo refeições gratuitas em diversos estados no Brasil, ajudando a combater a fome nas periferias">
    <meta property="og:image" content="http://cozinhasolidaria.com/assets/img/card-cozinhas.png">
    <meta property="og:image:type" content="image/jpg">
    <meta property="og:image:width" content="800"> 
    <meta property="og:image:height" content="600">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://cozinhasolidaria.com/">
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
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/css/style.css?v1.0.7')); ?>">
    <link rel="stylesheet" href="<?php echo esc_url(cozinha_solidaria_asset('/css/menu-mobile.css')); ?>">

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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2080195-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-205480195-1');
    </script>
    <style>
      @media (max-width: 540px) {
      .topo p {
              font-size: 19px!important;
          }
      
      .col-lg-10.col-md-10.sos-enchentes {
        margin-top: 0 !important;
        background: #DE1833 !important
      }
    }

    </style>
  <?php wp_head(); ?>
  </head>
  
  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="inicio">  
      <nav id="menu-principal" class="menu-principal" role="navigation">
        <ul>
          <li><a class="nav-link active" href="#inicio">Início</a></li>
          <li><a class="nav-link" href="#projeto">O Projeto</a></li>
          <li><a class="nav-link" href="#contribuir">Contribua</a></li>
          <li><a class="nav-link" href="#imprensa">Imprensa</a></li>
          <li><a class="nav-link" href="#" onclick="openModal();">Contato</a></li>
        </ul>
      </nav>

      <nav role="navigation">
        <div id="menuToggle">
          <input type="checkbox" />
          <span></span>
          <span></span>
          <span></span>
          <ul id="menu">
            <li><a class="item-menu" href="#inicio">Início</a></li>
            <li><a class="item-menu" href="#projeto">O Projeto</a></li>
            <li><a class="item-menu" href="#contribuir">Contribua</a></li>
            <li><a class="item-menu" href="#imprensa">Imprensa</a></li>
            <li><a class="item-menu" href="#" onclick="openModal();">Contato</a></li>
          </ul>
        </div>
      </nav>
      <?php if (cozinha_solidaria_acf_is_enabled('home_top_banner_enabled', true)) : ?>
        <?php
        $home_banner_link = cozinha_solidaria_get_field('home_top_banner_link', 'https://euapoioascozinhas.com/');
        $home_banner_image_url = cozinha_solidaria_get_field('home_top_banner_image_url', cozinha_solidaria_home_default('home_top_banner_image_url'));
        $home_banner_image = cozinha_solidaria_get_image_url('home_top_banner_image', $home_banner_image_url ?: cozinha_solidaria_asset('/img/banner-apoio-cozinhas.webp'));
        ?>
        <div class="menu-novo">
          <a class="item-menu" href="<?php echo esc_url($home_banner_link); ?>" target="_blank"><img src="<?php echo esc_url($home_banner_image); ?>" alt=""></a>
        </div>
      <?php endif; ?>
      <div class="container">
        <div class="topo row">
          <div class="col-lg-2 col-md-2">
            <img class="cozi" src="<?php echo esc_url(cozinha_solidaria_asset('/img/cozi.png')); ?>" alt="">
          </div>
          <div class="col-lg-10 col-md-10">
              <img class="logo" src="<?php echo esc_url(cozinha_solidaria_asset('/img/logo.png')); ?>" alt="Cozinha Solidária">
              <p style="font-size: 28px;"><?php echo wp_kses_post(cozinha_solidaria_get_field('home_hero_text', cozinha_solidaria_home_default('home_hero_text'))); ?></p>
              <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_hero_button_link', cozinha_solidaria_home_default('home_hero_button_link'))); ?>" class="cta cta-azul" target="_blank"><?php echo esc_html(cozinha_solidaria_get_field('home_hero_button_text', cozinha_solidaria_home_default('home_hero_button_text'))); ?></a>
          </div>
          <div class="col-lg-10 col-md-10 sos-enchentes" style="margin-top: 120px;">
            <p style="color: #fff;"><?php echo wp_kses_post(cozinha_solidaria_get_field('home_hero_secondary_text', cozinha_solidaria_home_default('home_hero_secondary_text'))); ?></p>
            <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_hero_secondary_button_link', cozinha_solidaria_home_default('home_hero_secondary_button_link'))); ?>" class="cta cta-amarelo" target="_blank" style="color: #000;"><?php echo esc_html(cozinha_solidaria_get_field('home_hero_secondary_button_text', cozinha_solidaria_home_default('home_hero_secondary_button_text'))); ?></a>
        </div>
        </div>
      </div>
    </header>

    <main>

      <section id="projeto">
        <div class="bg-projeto"><img class="conjunto-dir" src="<?php echo esc_url(cozinha_solidaria_asset('/img/conjunto-dir.png')); ?>" alt=""></div>
        <div class="container">
          <div class="titulo-secao">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/panela-amarela.png')); ?>" alt=""><h2><?php echo esc_html(cozinha_solidaria_get_field('home_project_title', cozinha_solidaria_home_default('home_project_title'))); ?></h2>
          </div>
          <!-- <div class="row videos">
            <div class="col-lg-8 col-md-8">
              <a class="js-video-button" data-video-id="L0hK8LjcFTY" href="#"><figure class="thumb-maior"><img class="thumb-youtube" src="<?php echo esc_url(cozinha_solidaria_asset('/img/thumb-video-1.jpg')); ?>" alt=""><img class="player-maior" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
            </div>
            <div class="col-lg-4 col-md-4">
              <a class="js-video-button" data-video-id="08DpFkL513k" href="#"><figure class="thumb-menor"><img class="video-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/video-2.jpg')); ?>" alt=""><img class="player-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
              <a class="js-video-button" data-video-id="imEm1ANhWms" href="#"><figure class="thumb-menor"><img class="video-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/video-3.jpg')); ?>" alt=""><img class="player-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
            </div>
          </div> -->
          <div class="img-projeto">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/o-projeto.png')); ?>" alt="">
          </div>
          <div class="txt-projeto">
            <span style="line-height: 2;"><?php echo esc_html(cozinha_solidaria_get_field('home_project_program_label', cozinha_solidaria_home_default('home_project_program_label'))); ?></span><br /><img src="<?php echo esc_url(cozinha_solidaria_asset('/img/image.webp')); ?>" alt="" style="max-width: 190px;background-color: #fff;text-align: left;float:left;margin-right: 14px;">
            <?php echo wp_kses_post(cozinha_solidaria_get_field('home_project_content', cozinha_solidaria_home_default('home_project_content'))); ?>
          </div>
          <div class="saiba-mais">
            <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_project_button_link', cozinha_solidaria_home_default('home_project_button_link'))); ?>" class="cta cta-amarelo"><?php echo esc_html(cozinha_solidaria_get_field('home_project_button_text', cozinha_solidaria_home_default('home_project_button_text'))); ?></a>
          </div>
        </div>
      </section>

      <section id="galeria">
        <div class="bg-galeria"><img class="conjunto-esq" src="<?php echo esc_url(cozinha_solidaria_asset('/img/conjunto-preto.png')); ?>" alt=""></div>
        <div class="container">
          <div class="titulo-secao">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/coracao.png')); ?>" alt=""><h2><?php echo esc_html(cozinha_solidaria_get_field('home_gallery_title', cozinha_solidaria_home_default('home_gallery_title'))); ?></h2>
          </div>

          <?php $gallery_images = cozinha_solidaria_get_rows('home_gallery_images', cozinha_solidaria_home_default('home_gallery_images')); ?>
          <div class="wraper-galeria hide-mobile">
            <?php foreach (array_chunk($gallery_images, 3) as $gallery_row) : ?>
              <div class="row">
                <?php foreach ($gallery_row as $gallery_image) : ?>
                  <div class="col-md-4">
                    <img src="<?php echo esc_url(cozinha_solidaria_sub_image_url($gallery_image, 'image', $gallery_image['image_url'] ?? '')); ?>" alt="<?php echo esc_attr($gallery_image['alt'] ?? ''); ?>">
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="swiper-container swiperGaleria wraper-galeria hide-desktop">
            <div class="swiper-wrapper">
              <?php foreach ($gallery_images as $gallery_image) : ?>
                <div class="swiper-slide col-md-4">
                  <img src="<?php echo esc_url(cozinha_solidaria_sub_image_url($gallery_image, 'image', $gallery_image['image_url'] ?? '')); ?>" alt="<?php echo esc_attr($gallery_image['alt'] ?? ''); ?>">
                </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>

          <div class="ver-mais">
            <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_gallery_button_link', cozinha_solidaria_home_default('home_gallery_button_link'))); ?>" target="_blank" class="cta cta-azul"><?php echo esc_html(cozinha_solidaria_get_field('home_gallery_button_text', cozinha_solidaria_home_default('home_gallery_button_text'))); ?></a>
          </div>

          <?php $home_videos = cozinha_solidaria_get_rows('home_videos', cozinha_solidaria_home_default('home_videos')); ?>
          <div class="row videos">
            <?php if (! empty($home_videos[0])) : ?>
              <div class="col-lg-8 col-md-8">
                <a class="js-video-button" data-video-id="<?php echo esc_attr($home_videos[0]['youtube_id'] ?? ''); ?>" href="#"><figure class="thumb-maior"><img class="thumb-youtube" src="<?php echo esc_url(cozinha_solidaria_sub_image_url($home_videos[0], 'thumbnail', $home_videos[0]['thumbnail_url'] ?? '')); ?>" alt=""><img class="player-maior" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
              </div>
            <?php endif; ?>
            <div class="col-lg-4 col-md-4">
              <?php foreach (array_slice($home_videos, 1, 2) as $home_video) : ?>
                <a class="js-video-button" data-video-id="<?php echo esc_attr($home_video['youtube_id'] ?? ''); ?>" href="#"><figure class="thumb-menor"><img class="video-menor" src="<?php echo esc_url(cozinha_solidaria_sub_image_url($home_video, 'thumbnail', $home_video['thumbnail_url'] ?? '')); ?>" alt=""><img class="player-menor" src="<?php echo esc_url(cozinha_solidaria_asset('/img/player-yt.png')); ?>" alt=""></figure></a>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="ver-mais">
            <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_videos_button_link', cozinha_solidaria_home_default('home_videos_button_link'))); ?>" target="_blank" class="cta cta-azul"><?php echo esc_html(cozinha_solidaria_get_field('home_videos_button_text', cozinha_solidaria_home_default('home_videos_button_text'))); ?></a>
          </div>

        </div>
      </section>

      <script>
        $(".js-video-button").modalVideo({
          youtube:{
            controls:1,
            nocookie: true,
            autoplay:1
          }
        });
      </script>

      <section id="contribuir">
        <div class="bg-contribuir"><img class="conjunto-dir" src="<?php echo esc_url(cozinha_solidaria_asset('/img/conjunto-preto.png')); ?>" alt=""></div>
        <div class="container">
          <div class="titulo-secao">
            <h2><?php echo esc_html(cozinha_solidaria_get_field('home_contribute_title', cozinha_solidaria_home_default('home_contribute_title'))); ?></h2>
          </div>
          <div class="cont-contrbuir row">
            <div class="col-md-4">
              <img class="img-ajudar" src="<?php echo esc_url(cozinha_solidaria_get_image_url('home_contribute_image', cozinha_solidaria_asset('/img/como-ajudar-img.png'))); ?>" alt="Como ajudar">
            </div>
            <div class="col-md-8">
              <div class="content-dir">
                <h3 style="font-size:35px;line-height:40px;"><?php echo wp_kses_post(cozinha_solidaria_get_field('home_contribute_heading', cozinha_solidaria_home_default('home_contribute_heading'))); ?></h3>
                <p style="font-size:20px;line-height:25px;"><?php echo wp_kses_post(cozinha_solidaria_get_field('home_contribute_text', cozinha_solidaria_home_default('home_contribute_text'))); ?></p>
              </div>
              <div class="cta-contribua">
                <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_contribute_button_link', cozinha_solidaria_home_default('home_contribute_button_link'))); ?>" class="cta cta-preto" target="_blank" style="line-height:1.2;"><?php echo esc_html(cozinha_solidaria_get_field('home_contribute_button_text', cozinha_solidaria_home_default('home_contribute_button_text'))); ?></a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="imprensa">
        <div class="bg-imprensa"><img class="conjunto-dir" src="<?php echo esc_url(cozinha_solidaria_asset('/img/conj-azul.png')); ?>" alt=""></div>
        <div class="container">
          <div class="titulo-secao">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/imprensa-azul.png')); ?>" alt=""><h2><?php echo esc_html(cozinha_solidaria_get_field('home_press_title', cozinha_solidaria_home_default('home_press_title'))); ?></h2>
          </div>
          <p><?php echo wp_kses_post(cozinha_solidaria_get_field('home_press_intro', cozinha_solidaria_home_default('home_press_intro'))); ?></p>
          <!-- Slider main container -->
          <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
              <!-- Slides -->
              <?php $press_items = cozinha_solidaria_get_rows('home_press_items', cozinha_solidaria_home_default('home_press_items')); ?>
              <?php foreach ($press_items as $press_item) : ?>
                <div class="swiper-slide">
                  <a class="a-noticia" href="<?php echo esc_url($press_item['link'] ?? '#'); ?>" target="_blank">
                    <div class="noticia">
                      <img src="<?php echo esc_url(cozinha_solidaria_sub_image_url($press_item, 'image', $press_item['image_url'] ?? '')); ?>" alt="" class="thumb-noticia">
                      <h4><?php echo esc_html($press_item['source'] ?? ''); ?></h4>
                      <p><?php echo esc_html($press_item['description'] ?? ''); ?></p>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
            
            <div class="swiper-pagination"></div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

          </div>
        </div>
      </section>
   
      <section id="prestacao-de-contas">
        <div class="bg-prestacao-de-contas"><img class="conjunto-esq" src="<?php echo esc_url(cozinha_solidaria_asset('/img/panelas-vermelhas.png')); ?>" alt=""></div>
        <div class="container">
          <div class="titulo-secao">
            <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/cachecol.png')); ?>" alt=""><h2><?php echo esc_html(cozinha_solidaria_get_field('home_accountability_title', cozinha_solidaria_home_default('home_accountability_title'))); ?></h2>
          </div>
          <div class="row">
            <div class="col-md-7">
              <?php $accountability_paragraphs = cozinha_solidaria_get_rows('home_accountability_paragraphs', cozinha_solidaria_home_default('home_accountability_paragraphs')); ?>
              <?php foreach ($accountability_paragraphs as $paragraph) : ?>
                <p><?php echo wp_kses_post($paragraph['text'] ?? ''); ?></p>
              <?php endforeach; ?>
            </div>
            <div class="col-md-5">
              <img src="<?php echo esc_url(cozinha_solidaria_get_image_url('home_accountability_image', cozinha_solidaria_asset('/img/compa-horta.png'))); ?>" alt="" class="prestacao-img">
            </div>
          </div>
          <div class="row dados">
            <?php $accountability_stats = cozinha_solidaria_get_rows('home_accountability_stats', cozinha_solidaria_home_default('home_accountability_stats')); ?>
            <?php foreach ($accountability_stats as $stat) : ?>
              <div class="col-md-6">
                <p class="dados-num"><?php echo esc_html($stat['number'] ?? ''); ?></p>
                <p><?php echo esc_html($stat['label'] ?? ''); ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <p style="text-align:center;font-size:20px;line-height:1;margin-top: 10px;"><?php echo esc_html(cozinha_solidaria_get_field('home_accountability_note', cozinha_solidaria_home_default('home_accountability_note'))); ?></p>
          <!-- <div class="row gastos">
            <h3>Gastos das Cozinhas Solidárias</h3>
            <div class="col-md-6 col-xs-6">
              <div class="col-gastos"><h4>Construção</h4></div>
              <div class="col-gastos"><h4>Reparos</h4></div>
              <div class="col-gastos"><h4>Trabalhadoras</h4></div>
              <div class="col-gastos"><h4>Alimentos</h4></div>
              <div class="col-gastos"><h4>Utensílios</h4></div>
              <div class="col-gastos"><h4>Gás</h4></div>
              <div class="col-gastos"><h4>Logística / Operativo</h4></div>
              <div class="col-gastos"><h4>Outros gastos</h4></div>
            </div>
            <div class="col-md-6 col-xs-6">
              <div class="col-gastos"><p class="num-porcent num-const">22,4%</p></div>
              <div class="col-gastos"><p class="num-porcent num-reparos">6,4%</p></div>
              <div class="col-gastos"><p class="num-porcent num-trab">15,9%</p></div>
              <div class="col-gastos"><p class="num-porcent num-alim">35,8%</p></div>
              <div class="col-gastos"><p class="num-porcent num-utens">11,5%</p></div>
              <div class="col-gastos"><p class="num-porcent num-gas">1<span>,7%</span></p></div>
              <div class="col-gastos"><p class="num-porcent num-log">6%</p></div>
              <div class="col-gastos"><p class="num-porcent num-outros">0,3%</p></div>
            </div>
          </div> -->
        </div>
      </section>

      <section id="divulgar">
        <div class="bg-divulgar"><img class="conjunto-dir" src="<?php echo esc_url(cozinha_solidaria_asset('/img/conj-azul.png')); ?>" alt=""></div>
        <div class="container">
          <div class="row ajude-divulgar">
            <div class="col-lg-7 col-md-6">
              <img class="cozinha-pessoas" src="<?php echo esc_url(cozinha_solidaria_get_image_url('home_share_image', cozinha_solidaria_asset('/img/cozinha-pessoas.png'))); ?>" alt="">
            </div>
            <div class="col-lg-5 col-md-6">
              <div class="titulo-secao linha-um">
                <img src="<?php echo esc_url(cozinha_solidaria_asset('/img/panela-div.png')); ?>" alt=""><h2><?php echo esc_html(cozinha_solidaria_get_field('home_share_title_line_1', cozinha_solidaria_home_default('home_share_title_line_1'))); ?></h2>
              </div>
              <div class="titulo-secao linha-dois">
                <h2><?php echo esc_html(cozinha_solidaria_get_field('home_share_title_line_2', cozinha_solidaria_home_default('home_share_title_line_2'))); ?></h2>
              </div>
              <p class="desc-divulgar"><?php echo wp_kses_post(cozinha_solidaria_get_field('home_share_text', cozinha_solidaria_home_default('home_share_text'))); ?></p>
              <div class="compartilhe">
                <a href="<?php echo esc_url(cozinha_solidaria_get_field('home_share_button_link', cozinha_solidaria_home_default('home_share_button_link'))); ?>" class="cta cta-branco a2a_dd"><?php echo esc_html(cozinha_solidaria_get_field('home_share_button_text', cozinha_solidaria_home_default('home_share_button_text'))); ?></a>
                <!-- AddToAny BEGIN -->
                <!-- <a class="a2a_dd" href="https://www.addtoany.com/share">Share</a> -->
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <!-- AddToAny END -->
              </div>
            </div>
          </div>
        </div>
      </section>

      <script>
        function share(){
          if (navigator.share !== undefined) {
            navigator.share({
              title: 'Cozinha Solidária - MTST',
              text: 'Cozinhas Solidárias. Distribuindo refeições gratuitas em diversos estados no Brasil, ajudando a combater a fome nas periferias',
              url: 'http://cozinhasolidaria.com',
            })
            .then(() => console.log('Successful share'))
            .catch((error) => console.log('Error sharing', error));
          }
        }
      </script>
      
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
    <footer>
      <div class="bg-footer"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <nav class="nav-footer">
              <ul>
                <li><a class="menu-footer" href="#inicio">Início</a></li>
                <li><a class="menu-footer" href="#projeto">O Projeto</a></li>
                <li><a class="menu-footer" href="#contribuir">Contribua</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-md-4 footer-medium">
            <img class="logo-rodape" src="<?php echo esc_url(cozinha_solidaria_asset('/img/logo-mtst-novo.png')); ?>" alt="">
            <div class="link-mtst">
              <a href="https://mtst.org/" target="_blank">https://mtst.org</a>
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
                <li><a class="menu-footer" href="#imprensa">Imprensa</a></li>
                <li><a class="menu-footer" href="#contato" onclick="openModal();">Contato</a></li>
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
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/menu.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/carrossel.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/js/modal.js')); ?>"></script>
    <!-- Contact form JS-->
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/mail/jqBootstrapValidation.js')); ?>"></script>
    <script src="<?php echo esc_url(cozinha_solidaria_asset('/mail/contact_me.js')); ?>"></script>

  <?php wp_footer(); ?>
  </body>
</html>
