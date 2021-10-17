<?php 
$music_image = get_field('music_image');
$music_title = get_field('music_title');
$music_link = get_field('music_link');



?>
<div class="music-section">
    <div style="background-image:url(<?php echo $music_image; ?>)" class="music-section__bg"></div>
    <div class="container">
        <div class="music-section__wrap">
            <h1 class="music-section__title"><?php echo $music_title; ?></h1>
            <a href="<?php echo $music_link; ?>" class="music-section__btn"><?php echo __('listen album', 'lugati'); ?></a>
        </div>
    </div>
</div>
