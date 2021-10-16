<?php /*Template name: About us */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="about-page">
        <div class="about-page__border">
            <div class="container">
                <div class="about-page__content">
                    <span class="about-page__subtitle"><?php echo __('About Lalaj CPA Group', 'taxsolutions'); ?></span>
                    <div class="about-page__title"><?php echo get_field('about_title'); ?></div>
                    <div class="about-page__description">
                        <?php echo get_the_content(); ?>
                    </div>
                </div>
            </div>

            <?php 
            view('home.team');
            view('home.contact');
            view('home.touch'); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>