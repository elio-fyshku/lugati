<?php /*Template name: Tax Problems */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="team-page">
        <div class="team-page__border">
            <?php view('home.touch'); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>