<?php $query = new WP_Query(['post_type' => 'post', 'posts_per_page' => 3,]);
if ($query->have_posts()) :
?>
    <div class="home-blog">
        <div class="container">
            <div class="home-blog__main">
                <h1 class="home-blog__main-title"><?php echo __('Our Announcements', 'taxsolutions'); ?></h1>
                <div class="home-blog__main-subtitle"><?php echo __('Read our latest blog posts and get into the tax details immediately.', 'taxsolutions'); ?></div>
            </div>
            <div class="row">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="col-6 col-md-3">
                        <div class="blog__wrap">
                            <div class="blog__date">
                                <?php echo get_the_date('M Y');?>
                            </div>
                            <h1 class="blog__title">
                                <?php echo the_title(); ?>
                            </h1>
                            <div class="blog__description">
                                <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>      
                           </div>
                           <a href="<?php echo the_permalink(); ?>" class="blog__link" rel="<?php echo the_title(); ?>"><?php echo __('Read more', 'taxsolutions');?></a>
                        </div>
                    </div>
                <?php endwhile;  wp_reset_query(); ?>
            </div>
            <div class="home-blog__btn">
                <a href="#" class="btn btn-primary" rel="<?php echo __('Read our latest blog posts and get into the tax details immediately.', 'taxsolutions'); ?>"><?php echo __('Read all news', 'taxsolutions'); ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>