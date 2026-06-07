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

  <script src="<?php echo get_template_directory_uri() ; ?>/script/main5.js"></script>

  <script>
// Wait for jQuery to be loaded (from bundled main.js)
  (function() {
    function initFooterScripts() {
      // Check if jQuery is loaded
      if (typeof jQuery === 'undefined' || typeof $ === 'undefined') {
        // Retry after a short delay if jQuery not yet loaded
        setTimeout(initFooterScripts, 50);
        return;
      }
      
      var $ = jQuery;
      
      // Initialize slider and handle visibility
      $(document).ready(function() {
        const $slider = $('.slider.slick-not-init');
        
        if ($slider.length > 0) {
          try {
            $slider.on('init', function() {
              $(this).removeClass('slick-not-init').addClass('slick-initialized');
            }).slick({
              dots: true,
              infinite: true,
              slidesToShow: 1,
              slidesToScroll: 1,
              arrows: false,
              autoplay: true,
              autoplaySpeed: 4000,
              pauseOnFocus: false,
              pauseOnHover: false,
              fade: true,
              cssEase: 'ease-in-out',
              speed: 500
            });
          } catch (error) {
            console.warn('Slick slider initialization failed:', error);
            $slider.removeClass('slick-not-init').addClass('slick-fallback');
          }
          
          // Timeout fallback in case init event doesn't fire
          setTimeout(function() {
            if ($slider.hasClass('slick-not-init')) {
              $slider.removeClass('slick-not-init').addClass('slick-fallback');
            }
          }, 1000);
        }
      });

      // Header scroll behavior
      $(document).ready(function() {
        var lastScrollTop = 0;
        $(window).scroll(function() {
          var currentScrollTop = $(this).scrollTop();

          if (currentScrollTop > lastScrollTop){
            // Down scroll
            $('header').addClass('hide-header');
          } else {
            // Up scroll
            $('header').removeClass('hide-header');
          }

          // Check if the header is not at the top
          if (currentScrollTop > 100) {
            $('header').addClass('not-at-top');
          } else {
            $('header').removeClass('not-at-top');
          }

          lastScrollTop = currentScrollTop;
        });
      });
    }
    
    // Start initialization
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initFooterScripts);
    } else {
      initFooterScripts();
    }
  })();

  </script>



</body>
</html>
