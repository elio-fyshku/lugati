<?php view('components.top-header'); ?>
<header class="desktop-header">
    <div class="container">
        <div class="desktop-header__wrap">
            <div class="desktop-header__logo">
                <a href="<?php echo home_url(); ?>" rel="<?php echo __('Lugati ', 'Lugati'); ?>">
                Lugati
                </a>
            </div>
            <div class="desktop-header__menu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'depth' => 1,
                    'container' => 'div',
                    'container_id' => 'primary-menu',
                    'menu_class' => 'desktop-header__menu-nav',
                    'fallback_cb' => 'App\Theme\NavWalker::fallback',
                    'walker' => new App\Theme\NavWalker(),
                ));
                ?>
            </div>
        </div>
    </div>
</header>
<header class="mobile-header">
    <div class="container">
        <div class="desktop-header__wrap">
            <div class="desktop-header__logo">
                <a href="<?php echo home_url(); ?>" rel="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>">
                    <?php svg('logo'); ?>
                </a>
            </div>
            <div class="desktop-header__mini-cart">
                <span class="js-menu__open" data-menu="#main-nav">
                    <?php svg('menu'); ?>
                </span>
            </div>
        </div>
    </div>
    <div class="js-menu__context">
        <div id="main-nav" class="js-menu js-menu--right">
            <div class="js-menu__wrap">
                <div class="desktop-header__logo">
                    <a href="<?php echo home_url(); ?>" rel="<?php echo __('Lalaj CPA Group', 'taxsolutions'); ?>">
                        <?php svg('logo'); ?>
                    </a>
                </div>
                <span class="js-menu__close">✕</span>
            </div>
            <div class="widget_shopping_cart_content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'depth' => 1,
                    'container' => 'div',
                    'container_id' => 'primary-menu',
                    'menu_class' => 'mobile-header__menu-nav',
                    'fallback_cb' => 'App\Theme\NavWalker::fallback',
                    'walker' => new App\Theme\NavWalker(),
                ));
                ?> </div>
        </div>
    </div>
</header>
