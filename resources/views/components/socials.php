<?php $socials = get_field('social_media', 'options'); ?>
<?php if($socials) : ?>
<div class="social-media">
    <?php foreach($socials as $social): ?>
        <a href="<?php echo $social['link']; ?>" class="social-media__link">
            <?php svg($social['icon']); ?>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>