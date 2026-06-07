<?php 
/* 
Template Name: Offer Template 
*/ 
?>
<head>
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php $header_footer = get_field('offer_header_&_footer'); ?>
<?php if($header_footer): ?>
        <header class="offer--header">
            <div class="container">
                <div class="offer--header__wrapper">
                    <div class="offer--header__logo">
                        <a href="<?php echo home_url(); ?>">
                            <?php the_custom_logo(); ?>
                        </a>
                    </div>
                    <?php $button = $header_footer['button']; ?>
                    <?php if($button): ?>
                    <a class="btn btn--claimOffer" href="<?php echo $button['url']; ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 8L14 12L10 16M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Claim Offer</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </header>    
<?php endif; ?>

<?php if( have_rows('offer_content') ): ?>
    <?php while( have_rows('offer_content') ): the_row(); ?>

        <?php if( get_row_layout() == 'hero' ): ?>
            <section class="offer--hero">
                <div class="offer--hero__description">
                    <h1><?php the_sub_field('title'); ?></h1>
                    <p class="offer--hero__description--big"><?php the_sub_field('big_description'); ?></p>
                    <?php $button = get_sub_field('button'); ?>
                    <?php if($button): ?>
                    <a class="btn btn--claimOffer" href="<?php echo $button['url']; ?>">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 8L14 12L10 16M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span><?php echo $button['title']; ?></span>
                    </a>
                    <?php endif; ?>
                    <div class="offer--hero__description--small">
                        <?php echo check_span_title(get_sub_field('small_description')); ?>
                    </div>
                    <div class="offer--hero__video">
                        <?php $video = the_sub_field('video'); ?>
                    </div>
                </div>
            </section>
         
        <?php elseif( get_row_layout() == 'countdown' ): ?>
            <section class="offer--countdown">
                <h4 class="offer--countdown__title"><?php the_sub_field('title'); ?></h4>
                <div><?php the_sub_field('timer'); ?></div>
            </section>
        <?php elseif( get_row_layout() == 'groupapp_overview' ): ?>
            <?php $categories = get_sub_field('categories'); ?>
            <section class="offer--overview">
                <div class="container">
                    <h2><?php the_sub_field('title'); ?></h2>
                    
                    <!-- Navigation Slider (Tabs/Titles) -->
                    <div class="offer--overview__nav slider-nav">
                        <?php foreach ($categories as $category) : ?>
                            <div class="offer--overview__nav-item">
                                <?php echo $category['title']; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Main Images Slider -->
                    <div class="offer--overview__images slider-for">
                        <?php foreach ($categories as $category) : ?>
                            <div class="offer--overview__image-item">
                                <?php $image = $category['image']; ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php elseif( get_row_layout() == 'groupapp_help' ): ?>
            <section class="offer-help">
                <div class="container">
                    <div class="offer-help__content">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <div class="offer-help__content__description">
                            <?php the_sub_field('description'); ?>
                        </div>
                    </div>
                    <div class="offer-help__wrapper">
                        <div class="offer-help__textAndImage">
                            <?php $textAndImage = get_sub_field('text_and_image'); ?>
                            <div class="offer-help__textAndImage__wrapper">
                                <?php if($textAndImage): ?>
                                    <div class="offer-help__textAndImage__text">
                                        <?php echo $textAndImage['text']; ?>
                                    </div>
                                    <div class="offer-help__textAndImage__image">
                                        <img src="<?php echo $textAndImage['image']['url']; ?>" alt="<?php echo $textAndImage['image']['alt']; ?>">
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="offer-help__list-wrapper">
                            <?php $helpItems = get_sub_field('help_repeater'); ?>
                            <ul class="offer-help__list">
                                <?php foreach ($helpItems as $item): ?>
                                    <li class="offer-help__list-item">
                                        <?php $icon = $item['icon']; ?>
                                        <span class="offer-help__list-item__icon"><img src="<?php echo $icon['url']; ?>" alt=""></span>
                                        <div>
                                            <h3><?php echo $item['title'] ?></h3>
                                            <p class="offer-help__list-item__description"><?php echo $item['description'] ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'pricing' ): ?>
            <section class="offer--pricing">
                <div class="container">
                    <div class="offer--pricing__header">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <p><?php the_sub_field('description'); ?></p>
                    </div>
                    <ul class="offer--pricing__list">
                        <?php $pricingItems = get_sub_field('pricing_repeater'); ?>
                        <?php foreach ($pricingItems as $itemPricing): ?>
                            <?php $recommended = $itemPricing['recommended']; ?> 
                            <li class="offer--pricing__list-itemPricing <?php echo ($recommended === 'yes') ? 'recommended' : ''; ?>">
                                <?php if($recommended === 'yes'): ?>
                                    <div class="recommended-badge">
                                        <div class="recommended-badge__wrapper">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.0013 1.66675L12.5763 6.88341L18.3346 7.72508L14.168 11.7834L15.1513 17.5167L10.0013 14.8084L4.8513 17.5167L5.83464 11.7834L1.66797 7.72508L7.4263 6.88341L10.0013 1.66675Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span><?php echo $itemPricing['recommended_title']; ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                               <div class="offer--pricing__list-itemPricing__content">
                                    <div class="offer--pricing__list-itemPricing__content__wrapper">
                                        <h3><?php echo $itemPricing['title']; ?></h3>
                                        <p class="offer--pricing__list-itemPricing__description">
                                            <?php echo $itemPricing['description']; ?>
                                        </p>
                                        <?php $price = $itemPricing['price']; ?>
                                        <div class="price">
                                            <p class="price__old">
                                                <?php echo $price['old_price']; ?>
                                            </p>
                                            <div class="price__new">
                                                <span class="price__new__price"><?php echo $price['new_price']; ?></span>
                                                <span><?php echo $price['month_text']; ?></span>
                                            </div>
                                            <span class="price__yearly"><?php echo $price['yearly_text']; ?></span>
                                        </div>
                                        <?php $info = $itemPricing['info_repeater']; ?>
                                        <ul class="ul-stats">
                                            <?php foreach ($info as $itemInfo): ?>
                                                <li>
                                                    <img src="<?php echo $itemInfo['icon']['url']; ?>" alt="<?php echo $itemInfo['icon']['alt']; ?>">
                                                    <?php echo check_span_title($itemInfo['description']); ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p class="includes__title"><?php echo $itemPricing['include_title']; ?></p>
                                        <?php $includes = $itemPricing['include_repeater']; ?>
                                        <ul class="ul-includes">
                                            <?php foreach ($includes as $itemInclude): ?>
                                                <li class="ul-includes__item"><?php echo $itemInclude['title']; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>     
                                    <?php $button = $itemPricing['button']; ?>
                                    <?php if($button): ?>
                                        <a class="btn" href="<?php echo $button['url']; ?>">
                                            <?php echo $button['title']; ?>
                                        </a>
                                    <?php endif; ?>
                                </div>    
                            </li>    
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        <?php elseif( get_row_layout() == 'separator' ): ?>
            <section class="offer--separator">
                <?php $separator = get_sub_field('clean_banner'); 
                 $separator_mobile = get_sub_field('clean_banner_mobile');
                ?>
                <?php if($separator): ?>
                    <img src="<?php echo $separator['url']; ?>" alt="<?php echo $separator['alt']; ?>" class="desktop-image">
                <?php endif; ?>
                <?php if($separator_mobile): ?>
                    <img src="<?php echo $separator_mobile['url']; ?>" alt="<?php echo $separator_mobile['alt']; ?>" class="mobile-image">
                <?php endif; ?>
            </section>

        <?php elseif( get_row_layout() == 'launch' ): ?>
            <section class="offer--launch">
                <div class="container">
                    <h2 class="offer--launch__title"><?php the_sub_field('title'); ?></h2>
                    <p class="offer--launch__description"><?php the_sub_field('description'); ?></p>
                    <?php $steps = get_sub_field('steps_repeater'); ?>
                    <ul class="offer--launch__list">
                        <?php foreach ($steps as $step): ?>
                            <li class="offer--launch__list-item">
                                <h3><?php echo $step['title']; ?></h3>
                                <p><?php echo $step['description']; ?></p>
                                <img src="<?php echo $step['image']['url']; ?>" alt="<?php echo $step['image']['alt']; ?>">
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'results' ): ?>
            <section class="offer--results">
                <div class="container">
                    <div class="offer--results__header">
                        <h2><?php the_sub_field('title'); ?></h2>
                        <p><?php the_sub_field('description'); ?></p>
                    </div>
                    <div class="offer--results__wrapper">
                        <div class="offer--results__content">
                            <?php $results = get_sub_field('description_repeater'); ?>
                            <ul class="offer--results__list">
                                <?php foreach ($results as $result): ?>
                                    <li class="offer--results__list-item">
                                        <p><?php echo $result['text']; ?></p>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="offer--results__image">
                            <img src="<?php echo get_sub_field('image')['url']; ?>" alt="<?php echo get_sub_field('image')['alt']; ?>">
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'customers' ): ?>
            <section class="offer--customers">
                <div class="container">
                    <div class="offer--customers__header">    
                        <h2><?php the_sub_field('title'); ?></h2>
                        <p><?php the_sub_field('description'); ?></p>
                    </div>
                    <?php $customers = get_sub_field('customers_repeater'); ?>
                    <ul class="offer--customers__list">
                        <?php foreach ($customers as $customer): ?>
                            <li class="offer--customers__list-item">
                                <div class="offer--customers__list-item__wrapper">
                                    <div class="offer--customers__list-item__image">
                                        <img src="<?php echo $customer['icon']['url']; ?>" alt="<?php echo $customer['icon']['alt']; ?>">
                                    </div>
                                    <div class="offer--customers__list-item__content">
                                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0013 10C9.11725 10 8.2694 
                                            10.3512 7.64428 10.9763C7.01916 11.6014 6.66797 12.4493 6.66797 13.3333V18.3333C6.66797 19.2174 7.01916 20.0652 7.64428 20.6904C8.2694 21.3155 9.11725 21.6667 10.0013 21.6667H15.0013C15.0013 22.9927 14.4745 24.2645 13.5368 25.2022C12.5992 26.1399 11.3274 26.6667 10.0013 26.6667H8.33464C7.89261 26.6667 7.46869 26.8423 7.15612 27.1548C6.84356 27.4674 6.66797 27.8913 6.66797 28.3333C6.66797 28.7754 6.84356 29.1993 7.15612 29.5118C7.46869 29.8244 7.89261 30 8.33464 30H10.0013C12.2114 30 14.3311 29.122 15.8939 27.5592C17.4567 25.9964 18.3346 23.8768 18.3346 21.6667V13.3333C18.3346 12.4493 17.9834 11.6014 17.3583 10.9763C16.7332 10.3512 15.8854 10 15.0013 10H10.0013ZM25.0013 10C24.1172 10 23.2694 10.3512 22.6443 10.9763C22.0192 11.6014 21.668 12.4493 21.668 13.3333V18.3333C21.668 19.2174 22.0192 20.0652 22.6443 20.6904C23.2694 21.3155 24.1172 21.6667 25.0013 21.6667H30.0013C30.0013 22.9927 29.4745 24.2645 28.5368 25.2022C27.5992 26.1399 26.3274 26.6667 25.0013 26.6667H23.3346C22.8926 26.6667 22.4687 26.8423 22.1561 27.1548C21.8436 27.4674 21.668 27.8913 21.668 28.3333C21.668 28.7754 21.8436 29.1993 22.1561 29.5118C22.4687 29.8244 22.8926 30 23.3346 30H25.0013C27.2114 30 29.3311 29.122 30.8939 27.5592C32.4567 25.9964 33.3346 23.8768 33.3346 21.6667V13.3333C33.3346 12.4493 32.9834 11.6014 32.3583 10.9763C31.7332 10.3512 30.8854 10 30.0013 10H25.0013Z" fill="#202125"/>
                                        </svg>
                                        <p class="offer--customers__list-item__content__description"><?php echo $customer['description']; ?></p>
                                        <?php $author = $customer['author']; ?>
                                        <div class="offer--customers__list-item__content__author">
                                            <p><?php echo $author['name']; ?></p>
                                            <p><?php echo $author['position']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'built_in' ): ?>
            <section class="offer--built-in">
                <div class="container">
                    <h2><?php the_sub_field('title'); ?></h2>
                    <p class="offer--built-in__description"><?php the_sub_field('description'); ?></p>
                    <?php $builtIn = get_sub_field('built_in_repeater'); ?>
                    <ul class="offer--built-in__list">
                        <?php foreach ($builtIn as $item): ?>
                            <li class="offer--built-in__list-item">
                                <span class="offer--built-in__list-item__icon">
                                    <img src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>">
                                </span>
                                <p class="offer--built-in__list-item__title"><?php echo $item['title']; ?></p>
                                <p class="offer--built-in__list-item__description"><?php echo $item['description']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'discount' ): ?>
            <section class="offer--discount">
                <div class="container">
                    <h2><?php the_sub_field('title'); ?></h2>
                    <p class="offer--discount__big_description"><?php the_sub_field('big_description'); ?></p>
                    <?php $button = get_sub_field('button'); ?>
                    <?php if($button): ?>
                        <a class="btn btn--claimOffer" href="<?php echo $button['url']; ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 8L14 12L10 16M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span><?php echo $button['title']; ?></span>
                        </a>
                    <?php endif; ?>
                    <div class="offer--discount__small_description">
                        <p><?php echo check_span_title(get_sub_field('small_description')); ?></p>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'faq' ): ?>
            <section class="offer--faq">
                <div class="container">
                    <div class="offer--faq__wrapper">
                        <div class="offer--faq__content">
                            <h2><?php the_sub_field('title'); ?></h2>
                            <p><?php the_sub_field('description'); ?></p>
                        </div>
                        <div class="offer--faq__list-wrapper">
                            <?php $faq = get_sub_field('faq_repeater'); ?>
                            <ul class="offer--faq__list">
                                <?php foreach ($faq as $index => $item): ?>
                                    <li class="offer--faq__list-item <?php echo $index === 0 ? 'is-open' : ''; ?>">
                                        <div class="offer--faq__list-item__question">
                                            <p><?php echo $item['question']; ?></p>
                                            <span class="offer--faq__list-item__icon"><?php echo $index === 0 ? '−' : '+'; ?></span>
                                        </div>
                                        <div class="offer--faq__list-item__answer">
                                            <p><?php echo $item['answer']; ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php $footer = get_field('offer_header_&_footer'); ?>
<?php if($footer): ?>
<footer class="offer--footer">
    <div class="container">
        <div class="offer--footer__wrapper">
            <div class="offer--footer__logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo-white-letters.png" alt="GroupApp">
                </a>
            </div>
            <?php $terms_and_privacy_links = $footer['terms_and_privacy_links']; ?>
            <div class="offer--footer__links">
                <?php foreach($terms_and_privacy_links as $link): ?>  
                <a href="<?php echo $link['link']['url']; ?>" target="<?php echo $link['link']['target']; ?>"><?php echo $link['link']['title']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>
<?php wp_footer(  ); ?>
