<?php /*Template name: Tax Solutions */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="solutions-page">
        <div class="solutions-page__border">
            <div class="container">
                <div class="solutions-page__content">
                    <?php echo the_content(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>