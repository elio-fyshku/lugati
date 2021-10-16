<?php $contact = get_field('contacts', 'options'); ?>
<div class="home-industries home-touch" style="background-color: #f6f6f6;">
    <div class="container">
        <div class="home-industries__wrap">
            <div class="home-industries__content">
                <span class="home-industries__subtitle"><?php echo __('Our Offices', 'taxsolutions'); ?></span>
                <h1 class="home-industries__title"><?php echo __('Get in Touch', 'taxsolutions'); ?></h1>
                <div class="home-industries__description"><?php echo __('Come and visit our quarters or simply send us an email anytime you want. We are open to all suggestions from our faithful clients.', 'taxsolutions'); ?></div>
            </div>
            <div class="home-industries__services">
                <div class="row">
                    <?php foreach ($contact as $c) : ?>
                        <div class="col-12 col-md-4">
                            <div class="industries__wrap">
                                <div class="industries__image">
                                    <img src="<?php echo $c['icon']; ?>" class="img-fluid" alt="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>">
                                </div>
                                <div class="industries__content">
                                    <h1 class="industries__title"><?php echo $c['title']; ?></h1>
                                    <div class="industries__description"><?php echo $c['content']; ?></div>
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
    .home-touch .industries__image img{
        height: 50px;
        width: 65px;
        object-fit: contain;
    }
</style>