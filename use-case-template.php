<?php
/**
 * Template Name: Use Case Template
 */

get_header(); ?>

<?php if (have_rows('use_case')): ?>
    <?php while (have_rows('use_case')): the_row(); ?>
        
        <?php if (get_row_layout() == 'hero'): ?>
            <section class="use-case__hero">
                <div class="container">
                    <div class="use-case__hero-wrapper">
                        <div class="use-case__hero-content">
                            <?php if (get_sub_field('subtitle')) : ?>
                                <p class="use-case__subtitle"><?php the_sub_field('subtitle'); ?></p>
                            <?php endif; ?>
                            <h3 class="use-case__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                            <div class="use-case__hero-details">
                                <?php if (get_sub_field('description')) : ?>
                                    <p class="use-case__description"><?php the_sub_field('description'); ?></p>
                                <?php endif; ?>
                                <?php
                                $buttons = get_sub_field('buttons');
                                $button_start = is_array($buttons) ? ($buttons['start_for_free'] ?? null) : null;
                                $button_demo = is_array($buttons) ? ($buttons['book_a_demo'] ?? null) : null;
                                ?>
                                <?php if ($button_start || $button_demo) : ?>
                                    <div class="btn__block">
                                        <?php if ($button_start) : ?>
                                            <a href="<?php echo esc_url($button_start['url']); ?>" class="btn btn--start" target="<?php echo esc_attr($button_start['target'] ?? '_self'); ?>" rel="noopener"><?php echo esc_html($button_start['title']); ?></a>
                                        <?php endif; ?>
                                        <?php if ($button_demo) : ?>
                                            <a href="<?php echo esc_url($button_demo['url']); ?>" class="btn btn--demo" target="<?php echo esc_attr($button_demo['target'] ?? '_self'); ?>" rel="noopener"><span><?php echo esc_html($button_demo['title']); ?></span></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="use-case__hero-image">
                            <?php $image = get_sub_field('image'); ?>
                            <?php if ($image) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        
        <?php elseif (get_row_layout() == 'use_case_tools'): ?>
            <section class="tools use-case__tools">
            <div class="container">
                <h2 class="use-case__tools__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
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
                <p class="use-case__tools__description--small"><?php the_sub_field('small_description'); ?></p>
            </div>
            </section>
        
        <?php elseif (get_row_layout() == 'reversed_split_content_with_title'): ?>
            <section class="features-reversed use-case__reversed">
                <div class="container">
                    <p class="use-case__reversed__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="use-case__reversed__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                    <p class="use-case__reversed__description"><?php the_sub_field('description'); ?></p>
                    <?php if (have_rows('content')) : ?>
                        <?php while (have_rows('content')) : the_row(); ?>
                        <div class="features-reversed__wrapper">
                            <div class="features-reversed__content">
                                <?php if (get_sub_field('subtitle')) : ?>
                                    <p class="features-reversed__subtitle"><?php the_sub_field('subtitle'); ?></p>
                                <?php endif; ?>
                                <?php if (get_sub_field('title')) : ?>
                                    <h3 class="features-reversed__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                                <?php endif; ?>
                                <?php if (get_sub_field('description')) : ?>
                                    <p class="features-reversed__description"><?php the_sub_field('description'); ?></p>
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
                            <div class="features-reversed__image">
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php elseif (get_row_layout() == 'clear_grid'): ?>
            <section class="use-case__clear-grid">
                <div class="container">
                    <p class="use-case__clear-grid__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h2 class="use-case__clear-grid__title"><?php echo check_span_title(get_sub_field('title')); ?></h2>
                    <p class="use-case__clear-grid__description"><?php the_sub_field('description'); ?></p>
                    <?php $grid = get_sub_field('grid'); ?>
                    <?php if ($grid) : ?>
                        <div class="use-case__clear-grid__grid">
                            <?php foreach ($grid as $item) : ?>
                                <div class="use-case__clear-grid__item">
                                    <img src="<?php echo esc_url($item['icon']['url']); ?>" alt="<?php echo esc_attr($item['icon']['alt']); ?>">
                                    <div class="use-case__clear-grid__item-content">
                                        <h3 class="use-case__clear-grid__item-title"><?php echo $item['title']; ?></h3>
                                        <p class="use-case__clear-grid__item-description"><?php echo $item['description']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php elseif (get_row_layout() == 'revenue'): ?>
            <section class="use-case__revenue">
                <div class="container">
                    <p class="use-case__revenue__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="use-case__revenue__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                    <p class="use-case__revenue__description"><?php the_sub_field('description'); ?></p>
                    <?php $revenue = get_sub_field('cards'); ?>
                    <?php if ($revenue) : ?>
                        <div class="use-case__revenue__grid">
                            <?php foreach ($revenue as $item) : ?>
                                <div class="use-case__revenue__item">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                                    <p class="use-case__revenue__item-subtitle"><?php echo $item['subtitle']; ?></p>
                                    <h3 class="use-case__revenue__item-price"><?php echo check_span_title($item['price']); ?></h3>
                                    <p class="use-case__revenue__item-description"><?php echo $item['description']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php $fullCard = get_sub_field('full_card'); ?>
                    <?php if ($fullCard) : ?>
                        <div class="use-case__revenue__full-card">
                            <img src="<?php echo esc_url($fullCard['image']['url']); ?>" alt="<?php echo esc_attr($fullCard['image']['alt']); ?>">
                            <?php 
                                $subtitle = $fullCard['subtitle'];
                                $subtitleLeft = $subtitle['left'];
                                $subtitleRight = $subtitle['right']; ?>
                                <div class="use-case__revenue__full-card-subtitle-wrapper">
                                <?php if ($subtitleLeft) : ?>
                                    <p class="use-case__revenue__full-card-subtitle"><?php echo $subtitleLeft; ?></p>
                                <?php endif; ?>
                                <?php if ($subtitleRight) : ?>
                                    <p class="use-case__revenue__full-card-subtitle"><?php echo $subtitleRight; ?></p>
                                <?php endif; ?>
                                </div>
                            <h3 class="use-case__revenue__full-card-title"><?php echo check_span_title($fullCard['title']); ?></h3>
                            <p class="use-case__revenue__full-card-description"><?php echo $fullCard['description']; ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php elseif (get_row_layout() == 'scale'): ?>
            <section class="use-case__scale">
                <div class="container">
                    <p class="use-case__scale__subtitle"><?php the_sub_field('subtitle'); ?></p>
                    <h3 class="use-case__scale__title"><?php echo check_span_title(get_sub_field('title')); ?></h3>
                    <p class="use-case__scale__description"><?php the_sub_field('description'); ?></p>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img class="use-case__scale__image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    <?php endif; ?>
                </div>
            </section>
        <?php elseif (get_row_layout() == 'metrics'): ?>
            <?php $greyBackground = get_sub_field('grey_background'); ?>
            <section class="use-case__metrics <?php if($greyBackground) echo 'use-case__metrics--grey-background'; ?>">
                <div class="container">
                    <?php $items = get_sub_field('items'); ?>
                    <?php if ($items) : ?>
                        <div class="use-case__metrics__grid">
                            <?php foreach ($items as $item) : ?>
                                <div class="use-case__metrics__item">
                                    <h1 class="use-case__metrics__item-metric"><?php echo $item['metric']; ?></h1>
                                    <p class="use-case__metrics__item-title"><?php echo $item['title']; ?></p>
                                    <p class="use-case__metrics__item-description"><?php echo $item['description']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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
