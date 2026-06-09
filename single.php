<?php

/**
 * The template for displaying all single posts
 * Template Name: singl blog
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GroupApp
 */

get_header();

/**
 * Slugify a chapter title for use as an HTML id.
 *
 * @param string $text
 * @param array  $used_slugs
 * @return string
 */
function ga_chapter_slug($text, $used_slugs = array())
{
  $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $text), '-'));
  if ($slug === '') {
    $slug = 'chapter';
  }
  $base = $slug;
  $i = 2;
  while (in_array($slug, $used_slugs, true)) {
    $slug = $base . '-' . $i;
    $i++;
  }
  return $slug;
}
?>
<section class="blog-single">
  <div class="container">
    <div class="row">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="col-12 blog-single__header">
            <p class="blog-single__meta">
              <span class="blog-single__meta-item blog-single__meta-item--author">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                  <path d="M7.99935 13.3332H13.9993M10.9167 2.41449C11.1821 2.1491 11.542 2 11.9173 2C12.2927 2 12.6526 2.1491 12.918 2.41449C13.1834 2.67988 13.3325 3.03983 13.3325 3.41516C13.3325 3.79048 13.1834 4.15043 12.918 4.41582L4.91133 12.4232C4.75273 12.5818 4.55668 12.6978 4.34133 12.7605L2.42667 13.3192C2.3693 13.3359 2.30849 13.3369 2.25061 13.3221C2.19272 13.3072 2.13988 13.2771 2.09763 13.2349C2.05538 13.1926 2.02526 13.1398 2.01043 13.0819C1.9956 13.024 1.9966 12.9632 2.01333 12.9058L2.572 10.9912C2.63481 10.776 2.75083 10.5802 2.90933 10.4218L10.9167 2.41449Z" stroke="#5B5C65" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <?php the_author(); ?>
              </span>
              <span class="blog-single__meta-item blog-single__meta-item--date">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                  <path d="M5.33333 1.3335V4.00016M10.6667 1.3335V4.00016M2 6.66683H14M3.33333 2.66683H12.6667C13.403 2.66683 14 3.26378 14 4.00016V13.3335C14 14.0699 13.403 14.6668 12.6667 14.6668H3.33333C2.59695 14.6668 2 14.0699 2 13.3335V4.00016C2 3.26378 2.59695 2.66683 3.33333 2.66683Z" stroke="#5B5C65" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <?php the_date(); ?>
              </span>
            </p>
          </div>

          <div class="col-12 blog-single__main">
            <h1 class="blog-single__title"><?php the_title(); ?></h1>

            <?php
            $ad_or_chapters = get_field('ad_or_chapters');
            $used_slugs = array();
            ?>

            <div class="blog-single__layout">
              <div class="blog-single__body">
                <?php the_content(); ?>
              </div>

              <?php if ($ad_or_chapters === 'chapters' && have_rows('chapter')) : ?>
                <div class="chapters-with-ad">
                  <?php
                  $ad_content = get_field('posts_ad', 'option');
                  if ($ad_content) : ?>
                    <div class="ad-with-chapter">
                      <?php echo do_shortcode($ad_content); ?>
                    </div>
                  <?php endif; ?>
                  <div class="chapters-toc desktop">
                    <?php while (have_rows('chapter')) : the_row(); ?>
                      <?php if (get_row_layout() === 'chapter_content') :
                        $section_title = get_sub_field('title');
                      ?>
                        <div class="chapters-toc__card">
                          <div class="chapters-toc__header">
                            <h3 class="chapters-toc__title">
                              <?php echo esc_html($section_title ? $section_title : 'Chapters'); ?>
                            </h3>
                            <button class="chapters-toc__toggle" type="button" aria-label="Toggle chapters">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"></polyline>
                              </svg>
                            </button>
                          </div>
                          <ol class="chapters-toc__list">
                            <?php
                            if (have_rows('chapters')) :
                              while (have_rows('chapters')) : the_row();
                                $chapter_title = get_sub_field('title');
                                $chapter_desc  = get_sub_field('description');
                                if (!$chapter_title) {
                                  continue;
                                }

                                $slug = ga_chapter_slug($chapter_title, $used_slugs);
                                $used_slugs[] = $slug;
                            ?>
                                <li class="chapters-toc__item">
                                  <a class="chapters-toc__link" href="#<?php echo esc_attr($slug); ?>" data-chapter-title="<?php echo esc_attr($chapter_title); ?>">
                                    <span class="chapters-toc__text">
                                      <?php echo esc_html($chapter_title); ?>
                                    </span>
                                  </a>
                                  <?php if ($chapter_desc) : ?>
                                    <div class="chapters-toc__desc">
                                      <?php echo esc_html($chapter_desc); ?>
                                    </div>
                                  <?php endif; ?>
                                </li>
                            <?php
                              endwhile;
                            endif;
                            ?>
                          </ol>
                        </div>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  </div>
                </div>
              <?php else : ?>
                <?php
                $ad_content = get_field('posts_ad', 'option');
                if ($ad_content) : ?>
                  <div class="post-ad desktop">
                    <?php echo do_shortcode($ad_content); ?>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
get_footer();
