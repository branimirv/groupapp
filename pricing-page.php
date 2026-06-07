<?php /* Template Name: Pricing */ ?>

<?php

get_header();
?>
<?php
if (have_rows('pricing_content')):

  // Loop through rows.
  while (have_rows('pricing_content')) : the_row();

    // Case: Content Image Module.
    if (get_row_layout() == 'pricing_top') { ?>
      <section class="section-pricing-one">
        <div class="container">
          <div class="row">
            <div class="col-12 pricing__hero">
              <?php $group = get_sub_field('group_headline');
              if ($group): ?>
                <div class="block-text">
                  <p class="pricing__hero-subtitle"><?php echo get_the_title(); ?></p>
                  <h2><?php echo check_span_title($group['title']); ?></h2>
                  <p class="t-small"><?php echo ($group['description']); ?></p>
                </div>

              <?php endif; ?>
            </div>
          </div>
        </div>
      </section>
    <?php }
    if (get_row_layout() == 'pricing_plan') { ?>
      <section class="pricing-plans">
        <div class="container">
          <div class="pricing-plans__wrapper justify-content-center">
            <?php if (have_rows('content_starter')) : ?>
              <?php while (have_rows('content_starter')) : the_row(); ?>
                <?php
                $parent_title = get_sub_field('title');
                $parent_description = get_sub_field('description');
                $price_month = get_sub_field('price_month');
                $parent_price_year = get_sub_field('price_year');
                $text_after_price_month = get_sub_field('text_after_monthly_price');
                $text_after_price_year = get_sub_field('text_after_yearly_price');
                $description_price_mounth = get_sub_field('description_price_mounth');
                $description_price_year = get_sub_field('description_price_year');
                $button = get_sub_field('button');
                $link = get_sub_field('link');
                $link2 = get_sub_field('link2');
                $recommended = get_sub_field('recommended');
                $hide = get_sub_field('hide');
                ?>
                <div class="pricing-plans__card pricing-plans__card--<?php echo str_replace(' ', '_', strtolower($parent_title)); ?> <?php echo ($recommended == 'yes') ? 'is-recommended' : ''; ?> <?php echo ($hide == 'yes') ? 'is-hidden' : ''; ?>">
                  <?php if ($recommended == 'yes') : ?>
                    <div class="pricing-plans__badge">
                      <div class="pricing-plans__badge-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                          <g clip-path="url(#clip0_16273_19839)">
                            <path d="M8.50065 1.33398L10.5607 5.50732L15.1673 6.18065L11.834 9.42732L12.6207 14.014L8.50065 11.8473L4.38065 14.014L5.16732 9.42732L1.83398 6.18065L6.44065 5.50732L8.50065 1.33398Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </g>
                          <defs>
                            <clipPath id="clip0_16273_19839">
                              <rect width="16" height="16" fill="white" transform="translate(0.5)" />
                            </clipPath>
                          </defs>
                        </svg>
                        Recommended
                      </div>
                    </div>
                  <?php endif; ?>
                  <div class="pricing-plans__card-inner">
                    <div class="pricing-plans__card-content">
                      <div class="pricing-plans__card-body">
                        <p class="pricing-plans__title">
                          <?php echo ($parent_title); ?>
                        </p>
                        <p class="pricing-plans__description">
                          <?php echo ($parent_description); ?>
                        </p>
                        <p class="pricing-plans__price">
                          <span class="pricing-plans__price-value--monthly">
                            <?php echo ($price_month); ?>
                            <span class="pricing-plans__price-period"><?php echo ($text_after_price_month); ?></span>
                          </span>
                          <span class="pricing-plans__price-value--yearly">
                            <?php echo ($parent_price_year); ?>
                            <span class="pricing-plans__price-period"><?php echo ($text_after_price_year); ?></span>
                          </span> 
                        </p>
                        <p class="pricing-plans__price-caption">
                          <span class="pricing-plans__caption--yearly is-caption-visible"><?php echo ($description_price_year); ?></span>
                          <span class="pricing-plans__caption--monthly is-caption-hidden"> <?php echo ($description_price_mounth); ?></span>
                        </p>
                        <?php if (have_rows('stats')) : ?>
                          <ul class="pricing-plans__stats">
                            <?php while (have_rows('stats')) : the_row(); ?>
                              <?php 
                                $statField = get_sub_field('stat_description');
                                $statIcon = get_sub_field('icon');
                               ?>
                              <li>
                                <?php if ($statIcon): ?>
                                  <img src="<?php echo $statIcon['url']; ?>" alt="<?php echo $statIcon['alt']; ?>">
                                <?php endif; ?>
                                <?php echo check_span_title($statField); ?>
                              </li>
                            <?php endwhile; ?>
                          </ul>
                        <?php endif; ?>
                        <span class="pricing-plans__features-heading"><?php the_sub_field('option_title'); ?></span>
                        <div class="pricing-plans__features">
                          <?php
                          if (have_rows('option_content')):
                            while (have_rows('option_content')) : the_row();
                          ?>
                              <?php
                              $child_image = get_sub_field('image');
                              $child_option = get_sub_field('option');
                              ?>
                              <p class="pricing-plans__feature"><?php if ($child_option): ?>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M13.3327 4L5.99935 11.3333L2.66602 8" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                  <?php echo ($child_option); ?>
                                <?php else: ?>
                                  &nbsp;
                                <?php endif; ?>
                              </p>
                          <?php
                            endwhile;
                          endif;
                          ?>
                        </div>
                      </div>
                      <div class="pricing-plans__card-footer">
                      <div class="pricing-plans__cta--monthly">
                        <?php $btn = get_sub_field('monthly_link');
                        if ($btn):
                          $link_target = $btn['link'];
                          $link_url = $btn['link'];
                        ?>
                          <a class="button" href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>">
                            <button type="button"><?php echo esc_html( $button ); ?></button>
                          </a>
                        <?php endif; ?>
                      </div>
                      <div class="pricing-plans__cta--yearly">
                        <?php $btn = get_sub_field('yearly_link');
                        if ($btn):
                          $link_target = $btn['link'];
                          $link_url = $btn['link'];
                        ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>">
                            <button type="button"><?php echo esc_html( $button ); ?></button>
                          </a>
                        <?php endif; ?>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            <?php endif; ?>
            <?php
            if (have_rows('content_basic')):
              while (have_rows('content_basic')) : the_row(); ?>
                <?php
                $parent_title = get_sub_field('title');
                $parent_description = get_sub_field('description');
                $price_month = get_sub_field('price_month');
                $parent_price_year = get_sub_field('price_year');
                $text_after_price_month = get_sub_field('text_after_monthly_price');
                $text_after_price_year = get_sub_field('text_after_yearly_price');
                $description_price_mounth = get_sub_field('description_price_mounth');
                $description_price_year = get_sub_field('description_price_year');
                $button = get_sub_field('button');
                $link = get_sub_field('link');
                $link2 = get_sub_field('link2');
                $recommended = get_sub_field('recommended');
                $hide = get_sub_field('hide');
                ?>
                <div class="pricing-plans__card <?php echo ($hide == 'yes') ? 'is-hidden' : ''; ?> pricing-plans__card--starter <?php echo ($recommended == 'yes') ? 'is-recommended' : ''; ?>">
                  <?php if ($recommended == 'yes') : ?>
                    <div class="pricing-plans__badge">
                      <div class="pricing-plans__badge-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                          <g clip-path="url(#clip0_16273_19839)">
                            <path d="M8.50065 1.33398L10.5607 5.50732L15.1673 6.18065L11.834 9.42732L12.6207 14.014L8.50065 11.8473L4.38065 14.014L5.16732 9.42732L1.83398 6.18065L6.44065 5.50732L8.50065 1.33398Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </g>
                          <defs>
                            <clipPath id="clip0_16273_19839">
                              <rect width="16" height="16" fill="white" transform="translate(0.5)" />
                            </clipPath>
                          </defs>
                        </svg>
                        Recommended
                      </div>  
                    </div>
                  <?php endif ?>
                  <div class="pricing-plans__card-inner">
                    <div class="pricing-plans__card-content">
                      <div class="pricing-plans__card-body">
                        <p class="pricing-plans__title">
                          <?php echo ($parent_title); ?>
                        </p>
                        <p class="pricing-plans__description">
                          <?php echo ($parent_description); ?>
                        </p>
                        <p class="pricing-plans__price"><span class="pricing-plans__price-value--monthly"><?php echo ($price_month); ?><span class="pricing-plans__price-period"><?php echo ($text_after_price_month); ?></span></span><span class="pricing-plans__price-value--yearly"><?php echo ($parent_price_year); ?><span class="pricing-plans__price-period"><?php echo ($text_after_price_year); ?></span></span></p>
                        <p class="pricing-plans__price-caption"><span class="pricing-plans__caption--yearly is-caption-visible"><?php echo ($description_price_year); ?></span>
                          <span class="pricing-plans__caption--monthly is-caption-hidden"> <?php echo ($description_price_mounth); ?></span>
                        </p>
                        <?php if (have_rows('stats')) : ?>
                          <ul class="pricing-plans__stats">
                            <?php while (have_rows('stats')) : the_row(); ?>
                              <?php 
                                $statField = get_sub_field('stat_description'); 
                                $statIcon = get_sub_field('icon');  
                              ?>
                              <li>
                                <?php if ($statIcon): ?>
                                  <img src="<?php echo $statIcon['url']; ?>" alt="<?php echo $statIcon['alt']; ?>">
                                <?php endif; ?>  
                                <?php echo check_span_title($statField); ?>
                            </li>
                            <?php endwhile; ?>
                          </ul>
                        <?php endif; ?>
                        <span class="pricing-plans__features-heading"><?php the_sub_field('option_title'); ?></span>
                        <div class="pricing-plans__features">
                          <?php
                          if (have_rows('option_content')):
                            while (have_rows('option_content')) : the_row();

                              // Get sub value.
                              $child_image = get_sub_field('image');
                              $child_option = get_sub_field('option');
                          ?>
                              <p class="pricing-plans__feature"><?php if ($child_option): ?>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M13.3327 4L5.99935 11.3333L2.66602 8" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                  <?php echo ($child_option); ?>
                                <?php else: ?>
                                  &nbsp;
                                <?php endif; ?>
                              </p>
                          <?php
                            endwhile;
                          endif;
                          ?>
                        </div>
                      </div>
                      <div class="pricing-plans__card-footer">
                      <div class="pricing-plans__cta--monthly"> <?php $btn = get_sub_field('monthly_link');
                                          if ($btn):
                                            $link_target = $btn['link'];
                                            $link_url = $btn['link'];
                                          ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      <div class="pricing-plans__cta--yearly"> <?php $btn = get_sub_field('yearly_link');
                                          if ($btn):
                                            $link_target = $btn['link'];
                                            $link_url = $btn['link'];
                                          ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              endwhile;
            endif;
            ?>
            <?php
            if (have_rows('content_pro')):
              while (have_rows('content_pro')) : the_row(); ?>
                <?php
                $parent_title = get_sub_field('title');
                $parent_description = get_sub_field('description');
                $price_month = get_sub_field('price_month');
                $parent_price_year = get_sub_field('price_year');
                $text_after_price_month = get_sub_field('text_after_monthly_price');
                $text_after_price_year = get_sub_field('text_after_yearly_price');
                $description_price_mounth = get_sub_field('description_price_mounth');
                $description_price_year = get_sub_field('description_price_year');
                $button = get_sub_field('button');
                $link = get_sub_field('link');
                $link2 = get_sub_field('link2');
                $recomender = get_sub_field('recomender');
                $start = get_sub_field('start');
                $recommended = get_sub_field('recommended');
                $hide = get_sub_field('hide');
                ?>
                <div class="pricing-plans__card <?php echo ($hide == 'yes') ? 'is-hidden' : ''; ?> pricing-plans__card--pro <?php echo ($recommended == 'yes') ? 'is-recommended' : ''; ?>">
                  <?php if ($recommended == 'yes') : ?>
                    <div class="pricing-plans__badge">
                      <div class="pricing-plans__badge-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                          <g clip-path="url(#clip0_16273_19839)">
                            <path d="M8.50065 1.33398L10.5607 5.50732L15.1673 6.18065L11.834 9.42732L12.6207 14.014L8.50065 11.8473L4.38065 14.014L5.16732 9.42732L1.83398 6.18065L6.44065 5.50732L8.50065 1.33398Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </g>
                          <defs>
                            <clipPath id="clip0_16273_19839">
                              <rect width="16" height="16" fill="white" transform="translate(0.5)" />
                            </clipPath>
                          </defs>
                        </svg>
                        Recommended
                      </div>
                    </div>
                  <?php endif ?>
                  <div class="pricing-plans__card-inner">
                    <div class="pricing-plans__card-content">
                      <div class="pricing-plans__card-body">
                        <p class="pricing-plans__title">
                          <?php echo ($parent_title); ?>
                        </p>
                        <p class="pricing-plans__description">
                          <?php echo ($parent_description); ?>
                        </p>
                        <p class="pricing-plans__price">
                          <span class="pricing-plans__price-value--monthly">
                            <?php echo ($price_month); ?>
                            <span class="pricing-plans__price-period"><?php echo ($text_after_price_month); ?></span>
                          </span>
                          <span class="pricing-plans__price-value--yearly">
                            <?php echo ($parent_price_year); ?>
                            <span class="pricing-plans__price-period"><?php echo ($text_after_price_year); ?></span>
                          </span> 
                        </p>
                        <p class="pricing-plans__price-caption"><span class="pricing-plans__caption--yearly is-caption-visible"><?php echo ($description_price_year); ?></span>
                          <span class="pricing-plans__caption--monthly is-caption-hidden"> <?php echo ($description_price_mounth); ?></span>
                        </p>
                        <?php if (have_rows('stats')) : ?>
                          <ul class="pricing-plans__stats">
                            <?php while (have_rows('stats')) : the_row(); ?>
                              <?php 
                                $statField = get_sub_field('stat_description');
                                $statIcon = get_sub_field('icon');
                              ?>
                              <li>
                                <?php if ($statIcon): ?>
                                  <img src="<?php echo $statIcon['url']; ?>" alt="<?php echo $statIcon['alt']; ?>">
                                <?php endif; ?>
                                <?php echo check_span_title($statField); ?>
                              </li>
                            <?php endwhile; ?>
                          </ul>
                        <?php endif; ?>
                        <span class="pricing-plans__features-heading"><?php the_sub_field('option_title'); ?></span>
                        <div class="pricing-plans__features">
                          <?php
                          if (have_rows('option_content')):
                            while (have_rows('option_content')) : the_row();
                              // Get sub value.
                              $child_image = get_sub_field('image');
                              $child_option = get_sub_field('option');
                          ?>
                              <p class="pricing-plans__feature">
                                <?php if ($child_option): ?>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" viewBox="0 0 14 10" fill="none">
                                    <path d="M12.3327 1L4.99935 8.33333L1.66602 5" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                  <?php echo ($child_option); ?>
                                <?php else: ?>
                                  &nbsp;
                                <?php endif; ?>
                              </p>
                          <?php
                            endwhile;
                          endif;
                          ?>
                        </div>
                      </div>

                      <div class="pricing-plans__card-footer">
                      <div class="pricing-plans__cta--monthly">
                        <?php $btn = get_sub_field('monthly_link');
                        if ($btn):
                          $link_target = $btn['link'];
                          $link_url = $btn['link'];
                        ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      <div class="pricing-plans__cta--yearly"> <?php $btn = get_sub_field('yearly_link');
                                          if ($btn):
                                            $link_target = $btn['link'];
                                            $link_url = $btn['link'];
                                          ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

            <?php
              endwhile;
            endif;
            ?>
            <?php
            if (have_rows('content_premium')):
              while (have_rows('content_premium')) : the_row(); ?>
                <?php
                $parent_title = get_sub_field('title');
                $parent_description = get_sub_field('description');
                $price_month = get_sub_field('price_month');
                $parent_price_year = get_sub_field('price_year');
                $text_after_price_month = get_sub_field('text_after_monthly_price');
                $text_after_price_year = get_sub_field('text_after_yearly_price');
                $description_price_mounth = get_sub_field('description_price_mounth');
                $description_price_year = get_sub_field('description_price_year');
                $button = get_sub_field('button');
                $link = get_sub_field('link');
                $link2 = get_sub_field('link2');
                $recommended = get_sub_field('recommended');
                $hide = get_sub_field('hide');
                ?>
                <div class="pricing-plans__card <?php echo ($hide == 'yes') ? 'is-hidden' : ''; ?> pricing-plans__card--business <?php echo ($recommended == 'yes') ? 'is-recommended' : ''; ?>">
                  <?php if ($recommended == 'yes') : ?>
                    <div class="pricing-plans__badge">
                      <div class="pricing-plans__badge-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                          <g clip-path="url(#clip0_16273_19839)">
                            <path d="M8.50065 1.33398L10.5607 5.50732L15.1673 6.18065L11.834 9.42732L12.6207 14.014L8.50065 11.8473L4.38065 14.014L5.16732 9.42732L1.83398 6.18065L6.44065 5.50732L8.50065 1.33398Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </g>
                          <defs>
                            <clipPath id="clip0_16273_19839">
                              <rect width="16" height="16" fill="white" transform="translate(0.5)" />
                            </clipPath>
                          </defs>
                        </svg>
                        Recommended
                      </div>
                    </div>
                  <?php endif ?>
                  <div class="pricing-plans__card-inner">
                    <div class="pricing-plans__card-content">
                      <div class="pricing-plans__card-body">
                        <p class="pricing-plans__title">
                          <?php echo ($parent_title); ?>
                        </p>
                        <p class="pricing-plans__description">
                          <?php echo ($parent_description); ?>
                        </p>
                        <p class="pricing-plans__price"><span class="pricing-plans__price-value--monthly"><?php echo ($price_month); ?><span class="pricing-plans__price-period"><?php echo ($text_after_price_month); ?></span></span><span class="pricing-plans__price-value--yearly"><?php echo ($parent_price_year); ?><span class="pricing-plans__price-period"><?php echo ($text_after_price_year); ?></span></span> </p>
                        <p class="pricing-plans__price-caption"><span class="pricing-plans__caption--yearly is-caption-visible"><?php echo ($description_price_year); ?></span>
                          <span class="pricing-plans__caption--monthly is-caption-hidden"> <?php echo ($description_price_mounth); ?></span>
                        </p>
                        <?php if (have_rows('stats')) : ?>
                          <ul class="pricing-plans__stats">
                            <?php while (have_rows('stats')) : the_row(); ?>
                              <?php 
                                $statField = get_sub_field('stat_description'); 
                                $statIcon = get_sub_field('icon');
                              ?>
                              <li>
                                <?php if ($statIcon): ?>
                                  <img src="<?php echo $statIcon['url']; ?>" alt="<?php echo $statIcon['alt']; ?>">
                                <?php endif; ?>
                                <?php echo check_span_title($statField); ?>
                              </li>
                            <?php endwhile; ?>
                          </ul>
                        <?php endif; ?>
                        <span class="pricing-plans__features-heading"><?php the_sub_field('option_title'); ?></span>
                        <div class="pricing-plans__features">
                          <?php
                          if (have_rows('option_content')):
                            while (have_rows('option_content')) : the_row();

                              // Get sub value.
                              $child_image = get_sub_field('image');
                              $child_option = get_sub_field('option');
                          ?>
                              <p class="pricing-plans__feature">
                                <?php if ($child_option): ?>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <path d="M13.3327 4L5.99935 11.3333L2.66602 8" stroke="#365DE6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>

                                  <?php echo ($child_option); ?>
                                <?php else: ?>
                                  &nbsp;
                                <?php endif; ?>
                              </p>
                          <?php
                            endwhile;
                          endif;
                          ?>
                        </div>
                      </div>
                      <div class="pricing-plans__card-footer">
                      <div class="pricing-plans__cta--monthly"> <?php $btn = get_sub_field('monthly_link');
                                          if ($btn):
                                            $link_target = $btn['link'];
                                            $link_url = $btn['link'];
                                          ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      <div class="pricing-plans__cta--yearly"> <?php $btn = get_sub_field('yearly_link');
                                          if ($btn):
                                            $link_target = $btn['link'];
                                            $link_url = $btn['link'];
                                          ?>
                          <a class='button' href="<?php echo  $link_url['url']; ?>" target="<?php echo $link_target['target'] ?>"><button type="button"><?php echo esc_html( $button ); ?></button></a><?php endif; ?>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              endwhile;
            endif;
            ?>
          </div>
        </div>
      </section>

    <?php
    }

    if (get_row_layout() == 'component_pricing') {
    ?>
      <section class="pricing-billing">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <?php $group = get_sub_field('content_pricing');
              if ($group): ?>
                <div class="pricing-billing__toggle justify-content-center">
                  <span class="pricing-billing__label pricing-billing__label--monthly"></span>
                  <span class="pricing-billing__label pricing-billing__label--yearly is-active"></span>
                  <div class="pricing-billing__switch is-yearly" role="button" tabindex="0" aria-label="<?php esc_attr_e( 'Toggle billing period', 'groupapp' ); ?>">
                    <span class="pricing-billing__switch-label"><?php echo esc_html( $group['mounth'] ); ?></span>
                    <div class="pricing-billing__switch-indicator is-shifted"></div>
                    <span class="pricing-billing__switch-label"><?php echo esc_html( $group['year'] ); ?><span class="pricing-billing__save-badge"><?php echo esc_html( $group['save'] ); ?></span></span>
                  </div>
                </div>

              <?php endif; ?>

            </div>
          </div>
        </div>
      </section>






    <?php
    }
    if (get_row_layout() == 'content_faq') {
    ?>
      <?php
      get_template_part(
        'template-parts/faq-section',
        null,
        groupapp_get_faq_section_args(
          get_sub_field( 'block_faq' ),
          get_sub_field( 'headline' ),
          'title',
          'description'
        )
      );
      ?>





    <?php
    }
    if (get_row_layout() == 'content_bottom') {
    ?>


    <?php
    } ?>

    <?php if (get_row_layout() == 'content_dropdown') {
    ?>
      <section class="pricing-comparison__expand-section">
        <div class="container">
          <div class="row">
            <div class="col-12 d-flex justify-content-center pricing-comparison__expand-section__wrapper">
              <button type="button" class="pricing-comparison__expand">
                <div>
                  <span class="pricing-comparison__expand-label--show">View all plan features</span>
                  <span class="pricing-comparison__expand-label--hide" hidden>Hide plan features</span>
                </div>
                <span class="icon-toggle is-active" aria-hidden="true">
                  <span></span>
                  <span></span>
                </span>
              </button>
            </div>
          </div>
        </div>
      </section>
      <section class="pricing-comparison">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="pricing-comparison__content">
              <table class="pricing-comparison__table pricing-comparison__table--header">
                <tr>
                  <?php
                  $group1 = get_sub_field('table_top_1');
                  if ($group1):
                  ?>
                    <td>
                      <?php echo ($group1['title']); ?>
                    </td>
                  <?php endif; ?>
                  <?php $initailGroup2 = get_sub_field('initial'); ?>
                  <?php if($initailGroup2 && $initailGroup2['hide'] == 'no'): ?>
                    <td class="pricing-comparison__plan-col pricing-comparison__plan-col--1">
                      <div class="pricing-comparison__plan-label">
                        <p><?php echo ($initailGroup2['title']); ?></p>
                      </div>
                    </td>
                  <?php endif; ?>
                  <?php
                  $group2 = get_sub_field('table_top_2');
                  if ($group2['title']):
                  ?>
                    <td class="pricing-comparison__plan-col pricing-comparison__plan-col--1">
                      <div class="pricing-comparison__plan-label">
                        <p><?php echo ($group2['title']); ?></p>
                      </div>
                    </td>
                  <?php endif; ?>
                  <td class="pricing-comparison__plan-col pricing-comparison__plan-col--2 is-active">
                    <div class="pricing-comparison__plan-label">
                      <?php
                      $group3 = get_sub_field('table_top_3');
                      if ($group3):
                      ?>
                        <?php if ($group3['image']) : ?><img src="<?php echo ($group3['image']); ?>" alt=""><?php endif; ?>
                        <p><?php echo ($group3['title']); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td class="pricing-comparison__plan-col pricing-comparison__plan-col--3">
                    <div class="pricing-comparison__plan-label">
                      <?php
                      $group4 = get_sub_field('table_top_4');
                      if ($group4):
                      ?>
                        <p><?php echo ($group4['title']); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                  <?php
                  $group5 = get_sub_field('table_top_5');
                  if (isset($group5['title']) && $group5['title']):
                  ?>
                    <td class="pricing-comparison__plan-col pricing-comparison__plan-col--4">
                      <div class="pricing-comparison__plan-label">
                        <?php if ($group5['image']) : ?><img src="<?php echo ($group5['image']); ?>" alt=""><?php endif; ?>
                        <p><?php echo ($group5['title']); ?></p>
                      <?php endif; ?>
                      </div>
                    </td>
                </tr>
              </table>
              <div class="pricing-comparison__body">
                <?php $hideInitialColumn = get_sub_field('initial')['hide']; ?>
                <?php
                $pricing_tooltip_modals = array();
                $pricing_tooltip_modal_index = 0;
                if (have_rows('table_content')):
                  while (have_rows('table_content')) : the_row(); ?>
                    <?php $parent_title = get_sub_field('title'); ?>
                    <div class="pricing-comparison__group">
                      <div class="d-flex justify-content-between align-content-center pricing-comparison__group-header">
                        <p class="pricing-comparison__group-title"><?php echo ($parent_title); ?></p>
                        <button type="button" class="pricing-comparison__group-toggle">
                          <span class="icon-toggle" aria-hidden="true">
                            <span></span>
                            <span></span>
                          </span>
                        </button>
                      </div>

                      <?php if (have_rows('option_content')): ?>
                        <table class="pricing-comparison__table pricing-comparison__table--features">
                          <?php while (have_rows('option_content')) : the_row(); ?>
                            <?php
                            $child_tab1 = get_sub_field('tab1');
                            $initial_tab1 = get_sub_field('initial');
                            $child_tab2 = get_sub_field('tab2');
                            $child_tab3 = get_sub_field('tab3');
                            $child_tab4 = get_sub_field('tab4');
                            $child_tab5 = get_sub_field('tab5');
                            $tooltip = get_sub_field('tooltip');
                            $show_tooltip = $tooltip['show_tooltip'];
                            $tooltip_description = $tooltip['tooltip_description'];
                            $has_tooltip = ($show_tooltip === 'yes' && !empty($tooltip_description));
                            $tooltip_modal_id = '';

                            if ($has_tooltip) {
                              $pricing_tooltip_modal_index++;
                              $tooltip_modal_id = 'pricing-tooltip-modal-' . $pricing_tooltip_modal_index;
                              $pricing_tooltip_modals[] = array(
                                'id'    => $tooltip_modal_id,
                                'title' => $child_tab1,
                                'body'  => $tooltip_description,
                              );
                            }
                            ?>
                            <tr>
                              <?php if ($child_tab1 !== false && !empty($child_tab1)) : ?>
                                <td>
                                  <span class="pricing-comparison__feature-label">
                                    <span class="pricing-comparison__feature-name"><?php echo esc_html($child_tab1); ?></span>
                                    <?php if ($has_tooltip) : ?>
                                      <button
                                        type="button"
                                        class="pricing-comparison__tooltip-trigger"
                                        data-testimonials-modal-open="<?php echo esc_attr($tooltip_modal_id); ?>"
                                        aria-haspopup="dialog"
                                        aria-label="<?php echo esc_attr(sprintf(__('More information about %s', 'groupapp'), $child_tab1)); ?>"
                                      >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                          <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" />
                                          <path d="M9.75 9.75a2.25 2.25 0 1 1 3.54 1.83c-.75.67-1.29 1.46-1.29 2.42" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                          <circle cx="12" cy="16.5" r="0.75" fill="currentColor" />
                                        </svg>
                                      </button>
                                    <?php endif; ?>
                                  </span>
                                </td>
                              <?php endif; ?>
                              <?php if ($initial_tab1 && $hideInitialColumn == 'no') : ?><td><span><?php echo ($initial_tab1); ?></span> </td><?php endif; ?>
                              <?php if ($child_tab2 && $child_tab2 !== false && !empty($child_tab2)) : ?><td><span><?php echo ($child_tab2); ?></span> </td><?php endif; ?>
                              <?php if ($child_tab3 !== false && !empty($child_tab3)) : ?><td><span><?php echo ($child_tab3); ?></span> </td><?php endif; ?>
                              <?php if ($child_tab4 !== false && !empty($child_tab4)) : ?><td><span><?php echo ($child_tab4); ?></span> </td><?php endif; ?>
                              <?php if ($child_tab5 !== false && !empty($child_tab5)) : ?><td><span><?php echo ($child_tab5); ?></span> </td><?php endif; ?>
                            </tr>
                          <?php endwhile; ?>

                        </table>
                      <?php endif; ?>
                    </div>


                <?php
                  endwhile;
                endif;
                ?>
                <?php
                if (have_rows('table_image_plan_content')):
                  while (have_rows('table_image_plan_content')) : the_row(); ?>
                    <?php
                    $parent_title = get_sub_field('title');
                    ?>
                    <div class="pricing-comparison__group">
                      <div class="d-flex justify-content-between align-content-center pricing-comparison__group-header">
                        <p class="pricing-comparison__group-title"><?php echo ($parent_title); ?></p>
                        <button type="button" class="pricing-comparison__group-toggle">
                          <span class="icon-toggle" aria-hidden="true">
                            <span></span>
                            <span></span>
                          </span>
                        </button>
                      </div>

                      <?php
                      if (have_rows('content_plan')): ?>
                        <table class="pricing-comparison__table pricing-comparison__table--features">

                          <?php
                          while (have_rows('content_plan')) : the_row();

                            // Get sub value.
                            $child_tab1 = get_sub_field('title');
                            $initial_tab1 = get_sub_field('initial_plan');
                            $child_tab2 = get_sub_field('image1');
                            $child_tab3 = get_sub_field('image2');
                            $child_tab4 = get_sub_field('image3');
                            $child_tab5 = get_sub_field('image4');
                          ?>
                            <tr>
                              <?php if ($child_tab1 && !empty($child_tab1)) : ?><td><?php echo ($child_tab1); ?></td><?php endif; ?>

                              <?php if ($hideInitialColumn == 'no') : ?><td><?php if ($initial_tab1 && !empty($initial_tab1)) : ?><img src="<?php echo ($initial_tab1); ?>" alt=""><?php else : ?>-<?php endif; ?></td><?php endif; ?>
                              <td><?php if ($child_tab2 && !empty($child_tab2)) : ?><img src="<?php echo ($child_tab2); ?>" alt=""><?php else : ?>-<?php endif; ?></td>
                              <td><?php if ($child_tab3 && !empty($child_tab3)) : ?><img src="<?php echo ($child_tab3); ?>" alt=""><?php else : ?>-<?php endif; ?></td>
                              <td><?php if ($child_tab4 && !empty($child_tab4)) : ?><img src="<?php echo ($child_tab4); ?>" alt=""><?php else : ?>-<?php endif; ?></td>
                            </tr>
                          <?php
                          endwhile;
                          ?>

                        </table>
                      <?php
                      endif;
                      ?>
                    </div>

                <?php
                  endwhile;
                endif;
                ?>

              </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php if (!empty($pricing_tooltip_modals)) : ?>
        <?php foreach ($pricing_tooltip_modals as $modal) : ?>
          <div
            class="testimonials-modal testimonials-modal--pricing-tooltip"
            id="<?php echo esc_attr($modal['id']); ?>"
            role="dialog"
            aria-modal="true"
            aria-labelledby="<?php echo esc_attr($modal['id']); ?>-title"
            aria-hidden="true"
          >
            <button type="button" class="testimonials-modal__backdrop" data-testimonials-modal-close aria-label="<?php esc_attr_e('Close dialog', 'groupapp'); ?>"></button>
            <div class="testimonials-modal__dialog">
              <button type="button" class="testimonials-modal__close" data-testimonials-modal-close aria-label="<?php esc_attr_e('Close', 'groupapp'); ?>">
                <span aria-hidden="true">&times;</span>
              </button>
              <?php if (!empty($modal['title'])) : ?>
                <h3 class="testimonials-modal__title" id="<?php echo esc_attr($modal['id']); ?>-title">
                  <?php echo esc_html($modal['title']); ?>
                </h3>
              <?php endif; ?>
              <div class="testimonials-modal__body">
                <?php echo wp_kses_post(wpautop($modal['body'])); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

<?php
    }


  endwhile;
endif;

?>







<?php

get_footer();
