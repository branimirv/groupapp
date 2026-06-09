<?php /* Template Name: HomePage */ ?>
<?php

get_header();
?>
  <?php
  if (have_rows('content_block_home')):
    while (have_rows('content_block_home')) : the_row(); ?>
      <?php 
      if (get_row_layout() == 'hero_section') { ?>
        <section class="hero">
          <div class="container">
            <?php $heroTitle = get_sub_field('title'); ?>
            <div class="hero__text">
              <div class="hero__title">
                <h1>
                <?php echo $heroTitle['static_text']; ?></h1>
                <?php
                $hero_dynamic = isset($heroTitle['dynamic_text']) && is_array($heroTitle['dynamic_text'])
                  ? $heroTitle['dynamic_text']
                  : [];
                ?>
                <?php if (!empty($hero_dynamic)) : ?>
                <div class="hero__rotating" data-hero-rotating>
                  <ul class="hero__rotating-list">
                    <?php foreach ($hero_dynamic as $i => $item) : ?>
                      <li<?php echo $i === 0 ? ' class="is-active"' : ''; ?>><?php echo esc_html($item['text'] ?? ''); ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <?php endif; ?>
              </div>
              <p class="hero__description">
                <?php the_sub_field('description'); ?>
              </p>
              <div class="btn__block">
                <?php
                $btn_start = get_sub_field('button_start');
                $btn_demo = get_sub_field('button_demo');
                ?>
                <?php if ($btn_start) : ?>
                  <a href="<?php echo $btn_start['url']; ?>" target="<?php echo $btn_start['target']; ?>" class="btn btn--start"><?php echo $btn_start['title']; ?></a>
                <?php endif; ?>
                <?php if ($btn_demo) : ?>
                  <a href="<?php echo $btn_demo['url']; ?>" target="<?php echo $btn_demo['target']; ?>" class="btn btn--demo">
                    <span>
                      <?php echo $btn_demo['title']; ?>
                    </span>
                  </a>
                <?php endif; ?>
              </div>
            </div>
            <div class="hero__image">
              <?php
              $hero_image = get_sub_field('image');
              $hero_image_mobile = get_sub_field('image_mobile');
              $hero_has_desktop = groupapp_acf_has_image($hero_image);
              $hero_has_mobile = groupapp_acf_has_image($hero_image_mobile);
              $hero_desktop_sizes = $hero_has_mobile
                ? '(max-width: 767px) 0px, (max-width: 992px) 100vw, 1200px'
                : '(max-width: 992px) 100vw, 1200px';
              ?>
              <?php if ($hero_has_desktop) : ?>
                <?php
                groupapp_acf_image($hero_image, 'full', array(
                  'class'         => 'hero__image-img hero__image-img--desktop',
                  'sizes'         => $hero_desktop_sizes,
                  'loading'       => 'eager',
                  'fetchpriority' => 'high',
                ));
                ?>
              <?php endif; ?>
              <?php if ($hero_has_mobile && $hero_has_desktop) : ?>
                <?php
                groupapp_acf_image($hero_image_mobile, 'full', array(
                  'class'   => 'hero__image-img hero__image-img--mobile',
                  'sizes'   => '(max-width: 767px) min(370px, 100vw), 0px',
                  'loading' => 'eager',
                ));
                ?>
              <?php elseif ($hero_has_mobile) : ?>
                <?php
                groupapp_acf_image($hero_image_mobile, 'full', array(
                  'class'         => 'hero__image-img hero__image-img--desktop',
                  'sizes'         => '(max-width: 992px) 100vw, 1200px',
                  'loading'       => 'eager',
                  'fetchpriority' => 'high',
                ));
                ?>
              <?php endif; ?>
            </div>
            <div class="hero__small-description">
              <?php the_sub_field('small_description'); ?>
            </div>
          </div>
          <div class="hero__gallery-shell">
            <div class="hero__gallery">
              <?php
              $gallery = get_sub_field('programs_gallery');
              if ($gallery): ?>
                <?php foreach ($gallery as $image): ?>
                  <div class="hero__gallery-item"><img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'tools') { ?>
        <section class="tools">
          <div class="container">
            
            <h2><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <p class="tools__description">
              <?php the_sub_field('description'); ?>
            </p>
            <div class="tools__gallery">
              <?php
              $gallery = get_sub_field('tools_icons');
              if ($gallery): ?>
                <?php foreach ($gallery as $image): ?>
                  <div><img src="<?php echo esc_url($image['sizes']['thumbnail']); ?>" class="" alt="<?php echo esc_attr($image['alt']); ?>" /></div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'program_delivery') { ?>
        <section class="program-delivery">
          <div class="container">
            <p class="program-delivery__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h3 class="program-delivery__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
            <?php $tabs = get_sub_field("tabs"); ?>
            <?php if ($tabs): ?>
            <div class="program-delivery__tabs" data-program-delivery-tabs>
              <div class="program-delivery__tabs-nav-wrap">
                <ul class="program-delivery__tabs-nav" role="tablist">
                  <?php foreach ($tabs as $index => $tab): ?>
                    <li role="presentation">
                      <button
                        type="button"
                        class="program-delivery__tab<?php echo $index === 0 ? ' is-active' : ''; ?>"
                        role="tab"
                        id="program-delivery-tab-<?php echo esc_attr($index); ?>"
                        aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                        aria-controls="program-delivery-panel-<?php echo esc_attr($index); ?>"
                        tabindex="<?php echo $index === 0 ? '0' : '-1'; ?>"
                      >
                        <?php echo esc_html($tab['tabs_title']); ?>
                      </button>
                    </li>
                  <?php endforeach; ?>
                </ul>
                <span class="program-delivery__tabs-indicator" aria-hidden="true"></span>
              </div>
              <div class="program-delivery__descriptions">
                <?php foreach ($tabs as $index => $tab): ?>
                  <p
                    class="program-delivery__description<?php echo $index === 0 ? ' is-active' : ''; ?>"
                    data-program-delivery-description
                    <?php echo $index !== 0 ? 'hidden' : ''; ?>
                  ><?php echo esc_html($tab['tabs_description'] ?? ''); ?></p>
                <?php endforeach; ?>
              </div>
              <div class="program-delivery__tabs-content">
                <?php foreach ($tabs as $index => $tab): ?>
                  <?php $items = $tab['tabs_item']; ?>
                  <div
                    class="program-delivery__panel<?php echo $index === 0 ? ' is-active' : ''; ?>"
                    role="tabpanel"
                    id="program-delivery-panel-<?php echo esc_attr($index); ?>"
                    aria-labelledby="program-delivery-tab-<?php echo esc_attr($index); ?>"
                    <?php echo $index !== 0 ? 'hidden' : ''; ?>
                  >
                    <div class="program-delivery__cards">
                      <?php foreach ($items as $item_index => $item): ?>
                        <article class="program-delivery__card<?php echo $item_index === 0 ? ' program-delivery__card--featured' : ''; ?>">
                          <div class="program-delivery__card__inner">
                            <?php if (!empty($item['image']['url'])): ?>
                              <div class="program-delivery__card-media">
                                <img
                                  src="<?php echo esc_url($item['image']['url']); ?>"
                                  alt="<?php echo esc_attr($item['image']['alt'] ?? ''); ?>"
                                  <?php echo $index === 0 ? 'loading="eager"' : ''; ?>
                                >
                              </div>
                            <?php endif; ?>
                            <?php if (!empty($item['title'])): ?>
                              <h4 class="program-delivery__card-title"><?php echo esc_html($item['title']); ?></h4>
                            <?php endif; ?>
                            <?php if (!empty($item['description'])): ?>
                              <p class="program-delivery__card-description"><?php echo esc_html($item['description']); ?></p>
                            <?php endif; ?>
                          </div>
                        </article>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="program-delivery__accordion" data-program-delivery-accordion>
                <?php foreach ($tabs as $index => $tab): ?>
                  <?php $items = $tab['tabs_item']; ?>
                  <div class="program-delivery__accordion-item<?php echo $index === 0 ? ' is-active' : ''; ?>">
                    <button
                      type="button"
                      class="program-delivery__accordion-trigger<?php echo $index === 0 ? ' is-active' : ''; ?>"
                      data-program-delivery-accordion-trigger
                      aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                      aria-controls="program-delivery-accordion-panel-<?php echo esc_attr($index); ?>"
                      id="program-delivery-accordion-trigger-<?php echo esc_attr($index); ?>"
                    >
                      <?php echo esc_html($tab['tabs_title']); ?>
                    </button>
                    <div
                      class="program-delivery__accordion-panel<?php echo $index === 0 ? ' is-active' : ''; ?>"
                      data-program-delivery-accordion-panel
                      id="program-delivery-accordion-panel-<?php echo esc_attr($index); ?>"
                      role="region"
                      aria-labelledby="program-delivery-accordion-trigger-<?php echo esc_attr($index); ?>"
                      <?php echo $index !== 0 ? 'hidden' : ''; ?>
                    >
                      <div class="program-delivery__cards">
                        <?php foreach ($items as $item_index => $item): ?>
                          <article class="program-delivery__card<?php echo $item_index === 0 ? ' program-delivery__card--featured' : ''; ?>">
                            <div class="program-delivery__card__inner">
                              <?php if (!empty($item['image']['url'])): ?>
                                <div class="program-delivery__card-media">
                                  <img
                                    src="<?php echo esc_url($item['image']['url']); ?>"
                                    alt="<?php echo esc_attr($item['image']['alt'] ?? ''); ?>"
                                    loading="lazy"
                                    decoding="async"
                                  >
                                </div>
                              <?php endif; ?>
                              <?php if (!empty($item['title'])): ?>
                                <h4 class="program-delivery__card-title"><?php echo esc_html($item['title']); ?></h4>
                              <?php endif; ?>
                              <?php if (!empty($item['description'])): ?>
                                <p class="program-delivery__card-description"><?php echo esc_html($item['description']); ?></p>
                              <?php endif; ?>
                            </div>
                          </article>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'case_studies') { ?>
        <section class="case-studies">
          <div class="container">
            <p class="case-studies__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <div class="case-studies__titleAndLink">
              <h3 class="case-studies__title">
                <?php echo check_span_title(get_sub_field('title')); ?>
              </h3>
              <?php $link = get_sub_field('link'); ?>
              <?php if ($link) : ?>
                <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="btn btn--withArrow">
                  <p class="txt"><?php echo $link['title']; ?></p>
                  <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M4.99951 12H18.9995" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </a>
              <?php endif; ?>
            </div>
            <?php $slides = get_sub_field('slides'); ?>
            <?php if ($slides) : ?>
              <div class="case-studies__slider">
                <div class="case-studies__slides">
                  <?php foreach ($slides as $index => $slide) : ?>
                    <?php
                    $image = $slide['image'] ?? null;
                    if (!$image) {
                      continue;
                    }
                    ?>
                    <div class="case-studies__slide">
                      <div class="case-studies__slide-inner">
                      <img
                        class="case-studies__slide-image"
                        src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                        <?php echo $index === 0 ? '' : 'loading="lazy" decoding="async"'; ?>
                      >
                      <div>
                        <p class="case-studies__slide-subtitle"><?php echo $slide['subtitle']; ?></p>
                        <?php $stats = $slide['stats']; ?>
                        <?php if ($stats) : ?>
                          <div class="case-studies__slide-stats">
                            <?php foreach ($stats as $stat) : ?>
                              <div class="case-studies__slide-stat">
                                <p class="case-studies__slide-stat-metrics"><?php echo $stat['metrics']; ?></p>
                                <p class="case-studies__slide-stat-description"><?php echo $stat['description']; ?></p>
                              </div>
                            <?php endforeach; ?>
                          </div>
                        <?php endif; ?>
                        <p class="case-studies__slide-description"><?php echo $slide['description']; ?></p>
                        <?php $author = $slide['author']; ?>
                        <?php if ($author) : ?>
                          <div class="case-studies__slide-author">
                            <img
                              class="case-studies__slide-author-image"
                              src="<?php echo esc_url($image['url']); ?>"
                              alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                              <?php echo $index === 0 ? '' : 'loading="lazy" decoding="async"'; ?>
                            >
                            <div class="case-studies__slide-author-text">
                              <p class="case-studies__slide-author-name"><?php echo $author['name']; ?></p>
                              <p class="case-studies__slide-author-position"><?php echo $author['position']; ?></p>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php $link = $slide['link']; ?>
                        <?php if ($link) : ?>
                          <a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" class="btn btn--withArrow case-studies__slide-link">
                            <p class="txt"><?php echo $link['title']; ?></p>
                            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M4.99951 12H18.9995" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </a>
                        <?php endif; ?> 
                      </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
                <?php if (count($slides) > 1) : ?>
                  <?php get_template_part('template-parts/components/slider', 'arrows'); ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'more_programs') { ?>
        <section class="more-programs">
          <div class="container">
            <p class="more-programs__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h2 class="more-programs__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <p class="more-programs__description">
              <?php the_sub_field('description'); ?>
            </p>
            <?php $programs = get_sub_field('slides'); ?>
            <?php if ($programs) : ?>
              <div class="more-programs__items">
                <?php foreach ($programs as $program) : ?>
                  <div class="more-programs__item">
                    <img class="more-programs__item-image" src="<?php echo esc_url($program['image']['url']); ?>" alt="<?php echo esc_attr($program['image']['alt']); ?>">
                    <h4 class="more-programs__item-title"><?php echo $program['title']; ?></h4>
                    <p class="more-programs__item-description"><?php echo $program['description']; ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>
      
      <?php
      if (get_row_layout() == 'coaching_materials') { ?>
        <section class="coaching-materials">
          <div class="container">
            <p class="coaching-materials__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h2 class="coaching-materials__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <p class="coaching-materials__description">
              <?php the_sub_field('description'); ?>
            </p>
            <?php $image = get_sub_field('image'); ?>
            <?php if ($image) : ?>
              <img class="coaching-materials__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endif; ?>
            <?php $materials = get_sub_field('items'); ?>
            <?php if ($materials) : ?>
              <div class="coaching-materials__items">
                <?php foreach ($materials as $material) : ?>
                  <div class="coaching-materials__item">
                    <div class="coaching-materials__item-inner">
                      <h4 class="coaching-materials__item-title"><?php echo $material['title']; ?></h4>
                      <p class="coaching-materials__item-description"><?php echo $material['description']; ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'learning_experience') { ?>
        <section class="learning-experience">
          <div class="container">
            <p class="learning-experience__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h2 class="learning-experience__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <p class="learning-experience__description">
              <?php the_sub_field('description'); ?>
            </p>
            <div class="learning-experience__imageAndItems">
              <?php $image = get_sub_field('image'); ?>
              <?php if ($image) : ?>
                <img class="learning-experience__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
              <?php endif; ?>
              <ul class="learning-experience__items">
                <?php $items = get_sub_field('items'); ?>
                <?php if ($items) : ?>
                  <?php foreach ($items as $item) : ?>
                    <li class="learning-experience__item">
                      <h4 class="learning-experience__item-title"><?php echo $item['title']; ?></h4>
                      <p class="learning-experience__item-description"><?php echo $item['description']; ?></p>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'branded_app') { ?>
        <section class="branded-app">
          <div class="container">
            <p class="branded-app__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h2 class="branded-app__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <p class="branded-app__description">
              <?php the_sub_field('description'); ?>
            </p>
            <?php $image = get_sub_field('image'); ?>
            <?php if ($image) : ?>
              <img class="branded-app__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
            <?php endif; ?>
            <p class="branded-app__quote"><?php echo get_sub_field('quote'); ?></p>
            <?php $items = get_sub_field('items'); ?>
            <?php if ($items) : ?>
              <ul class="branded-app__items">
                <?php foreach ($items as $item) : ?>
                  <li class="branded-app__item">
                    <h4 class="branded-app__item-title"><?php echo $item['title']; ?></h4>
                    <p class="branded-app__item-description"><?php echo $item['description']; ?></p>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'integrations') {
        $items = get_sub_field('items');
      ?>
        <section class="integrations-home" data-integrations-home>
          <div class="container">
            <div class="integrations-home__content-wrapper">
              <div class="integrations-home__content">
                <p class="integrations-home__subtitle">
                  <?php echo get_sub_field("subtitle"); ?>
                </p>
                <h2 class="integrations-home__title">
                  <?php echo check_span_title(get_sub_field('title')); ?>
                </h2>
                <p class="integrations-home__description">
                  <?php the_sub_field('description'); ?>
                </p>
                <?php if ($items) : ?>
                  <div class="integrations-home__media integrations-home__media--mobile">
                    <div class="integrations-home__images">
                      <?php foreach ($items as $index => $item) :
                        $image = $item['image'] ?? null;
                        ?>
                        <div class="integrations-home__panel-preview<?php echo $index === 0 ? ' is-active' : ''; ?>">
                          <?php if (!empty($image) && is_array($image)) : ?>
                            <img
                              class="integrations-home__image"
                              src="<?php echo esc_url($image['url']); ?>"
                              alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                              width="<?php echo esc_attr($image['width'] ?? ''); ?>"
                              height="<?php echo esc_attr($image['height'] ?? ''); ?>"
                              loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                              decoding="async">
                          <?php endif; ?>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ($items) : ?>
                  <ul class="integrations-home__items" role="tablist" aria-label="<?php esc_attr_e('Integration categories', 'groupapp'); ?>">
                    <?php foreach ($items as $index => $item) : ?>
                      <li class="integrations-home__items-entry" role="presentation">
                        <button
                          type="button"
                          class="integrations-home__item<?php echo $index === 0 ? ' is-active' : ''; ?>"
                          role="tab"
                          id="integrations-home-tab-<?php echo esc_attr($index); ?>"
                          aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                          aria-controls="integrations-home-panel-<?php echo esc_attr($index); ?>"
                          tabindex="<?php echo $index === 0 ? '0' : '-1'; ?>">
                          <?php echo esc_html($item['title'] ?? ''); ?>
                        </button>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <?php $link = get_sub_field('link'); ?>
                <?php if ($link) : ?>
                  <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>" class="btn btn--withArrow integrations-home__link">
                    <p class="txt"><?php echo esc_html($link['title']); ?></p>
                    <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M4.99951 12H18.9995" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </a>
                <?php endif; ?>
              </div>
              <?php if ($items) : ?>
                <div class="integrations-home__media integrations-home__media--desktop">
                  <div class="integrations-home__images">
                    <?php foreach ($items as $index => $item) :
                      $image = $item['image'] ?? null;
                      ?>
                      <div
                        class="integrations-home__panel<?php echo $index === 0 ? ' is-active' : ''; ?>"
                        role="tabpanel"
                        id="integrations-home-panel-<?php echo esc_attr($index); ?>"
                        aria-labelledby="integrations-home-tab-<?php echo esc_attr($index); ?>"
                        <?php echo $index === 0 ? '' : ' hidden'; ?>>
                        <?php if (!empty($image) && is_array($image)) : ?>
                          <img
                            class="integrations-home__image"
                            src="<?php echo esc_url($image['url']); ?>"
                            alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                            width="<?php echo esc_attr($image['width'] ?? ''); ?>"
                            height="<?php echo esc_attr($image['height'] ?? ''); ?>"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                            decoding="async">
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      <?php
      } ?>

      <?php
      if (get_row_layout() == 'testimonials') { ?>
        <section class="testimonials">
          <div class="container">
            <p class="testimonials__subtitle"><?php echo get_sub_field("subtitle"); ?></p>
            <h2 class="testimonials__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
            <?php $slides = get_sub_field('slides'); ?>
            <?php if ($slides) : ?>
              <?php $testimonials_modal_index = 0; ?>
              <div class="testimonials__slider-wrap">
              <div class="testimonials__slider">
                <div class="testimonials__slides">
                  <?php foreach ($slides as $slide) : ?>
                    <?php
                    $author = $slide['author'] ?? null;
                    $avatar = $slide['avatar'] ?? null;
                    $content = $slide['content'] ?? null;
                    $link = $slide['link'] ?? null;
                    $description_excerpt = is_array($content) ? ($content['description_excerpt'] ?? '') : '';
                    $description_continuation = is_array($content) ? ($content['description_continuation'] ?? '') : '';
                    $has_read_more = !empty($description_continuation);
                    if ($has_read_more) {
                      $testimonials_modal_index++;
                    }
                    $testimonials_modal_id = $has_read_more ? 'testimonials-modal-' . $testimonials_modal_index : '';
                    ?>
                    <div class="testimonials__slide">
                      <article class="testimonials__slide-card">
                        <?php if ($author || $avatar) : ?>
                          <div class="testimonials__slide-author">
                            <?php if ($avatar) : ?>
                              <img
                                class="testimonials__slide-author-avatar"
                                src="<?php echo esc_url($avatar['url']); ?>"
                                alt="<?php echo esc_attr($avatar['alt'] ?? ''); ?>"
                                width="48"
                                height="48"
                                loading="lazy"
                                decoding="async"
                              >
                            <?php endif; ?>
                            <?php if ($author) : ?>
                              <div class="testimonials__slide-author-info">
                                <?php if (!empty($author['name'])) : ?>
                                  <p class="testimonials__slide-author-name"><?php echo esc_html($author['name']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($author['position'])) : ?>
                                  <p class="testimonials__slide-author-position"><?php echo esc_html($author['position']); ?></p>
                                <?php endif; ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>
                        <?php if ($content) : ?>
                          <div class="testimonials__slide-content">
                            <?php if (!empty($content['title'])) : ?>
                              <h4 class="testimonials__slide-content-title"><?php echo $content['title']; ?></h4>
                            <?php endif; ?>
                            <?php if ($description_excerpt) : ?>
                              <p class="testimonials__slide-content-description">
                                <?php echo $description_excerpt; ?><?php if ($has_read_more) : ?><span class="testimonials__slide-content-ellipsis">...</span><?php endif; ?>
                              </p>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>
                        <?php if ($has_read_more) : ?>
                          <button
                            type="button"
                            class="btn btn--withArrow testimonials__slide-read-more"
                            data-testimonials-modal-open="<?php echo esc_attr($testimonials_modal_id); ?>"
                            aria-haspopup="dialog"
                          >
                            <p class="txt">Read more</p>
                            <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                              <path d="M4.99951 12H18.9995" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                              <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="#202125" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                          </button>
                        <?php endif; ?>
                      </article>
                    </div>
                  <?php endforeach; ?>
                </div>
                <?php if (count($slides) > 1) : ?>
                  <?php get_template_part('template-parts/components/slider', 'arrows'); ?>
                <?php endif; ?>
              </div>
            </div>
            <?php
            $testimonials_modal_index = 0;
            foreach ($slides as $slide) :
              $modal_content = $slide['content'] ?? null;
              $modal_continuation = is_array($modal_content) ? ($modal_content['description_continuation'] ?? '') : '';
              if (empty($modal_continuation)) {
                continue;
              }
              $testimonials_modal_index++;
              $modal_author = $slide['author'] ?? null;
              $modal_avatar = $slide['avatar'] ?? null;
              $modal_excerpt = is_array($modal_content) ? ($modal_content['description_excerpt'] ?? '') : '';
              $modal_title = is_array($modal_content) ? ($modal_content['title'] ?? '') : '';
              $modal_body = $modal_excerpt . $modal_continuation;
              ?>
              <div
                class="testimonials-modal"
                id="testimonials-modal-<?php echo esc_attr($testimonials_modal_index); ?>"
                role="dialog"
                aria-modal="true"
                <?php if ($modal_title) : ?>aria-labelledby="testimonials-modal-title-<?php echo esc_attr($testimonials_modal_index); ?>"<?php else : ?>aria-label="Testimonial"<?php endif; ?>
                aria-hidden="true"
              >
                <button type="button" class="testimonials-modal__backdrop" data-testimonials-modal-close aria-label="Close dialog"></button>
                <div class="testimonials-modal__dialog">
                  <button type="button" class="testimonials-modal__close" data-testimonials-modal-close aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <?php if ($modal_author || $modal_avatar) : ?>
                    <div class="testimonials-modal__author">
                      <?php if ($modal_avatar) : ?>
                        <img
                          class="testimonials-modal__author-avatar"
                          src="<?php echo esc_url($modal_avatar['url']); ?>"
                          alt="<?php echo esc_attr($modal_avatar['alt'] ?? ''); ?>"
                          width="64"
                          height="64"
                          loading="lazy"
                          decoding="async"
                        >
                      <?php endif; ?>
                      <?php if ($modal_author) : ?>
                        <div>
                          <?php if (!empty($modal_author['name'])) : ?>
                            <p class="testimonials-modal__author-name"><?php echo esc_html($modal_author['name']); ?></p>
                          <?php endif; ?>
                          <?php if (!empty($modal_author['position'])) : ?>
                            <p class="testimonials-modal__author-position"><?php echo esc_html($modal_author['position']); ?></p>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                  <?php if ($modal_title) : ?>
                    <h3 class="testimonials-modal__title" id="testimonials-modal-title-<?php echo esc_attr($testimonials_modal_index); ?>"><?php echo $modal_title; ?></h3>
                  <?php endif; ?>
                  <div class="testimonials-modal__body"><?php echo $modal_body; ?></div>
                </div>
              </div>
            <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </section>
      <?php
      } ?>

  <?php endwhile;
  endif; ?>


<?php

get_footer();
