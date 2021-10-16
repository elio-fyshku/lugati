<?php /*Template name: Contact */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="contact-page">
        <div class="contact-page__border">
            <div class="container">
                <div class="contact-page__content">
                    <div class="contact-page__form">
                        <span class="contact-page__form-subtitle"><?php echo __('Focus on what’s Imporant', 'taxsolutions'); ?></span>
                        <h1 class="contact-page__form-title"><?php echo __('Let’s talk about improving your tax submissions', 'taxsolutions'); ?></h1>
                        <?php echo do_shortcode("[vfb id='1']"); ?>
                    </div>
                </div>
            </div>
            <?php view('home.touch'); ?>
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer(); ?>