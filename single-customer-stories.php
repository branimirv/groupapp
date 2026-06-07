<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GroupApp
 */

get_header();
?>
<?php if (have_posts()) {
    while (have_posts()) {
        the_post(); ?>
        <section class="section-sudy">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <div class="f-study">
                            <div class="block-text">
                                <p class="t-b"><?php the_title(); ?></p>
                            </div>
                            <div class="block-img">
                                <?php the_post_thumbnail('post-thumb'); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section-page-tup cust ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="pos">

                            <?php the_content(); ?>
                        </div>
                    </div>

                </div>
            </div>

        </section>
<? }
} ?>

<?php $image = get_field('background_image', 'option'); ?>
<section class="banner--start">
    <div class="container">
        <div class="banner--start__wrapper" style="background-image: url('<?php echo esc_url(get_field('background_image_start', 'option')['url']); ?>');">
            <div class="banner--start__content">
                <h2><?php the_field('start_title', 'option'); ?></h2>
                <?php $vector_start = get_field('description_vector', 'option'); ?>
                <div class="banner--start__text">
                    <span><img src="<?php echo $vector_start['url']; ?>" alt=""></span>
                    <p><?php the_field('description_text', 'option'); ?></p>
                </div>
                <?php
                $button_start_banner = get_field('button_start_banner', 'option');
                $button_demo_banner = get_field('button_demo_banner', 'option');
                ?>
                <div class="button--start__btns">
                    <a href="<?php echo esc_url($button_start_banner['url']); ?>" class="btn btn--start" target="_blank" rel="noopener">
                        <?php echo esc_html($button_start_banner['title']); ?>
                    </a>
                    <a href="<?php echo esc_url($button_demo_banner['url']); ?>" class="btn btn--demo" target="_blank" rel="noopener">
                        <?php echo esc_html($button_demo_banner['title']); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>




<?php

get_footer();
