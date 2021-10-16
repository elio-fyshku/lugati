<?php $clients = get_field('home_clients');

if ($clients) : ?>
    <div class="home-clients">
        <div class="container">
            <div class="glide-partners">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <?php foreach ($clients as $client) : ?>
                            <li class="glide__slide">
                                <a href="<?php echo $client['url'];  ?>" class="glide__slide-logo d-block mx-auto" target="_blank">
                                    <img src="<?php echo $client['image']; ?>" class="img-fluid d-block mx-auto">
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="glide__arrows d-none d-md-block" data-glide-el="controls">
                        <button class="glide__arrow prev" data-glide-dir="<"><?php svg('arrow-previous'); ?></button>
                        <button class="glide__arrow next" data-glide-dir=">"><?php svg('arrow-next'); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>