<?php
/**
 * FAQ accordion section (shared across pricing, integrations, etc.).
 *
 * @package GroupApp
 *
 * @var string $title Section heading.
 * @var array  $items List of [ 'question' => string, 'answer' => string ].
 */

$title = isset( $args['title'] ) ? (string) $args['title'] : '';
$items = isset( $args['items'] ) && is_array( $args['items'] ) ? $args['items'] : array();

if ( empty( $items ) ) {
	return;
}

if ( '' === $title ) {
	$title = __( 'FAQs', 'groupapp' );
}
?>

<section class="section-faq">
	<div class="container">
		<div class="section-faq__layout">
			<h2 class="section-faq__title"><?php echo esc_html( $title ); ?></h2>
			<div class="faq" data-faq-accordion>
				<?php foreach ( $items as $index => $item ) : ?>
					<?php
					$is_first = 0 === $index;
					$item_class = 'faq__item';

					if ( $is_first ) {
						$item_class .= ' is-open';
					}
					?>
					<div class="<?php echo esc_attr( $item_class ); ?>">
						<button
							type="button"
							class="faq__trigger"
							aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
						>
							<span class="faq__question"><?php echo esc_html( $item['question'] ); ?></span>
							<span class="faq__icon" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<polyline points="9 18 15 12 9 6"></polyline>
								</svg>
							</span>
						</button>
						<div class="faq__answer">
							<div class="faq__answer-inner">
								<?php echo wp_kses_post( wpautop( $item['answer'] ) ); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
