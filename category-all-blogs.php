<?php

/**
 * The main template file
 * Template Name: all blogs
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

<section class="section-blog-categies-one">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="f-study">
          <?php
          $category_top = get_field('category_top');
          if ($category_top): ?>
            <div class="block-text">
              <p class="t-b"><?php echo $category_top['title']; ?></p>
              <p class="t-small"><?php echo $category_top['description']; ?></p>
            </div>
            <div class="block-img">
              <img src="<?php echo $category_top['image']; ?>" alt="">
            </div>

          <?php endif; ?>

        </div>

      </div>
    </div>
</section>


<section class="section-min mtst ">
  <div class="container">
    <div class="row blog_category_page">
      <?php
      $args = array(
        'paged' => (get_query_var('paged') ? get_query_var('paged') : 1),
        'post_type'   => 'post',
        'suppress_filters' => true,
        'category_name' => 'all-blog',



      );
      query_posts($args);
      while (have_posts()) {
        the_post();
      ?>
        <div class="col-lg-4 col-sm-6 col-12">
          <div class="block-tupical-min minimg">
            <a href="<?php the_permalink(); ?>">
              <div class='brd'>
                <?php the_post_thumbnail('post-min'); ?>
              </div>
            </a>
            <div class="cat">
              <?php the_category(); ?>
              </b><span>10 min read</div>
            <a href="<?php the_permalink(); ?>">
              <p class="title">
                <?php the_title(); ?>
              </p>
            </a>
            <p class="text"> <?php the_excerpt(); ?></p>
            <p class="ptr"><?php the_author(); ?> <span><?php the_date(); ?></span></p>
          </div>
        </div>
      <?php }    ?>
      <div class="col-12">
        <div class="pagination-block">
          <!-- <div class="load"><a href="">Load More Articles</a></div> -->
          <?php wp_pagenavi(); ?>
        </div>
      </div>
      <?php
      wp_reset_query();
      ?>
    </div>
  </div>
</section>

<?php

get_footer();
