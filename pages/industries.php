<?php /*Template name: Industries */ ?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <?php view('pages.cover'); ?>
    <div class="industries-page">
        <div class="industries-page__border">
            <div class="container">
                <div class="industries-page__content">
                    <?php echo the_content(); ?>
                </div>
                <?php
                $query = new WP_Query([
                    'post_type' => 'industries',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order'   => 'ASC',
                ]);
                if ($query->have_posts()) :
                ?>
                    <?php while ($query->have_posts()) : $query->the_post();  $img_src = wp_get_attachment_url(get_post_thumbnail_id(), 'full', false);?>
                        <div class="industries-page__card">
                            <button class="industries-page__card-button">
                                <h1 class="industries-page__card-title">
                                    <?php echo the_title(); ?>
                                </h1>
                                <?php svg('open-faq', [
                                    'class' => 'open-faq'
                                ]);
                                ?>
                            </button>
                            <div class="industries-page__card-content">
                                <img src="<?php echo $img_src; ?>" class="img-fluid">
                                <?php echo the_content();  ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
<style>
    .industries-page__card-content img{
        display: block;
        margin: 0 auto;
        height: 350px;
    }
</style>
<?php get_footer(); ?>