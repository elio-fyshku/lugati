<?php /*Template name: Accounting Services */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="account-page">
        <div class="account-page__border">
            <div class="container-fluid">
                <?php $query = new WP_Query(['post_type' => 'services', 'posts_per_page' => -1,]);
                if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post();
                        $img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'full', false); ?>
                        <div class="account-page__wrap">
                            <div class="account-page__image">
                                <img src="<?php echo $img_src; ?>" class="img-fluid" alt="<?php echo the_title(); ?>">
                            </div>
                            <div class="account-page__content">
                                <h1 class="account-page__title"><?php echo the_title(); ?></h1>
                                <div class="account-page__description"><?php echo the_content(); ?></div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php $query = new WP_Query(['post_type' => 'team', 'posts_per_page' => 3,]);
        if ($query->have_posts()) :
        ?>
            <div class="home-team">
                <div class="container">
                    <div class="home-team__main">
                        <h1 class="home-team__main-title"><?php echo __('Meet our experts', 'taxsolutions'); ?></h1>
                    </div>
                    <div class="row">
                        <?php while ($query->have_posts()) : $query->the_post();
                            $img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'full', false); ?>
                            <div class="col-12 col-md-4">
                                <div class="home-team__wrap">
                                    <div class="home-team__image">
                                        <img src="<?php echo $img_src; ?>" class="img-fluid" alt="<?php echo the_title(); ?>">
                                    </div>
                                    <div class="home-team__content">
                                        <span class="home-team__subtitle"><?php echo get_field('team_subtitle'); ?></span>
                                        <h1 class="home-team__title"><?php echo the_title(); ?></h1>
                                        <div class="home-team__description"><?php echo wp_trim_words(get_the_content(), 30, '...'); ?></div>
                                        <a href="<?php echo the_permalink(); ?>" rel="<?php echo the_title(); ?>" class="btn btn-primary"><?php echo __('Read more', 'taxsolutions'); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>