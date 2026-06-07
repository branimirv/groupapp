<?php

/**
 * The main template file
 * Template Name: Customer stories
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package GroupApp
 */

get_header();
?>

<?php


// проверяем есть ли данные в гибком содержании
if (have_rows('flexible_content_block')):

  // перебираем макеты гибкого содержания
  while (have_rows('flexible_content_block')) : the_row();

    // проверяем на нужный макет
    if (get_row_layout() == 'top_slider'):
      // проверяем есть ли данные в повторителе
      if (have_rows('row_slider')): ?>
        <section class="section-slider">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="slider slick-not-init">
                  <?php
                  // перебираем строки повторителя
                  while (have_rows('row_slider')) : the_row();
                    if (get_row_layout() == 'layoutslider'):
                  ?>
                      <div>
                        <div class="block-slider">
                          <div class="block-txt">

                            <?php $btn = get_sub_field('group_button');
                            if ($btn):
                              $link_target = $btn['button_linck_slider'];
                              $link_url = $btn['button_linck_slider'];
                            ?>
                              <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>">
                                <h2><?php the_sub_field('title_slider'); ?></h2>
                              </a><?php endif; ?>
                            <p class="block-txt__description"><?php the_sub_field('description_slider'); ?></p>
                            <?php $btn = get_sub_field('group_button');
                            if ($btn):
                              $link_target = $btn['button_linck_slider'];
                              $link_url = $btn['button_linck_slider'];
                            ?>
                              <a class="btn--withArrow" href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>">
                                <p class="txt"><?php echo $btn['button_text_slider']; ?></p>
                              <?php endif; ?>
                              <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M4.99951 12H18.9995" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              </svg>
                              </a>
                          </div>
                          <div class="block-img"> <?php $btn = get_sub_field('group_button');
                                                  if ($btn):
                                                    $link_target = $btn['button_linck_slider'];
                                                    $link_url = $btn['button_linck_slider'];
                                                  ?>

                              <img src="<?php the_sub_field('image_slider'); ?>" alt="" />
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                  <?php

                    endif;
                  endwhile;

                  ?>
                </div>
              </div>
            </div>
        </section>
      <?php
      endif;

    endif;
    // проверяем на нужный макет
    // проверяем на нужный макет
    if (get_row_layout() == 'side_content_modules'):
      // проверяем есть ли данные в повторителе
      if (have_rows('row_content_module')): ?>
        <section class="section-read-story">
          <div class="container">
            <div class="row" id='outer1'>
              <?php
              // перебираем строки повторителя
              while (have_rows('row_content_module')) : the_row();


                if (get_row_layout() == 'layout_content_modue'):
              ?>
                  <div class="col-lg-6 col-sm-12 col-12 prtt1 ">
                    <div class="block-read-min">
                      <div class="block-img"> <?php $btn = get_sub_field('group_button');
                                              if ($btn):
                                                $link_target = $btn['layout_content_modue_btn_link'];
                                                $link_url = $btn['layout_content_modue_btn_link'];
                                              ?>
                          <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class=" button"><img style='width:100%; height:100%;' src="<?php the_sub_field('layout_content_modue_img'); ?>" alt=""></a> <?php endif; ?>
                      </div>
                      <div class="block-text">
                        <p class="theme">
                          <?php the_sub_field('layout_content_modue_theme'); ?> </p>
                        <?php $btn = get_sub_field('group_button');
                        if ($btn):
                          $link_target = $btn['layout_content_modue_btn_link'];
                          $link_url = $btn['layout_content_modue_btn_link'];
                        ?>
                          <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class="title button">
                            <p class="title">
                              <?php the_sub_field('layout_content_modue_title'); ?> </p>
                          </a> <?php endif; ?>
                        <div class="block-text-p">
                          <p class="text">
                            <?php the_sub_field('layout_content_modue_desription'); ?>
                        </div>
                        </p>
                        <?php $btn = get_sub_field('group_button');
                        if ($btn):
                          $link_target = $btn['layout_content_modue_btn_link'];
                          $link_url = $btn['layout_content_modue_btn_link'];
                        ?>
                          <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class="read-story button btn--withArrow">
                            <?php echo $btn['layout_content_modue_btn_text']; ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M5 12H19" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M12 5L19 12L12 19" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
              <?php

                endif;
              endwhile;

              ?>

            </div>
            <div class="pagination-block">
              <div class="loading-indicator loading-indicator1" style="display: none;"> <svg fill="blue" width="40" height="40" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <style>
                    .spinner_ngNb {
                      animation: spinner_ZRWK 1.2s cubic-bezier(0.52, .6, .25, .99) infinite
                    }

                    .spinner_6TBP {
                      animation-delay: .6s
                    }

                    @keyframes spinner_ZRWK {
                      0% {
                        transform: translate(12px, 12px) scale(0);
                        opacity: 1
                      }

                      100% {
                        transform: translate(0, 0) scale(1);
                        opacity: 0
                      }
                    }
                  </style>
                  <path class="spinner_ngNb" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)" />
                  <path class="spinner_ngNb spinner_6TBP" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)" />
                </svg></div>
              <div class="load-more load-more1 load"><a class="load-a load-a1">Load More Articles</a></div>
              <div class="paginator paginator1 pagination paginator_my" onclick="pagination1(event)">
              </div>
            </div>
          </div>
        </section>
      <?php
      endif;

    endif;

    if (get_row_layout() == 'side_modules_bottom'):
      // проверяем есть ли данные в повторителе
      if (have_rows('row_content_module_bottom')): ?>
        <section class="section-read-story" style='padding-top:0px;'>
          <div class="container">
            <div class="row" id="outer2">
              <?php
              // перебираем строки повторителя
              while (have_rows('row_content_module_bottom')) : the_row();


                if (get_row_layout() == 'layout_content_modue_bottom'):
              ?>
                  <div class="col-lg-6 col-sm-6 col-12 prtt2">
                    <div class="block-read-min ">
                      <div class="block-img"> <?php $btn = get_sub_field('goup_button');
                                              if ($btn):
                                                $link_target = $btn['layout_content_modue_btn_link2'];
                                                $link_url = $btn['layout_content_modue_btn_link2'];
                                              ?> <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class=" button"><img style='width:100%; height:100%;' src="<?php the_sub_field('layout_content_modue_img_b'); ?>"></a> <?php endif; ?></div>
                      <div class="block-text btv2">
                        <?php $btn = get_sub_field('goup_button');
                        if ($btn):
                          $link_target = $btn['layout_content_modue_btn_link2'];
                          $link_url = $btn['layout_content_modue_btn_link2'];
                        ?> <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class=" button">
                            <p class="title">
                              <?php the_sub_field('layout_content_modue_title_b'); ?> </p>
                          </a> <?php endif; ?>
                        <p class="text">
                          <?php the_sub_field('layout_content_modue_desription_b'); ?> </p>
                        <div class="v2_person">
                          <div class="bt-img"> <img src="<?php the_sub_field('layout_content_modue_img_p'); ?>" alt=""> </div>
                          <div class="text_v2">
                            <p class="t-one">
                              <?php the_sub_field('layout_content_modue_p1'); ?>
                            </p>
                            <p class="t-two">
                              <?php the_sub_field('layout_content_modue_p2'); ?>
                            </p>
                          </div>
                        </div>
                        <?php $btn = get_sub_field('goup_button');
                        if ($btn):
                          $link_target = $btn['layout_content_modue_btn_link2'];
                          $link_url = $btn['layout_content_modue_btn_link2'];
                        ?>
                          <a target="<?php echo $link_target['target'] ?>" href="<?php echo  $link_url['url']; ?>" class="read-story button">
                            <?php echo $btn['layout_content_modue_desription2']; ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M5 12H19" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M12 5L19 12L12 19" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg></a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
              <?php

                endif;
              endwhile;

              ?>
            </div>
            <div class="pagination-block">
              <div class="loading-indicator loading-indicator2" style="display: none;"> <svg fill="blue" width="40" height="40" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <style>
                    .spinner_ngNb {
                      animation: spinner_ZRWK 1.2s cubic-bezier(0.52, .6, .25, .99) infinite
                    }

                    .spinner_6TBP {
                      animation-delay: .6s
                    }

                    @keyframes spinner_ZRWK {
                      0% {
                        transform: translate(12px, 12px) scale(0);
                        opacity: 1
                      }

                      100% {
                        transform: translate(0, 0) scale(1);
                        opacity: 0
                      }
                    }
                  </style>
                  <path class="spinner_ngNb" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)" />
                  <path class="spinner_ngNb spinner_6TBP" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,20a9,9,0,1,1,9-9A9,9,0,0,1,12,21Z" transform="translate(12, 12) scale(0)" />
                </svg></div>
              <div class="load-more load-more2 load"><a class="load-a load-a2">Load More Articles</a></div>
              <div class="paginator paginator2 pagination paginator_my" onclick="pagination2(event)">

              </div>
            </div>
          </div>
        </section>
      <?php
      endif;

    endif;


    
  endwhile;

else :

// макетов не найдено

endif;

?>



<?php

get_footer();
?>
<script src="<?php echo get_template_directory_uri(); ?>/script/pagination-my.js"></script>
