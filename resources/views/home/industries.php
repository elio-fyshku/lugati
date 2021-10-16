<?php $industries = get_field('home_industries');
$services = get_field('industries_services'); ?>
<div class="home-industries">
    <div class="container">
        <div class="home-industries__wrap">
            <?php foreach ($industries as $i) : ?>
                <div class="home-industries__content">
                    <span class="home-industries__subtitle"><?php echo $i['subtitle']; ?></span>
                    <h1 class="home-industries__title"><?php echo $i['title']; ?></h1>
                    <div class="home-industries__description"><?php echo $i['description']; ?></div>
                </div>
            <?php endforeach; ?>

            <div class="home-industries__services">
                <div class="row">
                    <?php foreach ($services as $s) : ?>
                        <div class="col-12 col-md-4">
                            <div class="industries__wrap">
                                <div class="industries__image">
                                    <img src="<?php echo $s['image']; ?>" class="img-fluid" alt="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>">
                                </div>
                                <div class="industries__content">
                                    <h1 class="industries__title"><?php echo $s['title']; ?></h1>
                                    <div class="industries__description"><?php echo $s['description']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .industries__image img{
        height: 75px;
        width: 175px;
        object-fit: contain;
    }
</style>