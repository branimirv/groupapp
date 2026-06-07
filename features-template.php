<?php
/**
 * The template for displaying the features template
 *
 * @package GroupApp
 * Template Name: Features
 */

get_header(); ?>
<?php if (have_rows('features')) : ?>
    <?php while (have_rows('features')) : the_row(); ?>
        <?php if (get_row_layout() == 'hero') : ?>
            <section class="features-hero">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <div class="features-hero__text">
                            <?php if (get_sub_field('subtitle')) : ?>
                                <p class="features-hero__subtitle"><?php the_sub_field('subtitle'); ?></p>
                            <?php endif; ?>
                            <h1 class="features-hero__title">
                                <?php echo check_span_title(get_sub_field('title')); ?>
                            </h1>
                            <?php if (get_sub_field('description')) : ?>
                                <p class="features-hero__description"><?php the_sub_field('description'); ?></p>
                            <?php endif; ?>
                            <?php
                            $buttons = get_sub_field('buttons');
                            $button_start = is_array($buttons) ? ($buttons['start_for_free'] ?? null) : null;
                            $button_demo = is_array($buttons) ? ($buttons['book_a_demo'] ?? null) : null;
                            ?>
                            <?php if ($button_start || $button_demo) : ?>
                                <div class="btn__block">
                                    <?php if ($button_start) : ?>
                                        <a href="<?php echo esc_url($button_start['url']); ?>" class="btn btn--start" target="<?php echo esc_attr($button_start['target']); ?>"><?php echo esc_html($button_start['title']); ?></a>
                                    <?php endif; ?>
                                    <?php if ($button_demo) : ?>
                                        <a href="<?php echo esc_url($button_demo['url']); ?>" class="btn btn--demo" target="<?php echo esc_attr($button_demo['target']); ?>"><span><?php echo esc_html($button_demo['title']); ?></span></a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    $image = get_sub_field('image');
                    $image_mobile = get_sub_field('image_mobile');
                    ?>
                    <?php if ($image || $image_mobile) : ?>
                        <div class="features-hero__image">
                            <?php if ($image) : ?>
                                <img
                                    class="features-hero__image-img features-hero__image-img--desktop"
                                    src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                            <?php endif; ?>
                            <?php if ($image_mobile) :
                                $image_mobile_src = is_array($image_mobile) ? ($image_mobile['url'] ?? '') : $image_mobile;
                                $image_fallback_alt = is_array($image) ? ($image['alt'] ?? '') : '';
                                $image_mobile_alt = is_array($image_mobile) ? ($image_mobile['alt'] ?? $image_fallback_alt) : $image_fallback_alt;
                                ?>
                                <?php if ($image_mobile_src) : ?>
                                    <img
                                        class="features-hero__image-img features-hero__image-img--mobile"
                                        src="<?php echo esc_url($image_mobile_src); ?>"
                                        alt="<?php echo esc_attr($image_mobile_alt); ?>">
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'cards_3' ): ?>
            <section class="features-cards-3">
                <div class="container">
                    <p class="features-cards-3__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="features-cards-3__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
                    <p class="features-cards-3__description"><?php the_sub_field('description'); ?></p>
                    <ul class="features-cards-3__list">
                        <?php $cards = get_sub_field('cards'); ?>
                        <?php if($cards): ?>
                            <?php foreach($cards as $card): ?>
                                <li class="features-cards-3__card">
                                    <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['image']['alt']; ?>">
                                    <h3 class="features-cards-3__card-title"><?php echo $card['title']; ?></h3>
                                    <p class="features-cards-3__card-description"><?php echo $card['description']; ?></p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'cards_2' ): ?>
            <section class="features-cards-2">
                <div class="container">
                    <ul class="features-cards-2__list">
                        <?php $cards = get_sub_field('cards'); ?>
                        <?php if($cards): ?>
                            <?php foreach($cards as $card): ?>
                                <li class="features-cards-2__card">
                                    <img src="<?php echo $card['image']['url']; ?>" alt="<?php echo $card['image']['alt']; ?>">
                                    <h3 class="features-cards-2__card-title"><?php echo $card['title']; ?></h3>
                                    <p class="features-cards-2__card-description"><?php echo $card['description']; ?></p>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

        <?php elseif (get_row_layout() == 'reversed_split_content') : ?>
            <section class="features-reversed">
                <div class="container">
                    <?php if (have_rows('content')) : ?>
                        <?php while (have_rows('content')) : the_row(); ?>
                        <?php $image = get_sub_field('image'); ?>
                        <div class="features-reversed__wrapper">
                            <div class="features-reversed__intro">
                                <?php if (get_sub_field('subtitle')) : ?>
                                    <p class="features-reversed__subtitle"><?php the_sub_field('subtitle'); ?></p>
                                <?php endif; ?>
                                <?php if (get_sub_field('title')) : ?>
                                    <h3 class="features-reversed__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                                <?php endif; ?>
                                <?php if (get_sub_field('description')) : ?>
                                    <p class="features-reversed__description"><?php the_sub_field('description'); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($image) : ?>
                                <div class="features-reversed__image">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if (have_rows('list')) : ?>
                                <ul class="features-reversed__list">
                                    <?php while (have_rows('list')) : the_row(); ?>
                                        <li class="features-reversed__item">
                                            <?php $icon = get_sub_field('icon'); ?>
                                            <?php if ($icon) : ?>
                                                <span class="features-reversed__item-icon">
                                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                                </span>
                                            <?php endif; ?>
                                            <div>
                                                <?php if (get_sub_field('title')) : ?>
                                                    <h3 class="features-reversed__item-title"><?php the_sub_field('title'); ?></h3>
                                                <?php endif; ?>
                                                <?php if (get_sub_field('description')) : ?>
                                                    <p class="features-reversed__item-description"><?php the_sub_field('description'); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php elseif (get_row_layout() == 'certificate') : ?>
            <section class="features-certificate">
                <div class="container">
                    <p class="features-certificate__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="features-certificate__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                    <p class="features-certificate__description"><?php the_sub_field('description'); ?></p>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img class="features-certificate__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    <?php endif; ?>
                    <?php $list = get_sub_field('list'); ?>
                    <?php if ($list) : ?>
                        <ul class="features-certificate__list">
                            <?php foreach ($list as $item) : ?>
                                <li class="features-certificate__item">
                                    <h4 class="features-certificate__item-title"><?php echo $item['title']; ?></h4>
                                    <p class="features-certificate__item-description"><?php echo $item['description']; ?></p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </section>
        
        <?php elseif (get_row_layout() == 'bordered_grid') : ?>
            <section class="features-bordered-grid">
                <div class="container">
                    <p class="features-bordered-grid__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="features-bordered-grid__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                    <p class="features-bordered-grid__description"><?php the_sub_field('description'); ?></p>
                    <ul class="features-bordered-grid__list">
                        <?php $items = get_sub_field('items'); ?>
                        <?php if($items): ?>
                            <?php foreach($items as $item): ?>
                                <li class="features-bordered-grid__item">
                                    <img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
                                    <div class="features-bordered-grid__item-content">
                                        <h4 class="features-bordered-grid__item-title"><?php echo $item['title']; ?></h4>
                                        <p class="features-bordered-grid__item-description"><?php echo $item['description']; ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

        <?php elseif (get_row_layout() == 'faq'): ?>
            <?php
            get_template_part(
                'template-parts/faq-section',
                null,
                groupapp_get_faq_section_args(
                    get_sub_field( 'items' ),
                    get_sub_field( 'title' )
                )
            );
            ?>
        <?php endif; ?>
                                    

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
                        