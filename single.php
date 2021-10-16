<?php get_header();
while (have_posts()) : the_post();
    $img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'full', false); ?>
    <div class="team-single">
        <img src="<?php echo $img_src; ?>" class="img-fluid" alt="<?php echo the_title();?>">
        <div class="team-single__border">
            <div class="container">
                <div class="team-single__content">
                    <span class="team-single__subtitle"><?php echo get_field('team_subtitle'); ?></span>
                    <h1 class="team-single__title"><?php echo the_title(); ?></h1>
                    <div class="team-single__description">
                        <?php echo the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile;
get_footer(); ?>