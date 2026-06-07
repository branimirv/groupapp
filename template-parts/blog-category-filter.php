<?php
/**
 * Blog category filter pills (shared by blogs.php and category-blog.php).
 *
 * @package GroupApp
 */

$blogs_page_id       = groupapp_get_blogs_page_id();
$prepend_all_posts   = ! empty( $args['prepend_all_posts'] );
$all_posts_is_active = $prepend_all_posts && (int) get_queried_object_id() === $blogs_page_id;

if ( ! $blogs_page_id || ! have_rows( 'flexi-category', $blogs_page_id ) ) {
	return;
}
?>

<section class="section-category-filter">
  <div class="container">
    <div class="row">
      <div class="col d-flex justify-content-between align-content-center">
        <div class="select-pl">
          <div class="select">
            <div class="new-select__list">
              <?php
              if ( $prepend_all_posts ) :
                $all_posts_classes = 'new-select__item';

                if ( $all_posts_is_active ) {
                  $all_posts_classes .= ' new-select__item--active';
                }
                ?>
                <div class="<?php echo esc_attr( $all_posts_classes ); ?>" data-value="">
                  <a href="<?php echo esc_url( get_permalink( $blogs_page_id ) ); ?>">
                    <?php esc_html_e( 'All Posts', 'groupapp' ); ?>
                  </a>
                </div>
                <?php
              endif;

              while ( have_rows( 'flexi-category', $blogs_page_id ) ) :
                the_row();

                if ( get_row_layout() !== 'category-filter' ) {
                  continue;
                }

                $link            = get_sub_field( 'link_category' );
                $name            = get_sub_field( 'category_name' );
                $link_url        = groupapp_get_blog_category_filter_url( $link );
                $is_active       = groupapp_is_blog_category_filter_active( $link );
                $item_classes    = 'new-select__item';

                if ( $is_active ) {
                  $item_classes .= ' new-select__item--active';
                }
                ?>
                <div class="<?php echo esc_attr( $item_classes ); ?>" data-value="">
                  <a href="<?php echo esc_url( $link_url ); ?>">
                    <?php echo esc_html( $name ); ?>
                  </a>
                </div>
                <?php
              endwhile;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
