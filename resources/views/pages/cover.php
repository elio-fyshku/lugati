<div class="page-cover">
    <div class="page-cover__image">
        <img src="<?php echo get_field('image_desktop', 'options'); ?>" class="d-none d-md-block img-fluid" alt="">
        <img src="<?php echo get_field('image_desktop', 'options'); ?>" class="d-block d-md-none img-fluid" alt="">
    </div>
    <div class="container">
        <h1 class="page-cover__title">
            <?php echo the_title(); ?>
        </h1>
    </div>
</div>