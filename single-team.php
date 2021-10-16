<?php get_header();
while(have_posts()) : the_post();  
$img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'full', false);
$contacts = get_field('contacts'); ?>
<div class="team-single">
    <div class="team-single__border">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="team-single__content">
                        <span class="team-single__subtitle"><?php echo get_field('team_subtitle');?></span>
                        <h1 class="team-single__title"><?php echo the_title(); ?></h1>
                        <div class="team-single__description">
                            <?php echo the_content(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="team-single__card">
                        <div class="team-single__image">
                            <img src="<?php echo $img_src; ?>" class="img-fluid" alt="<?php echo the_title(); ?>">
                        </div>
                        <?php if($contacts) : ?>
                            <div class="contact-card">
                                <?php foreach($contacts as $c) :?>
                                    <div class="contact-card__wrap">
                                        <a href="<?php echo $c['link']; ?>" class="contact-card__link">
                                            <?php svg($c['icon']); ?>
                                            <h1><?php echo $c['text']; ?></h1>
                                        </a>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endwhile; 
get_footer();?> 
