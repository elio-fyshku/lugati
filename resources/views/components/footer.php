<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="main-footer__logo">
                    <?php echo svg('logo'); ?>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="main-footer__menu">
                    <div class="main-footer__title">
                        <?php echo __('Menu', 'taxsolutions');?>
                    </div>
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'depth' => 1,
                            'container' => 'div',
                            'container_id' => 'footer-menu',
                            'menu_class' => 'main-footer__menu-nav',
                            'fallback_cb' => 'App\Theme\NavWalker::fallback',
                            'walker' => new App\Theme\NavWalker(),
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="main-footer__socials">
                    <div class="main-footer__title">
                        <?php echo __('Find us', 'taxsolutions');?>
                    </div>
                    <div class="main-footer__description">
                        <?php echo __('Come and visit our quarters or simply drop as a line anytime you want.', 'taxsolutions');?>
                    </div>
                    <?php view('components.socials'); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

</footer>