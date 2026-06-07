<?php 
    /* Template Name: Products */
?>
<?php get_header(); ?>
    <?php $hero = get_field('hero'); ?>

    <?php if($hero) : ?>
    <section class="products section-home">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 col-sm-6 col-12">
                    <div class="block-txt">
                        <h1 class="big-t text-center"><?php echo $hero['title']; ?></h1>
                        <p class="t-st mb-st text-center">
                            <?php echo $hero['description']; ?>
                        </p>
                        <div class="block-btn">
                            <?php $btn = $hero['link']; ?>
                            <a class="button d-block"  href="<?php echo $btn['url']; ?>" target="<?php echo $btn['target']; ?>">
                                <button class="btn-st">
                                    <?php echo $btn['title'];?>
                                </button>
                            </a>
                            <p class="t-small text-center">
                                <?php echo $hero['link_description'];?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="section-home__image">
                    <img src="<?php echo $hero['image']['url']; ?>" alt="<?php echo $hero['image']['alt']; ?>">
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php 
        $features = get_field('features');
        if($features) : ?>
            <section class="products__content">
                <div class="container">
                    <?php $featuresRepeater = $features['features_repeater']; ?>
                    <?php if($featuresRepeater): ?>
                    <div class="row">
                        <?php foreach($featuresRepeater as $feature) : ?>
                        <div class="feature">
                            <div class="feature__content col">
                                <?php $icon = $feature['icon']; ?>
                                <?php if($icon): ?>
                                <img src="<?php echo $icon['url']; ?>" alt="" class="feature__icon">
                                <?php endif; ?>
                                <h3 class="feature__title"><?php echo $feature['title']; ?></h3>
                                <p class="feature__description"><?php echo $feature['description']; ?></p>
                            </div>
                            <div class="feature__image col">
                                <?php $image = $feature['image']; ?>
                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php $createFreeAcc = get_field('create_free_account'); ?>
        <?php if($createFreeAcc) : ?>
            <?php $image = $createFreeAcc['background_image']; ?>
        <section class="section-create-txt"  style="background-image: linear-gradient(90deg, rgba(0, 19, 42, 0.75) 1.42%, rgba(0, 20, 44, 0) 99.27%), url('<?php echo $image['url']; ?>');">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="block-txt-g-c">
                            <p class="t-b">
                                <?php echo $createFreeAcc['title'];?>
                            </p>
                            <p class="t-st">
                                <?php echo $createFreeAcc['description'];?>
                            </p>
                            <div class="block-center block-left">
                            <?php $btn = $createFreeAcc['link']; ?>
                                <a class="button" href="<?php echo $btn['url']; ?>">
                                    <button class="btn-st"><?php echo $btn['title']; ?></button>
                                </a>
                            </div>
                            <p class="t-st font">
                                <?php echo $createFreeAcc['link_description'];?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

<?php get_footer(); ?>
