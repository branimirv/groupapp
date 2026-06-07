<?php get_header(); ?>

<section class="single-integration__hero">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="integration-header">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('large');
                    } ?>
                    <h2><span>GroupApp</span> + <?php the_title(); ?></h2>
                    <div class="integration-header__description"><?php the_content(); ?></div>
                    <div class="single-integration__shortDescription">
                        <?php the_field('short_description'); ?>
                    </div>
                    <?php
                    $button_start = get_field('button_start_banner', 'option');
                    $button_connect = get_field('connect_button');
                    ?>
                    <div class="single-integration__buttons">
                        <?php if ($button_start) : ?>
                            <a href="<?php echo esc_url($button_start['url']); ?>" class="btn btn--start">
                                <?php echo esc_html($button_start['title']); ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($button_connect) : ?>
                            <a href="<?php echo esc_url($button_connect['url']); ?>" class="btn btn--connect">
                                <?php echo esc_html($button_connect['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
        <?php endwhile;
        endif; ?>
    </div>
</section>

<?php
$what_can_you_do = get_field('what_can_you_do');
if ($what_can_you_do) :
?>
    <section class="what-can-you-do">
        <div class="container">
            <h2 class="what-can-you-do__title"><?php echo $what_can_you_do['title']; ?></h2>
            <p class="what-can-you-do__description"><?php echo $what_can_you_do['description']; ?></p>
            <?php $list = $what_can_you_do['list']; ?>
            <?php if ($list) : ?>
                <ul class="what-can-you-do__list">
                    <?php foreach ($list as $item) : ?>
                        <li><?php echo esc_html($item['item']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <p class="what-can-you-do__quote">
                <?php echo $what_can_you_do['quote']; ?>
            </p>
        </div>
    </section>
<?php endif; ?>

<?php
$connect_to_ga = get_field('connect_to_groupapp');
if ($connect_to_ga) :
?>
    <section class="connect-to-ga">
        <div class="container">
            <h2 class="connect-to-ga__title"><?php echo $connect_to_ga['title']; ?></h2>
            <p class="connect-to-ga__description"><?php echo $connect_to_ga['description']; ?></p>
            <?php $steps = $connect_to_ga['list']; ?>
            <?php if ($steps) : ?>
                <ul class="connect-to-ga__steps">
                    <?php foreach ($steps as $step) : ?>
                        <li>
                            <?php echo $step['item']; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php
$monetize = get_field('monetizing');
if ($monetize) :
?>
    <section class="monetize">
        <div class="container">
            <h2 class="monetize__title"><?php echo $monetize['title']; ?></h2>
            <p class="monetize__description"><?php echo $monetize['description']; ?></p>
            <?php $button_monetize = $monetize['button']; ?>
            <?php if ($button_monetize) : ?>
                <div class="monetize__button">
                    <a href="<?php echo esc_url($button_monetize['url']); ?>" class="btn--withArrow" target="_blank" rel="noopener">
                        <?php echo esc_html($button_monetize['title']); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>


<?php
$faq = get_field( 'faq_integration_single' );

if ( ! empty( $faq['faq_list'] ) ) {
    get_template_part(
        'template-parts/faq-section',
        null,
        groupapp_get_faq_section_args(
            $faq['faq_list'],
            $faq['title'] ?? '',
            'question',
            'answer'
        )
    );
}
?>

<?php get_footer(); ?>
