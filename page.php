<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package taxsolutions_Theme
 */

get_header();
while(have_posts()) : the_post(); ?>

<div class="container">
    <h1><?php echo the_title(); ?></h1>
    <div>
        <?php echo the_content(); ?>
    </div>
</div>
    
<?php endwhile; 
get_footer();?> 
