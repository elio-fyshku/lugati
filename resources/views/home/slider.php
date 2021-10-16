<?php
$query = new WP_Query([
    'post_type' => 'slider',
    'posts_per_page' => -1,
]);
if ($query->have_posts()) :
?>
    <section class="home-slider">
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <?php while ($query->have_posts()) : $query->the_post();
                        $img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'medium', false);
                        $img_mobile = get_field('mobile_image');
                        $link = get_field('slider_link');
                    ?>
                        <li class="glide__slide">
                            <div class="glide__slide-background">
                                <div class="glide__slide-content">
                                    <a href="<?php echo $link; ?>" rel="<?php echo __('Lalaj CPA Group', 'taxsolutions');?>">
                                        <img src="<?php echo $img_src; ?>" class="img-fluid w-100 d-none d-md-block" alt="<?php echo __('Drinon Itegrated Products', 'drinon'); ?>">
                                        <img src="<?php echo $img_mobile; ?>" class="img-fluid w-100 d-block d-md-none" alt="<?php echo __('Drinon Itegrated Products', 'drinon'); ?>">
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <?php while( $query->have_posts() ) : $query->the_post(); ?>
                        <button class="glide__bullet" data-glide-dir="=<?php echo $query->current_post; ?>">
                        </button>
                    <?php endwhile; ?>
                </div>    
            </div>
        </div>
    </section>
<?php endif;
wp_reset_query() ?>