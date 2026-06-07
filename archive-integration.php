<?php
get_header();
?>

<section class="integrations__hero-section">
    <div class="container">
        <div class="integrations__hero-content">
            <div class="integrations__hero-contentText">
                <p class="integrations__hero-subtitle"><?php the_field('subtitle', 'option'); ?></p>
                <h2><?php echo check_span_title(get_field('title', 'option')); ?></h2>
                <p class="integrations__hero-description"><?php the_field('description', 'option'); ?></p>
            </div>
            <div class="integrations__hero-image">
                <?php
                $hero_image = get_field('image', 'option');
                if ($hero_image) {
                    echo wp_get_attachment_image($hero_image['id'], 'full');
                }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="integrations__content">
    <div class="container">
        <div class="integrations__content-wrapper">
            <div class="integrations-filter">
                <form id="integration-filter-form">
                    <div class="new-select__list">
                        <div class="new-select__item">
                            <input type="checkbox" id="filter-all" class="category-filter" value="all" checked>
                            <label for="filter-all">All Tools</label>
                        </div>
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'integration_category',
                            'hide_empty' => false,
                        ));
                        foreach ($terms as $term) {
                            echo '<div class="new-select__item">
                                <input type="checkbox" class="category-filter" value="' . esc_attr($term->slug) . '" id="filter-' . esc_attr($term->slug) . '">
                                <label for="filter-' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</label>
                            </div>';
                        }
                        ?>
                    </div>
                </form>
            </div>

            <section class="integrations-list" id="integrations-list">
                <?php
                $args = array(
                    'post_type' => 'integration',
                    'posts_per_page' => -1,
                    'post_status' => array('publish', 'draft'),
                );
                $integrations = new WP_Query($args);
                if ($integrations->have_posts()) :
                    while ($integrations->have_posts()) : $integrations->the_post();
                        $categories = get_the_terms(get_the_ID(), 'integration_category');
                        $cat_slugs = '';
                        if ($categories) {
                            foreach ($categories as $cat) {
                                $cat_slugs .= ' ' . esc_attr($cat->slug);
                            }
                        }
                ?>
                    <?php 
                        $status = get_post_status( get_the_ID());
                    ?>
                        <a href="<?php echo ($status == 'publish') ? the_permalink() : ''; ?>" class="integration-item<?php echo $cat_slugs; ?> <?php echo ($status == 'draft') ? 'draft' : ''; ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="integration-image">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <div class="integration-description"><?php the_excerpt(); ?></div>
                        </a>
                        
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </section>
        </div>
    </div>
</section>

<?php
get_template_part(
    'template-parts/faq-section',
    null,
    groupapp_get_faq_section_args(
        get_field( 'faq_integrations', 'option' ),
        get_field( 'faq_integrations_title', 'option' ),
        'question',
        'answer'
    )
);
?>

<?php get_footer(); ?>
