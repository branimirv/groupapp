<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GroupApp
 */

?>

<?php $cta = get_field('cta', 'option'); ?>
<?php if ($cta) : ?>
  <section class="cta">
    <div class="container">
      <div class="cta__wrapper">
        <h3 class="cta__title"><?php echo check_span_title($cta['title']); ?></h3>
        <?php 
          $buttons = $cta['buttons'];
          $startButton = $buttons['start_for_free'];
          $demoButton = $buttons['book_a_demo'];
        ?>
        <?php if ($buttons) : ?>
        <div class="cta__buttons">
          <a href="<?php echo $startButton['url']; ?>" class="btn btn--start" target="<?php echo $startButton['target'] ?? '_self'; ?>" rel="noopener">
            <?php echo $startButton['title']; ?>
          </a>
          <?php if ($demoButton) : ?>
            <a href="<?php echo $demoButton['url']; ?>" class="btn btn--demo" target="<?php echo $demoButton['target'] ?? '_self'; ?>" rel="noopener">
              <span>
                <?php echo $demoButton['title']; ?>
              </span>
            </a>
          <?php endif; ?>
        </div>
        <?php endif; ?>
        <p class="cta__quote"><?php echo $cta['quote']; ?></p>
      </div>
    </div>
  </section>
<?php endif; ?>

<footer>
  <div class="footer footer--top">
    <div class="container">
        <div class="footer--top__wrapper">
          <div class="footer--top__info">
            <?php the_custom_logo(); ?>
            <?php if ( is_active_sidebar( 'Footer 1' ) ) : ?>
              <p class="footer--top__description">
                <?php echo get_bloginfo('description'); ?>
              </p>
              <div class="footer--top__store">
                <?php dynamic_sidebar( 'Footer 1' ); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="footer--top__menus" data-footer-accordion>
            <?php groupapp_render_footer_menu_links( 'platform' ); ?>
            <?php groupapp_render_footer_sidebar_accordion( 'Footer 2', 'quick-links' ); ?>
            <?php groupapp_render_footer_menu_links( 'solutions' ); ?>
          </div>
        </div>
      </div>
  </div>
  <div class="footer footer--bottom">
    <div class="container">
      <div class="footer--bottom__wrapper">
        <p class="privacy">© <?php echo date("Y"); ?> GroupApp. All rights reserved.</p>
        <div class="footer--bottom__privacy-links">
            <?php dynamic_sidebar( 'Footer 5' ); ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
