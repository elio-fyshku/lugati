<?php /*Template name: Team */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="team-page">
        <div class="team-page__border">
            <div class="team-page__content">
                <?php $query = new WP_Query(['post_type' => 'team', 'posts_per_page' => 3,]);
                if ($query->have_posts()) :
                ?>
                    <div class="home-team" style="background-color: #fff;">
                        <div class="container">
                            <div class="home-team__main">
                                <h1 class="home-team__main-title"><?php echo __('Our Team', 'taxsolutions'); ?></h1>
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

            <?php view('home.touch'); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>