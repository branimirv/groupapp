<?php

/**
 * The main template file
 * Template Name: category blog
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
<section class="blog-category-intro">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
        $category_top = get_field('category_top');
        if ($category_top) : ?>
          <div class="blog-category-intro__inner">
            <div class="blog-category-intro__content">
              <?php if (!empty($category_top['title'])) : ?>
                <h1 class="blog-category-intro__title"><?php echo esc_html($category_top['title']); ?></h1>
              <?php endif; ?>
              <?php if (!empty($category_top['description'])) : ?>
                <p class="blog-category-intro__description"><?php echo esc_html($category_top['description']); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/blog', 'category-filter' ); ?>

<?php
$paged = max(1, (int) get_query_var('paged'));
global $post;
$category_slug = get_queried_object()->slug;
$category_blog_query = new WP_Query(array(
  'paged' => $paged,
  'post_type' => 'post',
  'suppress_filters' => true,
  'posts_per_page' => 6,
  'category_name' => $category_slug,
));
?>

<section class="blog-list blog-list--category">
  <div class="container">
    <div class="row blog-list__grid">
      <?php while ($category_blog_query->have_posts()) : $category_blog_query->the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $categories = get_the_category();
        $primary_category = ($categories && ! is_wp_error($categories)) ? $categories[0] : null;
        $category_link = $primary_category ? get_category_link($primary_category->term_id) : '';
        $has_category_page = $primary_category && url_to_postid($category_link) !== 0;
        $cta_label = ($primary_category && stripos($primary_category->slug, 'customer') !== false) ? 'Read story' : 'Read more';
        ?>
        <div class="col-lg-6 col-12">
          <article class="blog-card">
            <a href="<?php the_permalink(); ?>" class="blog-card__media-link">
              <?php the_post_thumbnail('post-min', ['class' => 'blog-card__image']); ?>
            </a>

            <div class="blog-card__meta">
              <?php if ($primary_category) : ?>
                <span class="blog-card__meta-item blog-card__meta-item--category">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3.33117 4.16663H12.9395C13.4312 4.16663 13.8978 4.38329 14.2228 4.76663L18.1395 9.46663C18.3978 9.77496 18.3978 10.225 18.1395 10.5333L14.2228 15.2333C13.9062 15.6166 13.4395 15.8333 12.9395 15.8333H3.33117C2.4145 15.8333 1.6645 15.0833 1.6645 14.1666V5.83329C1.6645 4.91663 2.4145 4.16663 3.33117 4.16663Z" fill="#365DE6"/>
                  </svg>
                  <?php if ($has_category_page) : ?>
                    <a class="blog-card__meta-label" href="<?php echo esc_url($category_link); ?>"><?php echo esc_html($primary_category->name); ?></a>
                  <?php else : ?>
                    <span class="blog-card__meta-label"><?php echo esc_html($primary_category->name); ?></span>
                  <?php endif; ?>
                </span>
              <?php endif; ?>

              <span class="blog-card__meta-item blog-card__meta-item--reading-time">
                <svg class="blog-card__meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <g clip-path="url(#clip0_blog_card_reading_time_<?php echo (int) $post_id; ?>)">
                    <path d="M7.9987 4.00016V8.00016L10.6654 6.66683M14.6654 8.00016C14.6654 11.6821 11.6806 14.6668 7.9987 14.6668C4.3168 14.6668 1.33203 11.6821 1.33203 8.00016C1.33203 4.31826 4.3168 1.3335 7.9987 1.3335C11.6806 1.3335 14.6654 4.31826 14.6654 8.00016Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                  </g>
                  <defs>
                    <clipPath id="clip0_blog_card_reading_time_<?php echo (int) $post_id; ?>">
                      <rect width="16" height="16" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
                <span class="blog-card__meta-label"><?php echo do_shortcode('[rt_reading_time]'); ?> min read</span>
              </span>
            </div>

            <h3 class="blog-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>

            <div class="blog-card__excerpt">
              <?php the_excerpt(); ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="blog-card__cta btn btn--withArrow">
              <span class="txt"><?php echo esc_html($cta_label); ?></span>
              <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4.99951 12H18.9995" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M11.9995 5L18.9995 12L11.9995 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </a>
          </article>
        </div>
      <?php endwhile; ?>
    </div>

    <?php if ($category_blog_query->max_num_pages > 1) : ?>
      <nav class="blog-list__pagination" aria-label="<?php esc_attr_e('Category blog pagination', 'groupapp'); ?>">
        <?php wp_pagenavi(array('query' => $category_blog_query)); ?>
      </nav>

      <?php if ($paged === $category_blog_query->max_num_pages - 2 && $category_blog_query->max_num_pages > 5) : ?>
        <script>
          document.querySelector('.blog-list__pagination .wp-pagenavi')?.classList.add('del-last-span');
        </script>
      <?php endif; ?>

      <?php if ($paged === 3 && $category_blog_query->max_num_pages > 5) : ?>
        <script>
          document.querySelector('.blog-list__pagination .wp-pagenavi')?.classList.add('del-first-span');
        </script>
      <?php endif; ?>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php

get_footer();
