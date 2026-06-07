<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package GroupApp
 */

get_header();
?>

<section class="section-404">
	<div class="container">
		<div class="section-404__content">
			<p class="section-404__code">
				<span class="section-404__digit">4</span>
				<span class="section-404__icon" aria-hidden="true">
					<svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
						<circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="3"/>
						<path d="M24 24L40 40M40 24L24 40" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
					</svg>
				</span>
				<span class="section-404__digit">4</span>
			</p>
			<h1 class="section-404__title">
				<?php esc_html_e( 'Oops, this page', 'groupapp' ); ?>
				<span><?php esc_html_e( 'does not exist', 'groupapp' ); ?></span>
			</h1>
			<p class="section-404__description">
				<?php esc_html_e( 'We couldn\'t find the page you were looking for.', 'groupapp' ); ?>
			</p>
			<div class="section-404__actions btn__block">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--start">
					<?php esc_html_e( 'Back to homepage', 'groupapp' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
