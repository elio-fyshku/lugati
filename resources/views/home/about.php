<?php $about = get_field('home_about');
$services = get_field('home_services'); ?>
<div class="home-about">
    <div class="container">
        <div class="home-about__wrap">
            <?php foreach ($about as $a) : ?>
                <div class="home-about__content">
                    <span class="home-about__subtitle"><?php echo $a['subtitle']; ?></span>
                    <h1 class="home-about__title"><?php echo $a['title']; ?></h1>
                    <div class="home-about__description"><?php echo $a['description']; ?></div>
                    <a class="btn btn-primary" href="<?php echo $a['link']; ?>" rel="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>"><?php echo __('Our tax services', 'taxsolution'); ?></a>
                </div>
            <?php endforeach; ?>

            <div class="home-about__services">
                <?php foreach ($services as $s) : ?>
                    <div class="home-services__content">
                        <div class="home-services__image">
                            <img src="<?php echo $s['image']; ?>" class="img-fluid" alt="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>">
                        </div>
                        <h1 class="home-services__title"><?php echo $s['title']; ?></h1>
                        <div class="home-services__description"><?php echo $s['description']; ?></div>
                        <a class="home-services__link" href="<?php echo $s['link']; ?>" rel="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>"><?php echo __('Read more', 'taxsolution'); ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>