<?php
namespace App\Theme;

use App\Base\Singleton;


class Brand extends Singleton
{
    public function __construct()
    {
        add_filter('login_headerurl', [$this, 'wp_change_login_page_url']);
        add_filter('login_headertext', [$this, 'wp_change_login_page_title']);
        add_action('login_enqueue_scripts', [$this, 'login_page']);
        add_filter('show_admin_bar', '__return_false');
        add_filter('show_recent_comments_widget_style', '__return_false');
        $this->header_cleanup();
    }

    public function header_cleanup()
    {
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
    }

    public function wp_change_login_page_url($login_header_url)
    {
        return get_bloginfo('url');
    }

    public function wp_change_login_page_title($login_header_title)
    {
        return get_bloginfo('title');
    }

    public function login_page()
    { 
        $primary = config('app.login_colors.primary', '#5f6d86');
        $accent = config('app.login_colors.accent', '#d31b56');
        ?>
		<style type="text/css">

            body.login {}
            body.login div#login {
                position: relative;
            }
            body.login div#login h1 {}
            body.login div#login h1 a {
                width: 240px;
                height: 64px;
                background-position: center bottom;
                background-size: contain;
				background-image: url("<?php echo logo_url(); ?>");
            }
            body.login div#login form#loginform {
                margin: 0;
                box-shadow: 0px 4px 16px 0 rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 24px;
                padding-bottom: 56px;
            }
            body.login div#login form#loginform p {}
            body.login div#login form#loginform p label {}
            body.login div#login form#loginform input {}
            body.login div#login form#loginform input#user_login,
            body.login div#login form#loginform input#user_pass,
            body.login div#login form#loginform p.forgetmenot input#rememberme {
                padding-left: .75rem;
                padding-right: .75rem;
                padding-top: .5rem;
                padding-bottom: .5rem;
                box-shadow: 0 2px 4px 0 rgba(0,0,0,.1);
                color: #606f7b;
                border-width: 1px;
                border-radius: .25rem;
                border: 1px solid #dae1e7;
                font-size: 18px;
            }
            body.login div#login form#loginform p.forgetmenot input#rememberme:checked:before {
                color: <?php echo $primary; ?>;
            }
            body.login div#login form#loginform p.forgetmenot {
                float: none;
                margin-bottom: 16px;
            }
            body.login div#login form#loginform p.submit {}
            body.login div#login form#loginform p.submit input#wp-submit {
                float: none;
                text-shadow: none;
                vertical-align: initial;
                line-height: 1;
                height: auto;
                margin: 0;
                box-shadow: none;
                border: none;
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: .75rem;
                padding-bottom: .75rem;
                width: 100%;
                font-weight: 700;
                background-color: <?php echo $primary; ?>;
                transition: all .2s;
            }
            body.login div#login form#loginform p.submit input#wp-submit:hover {
                background-color: <?php echo $accent; ?>;
            }
            body.login div#login p#nav {
                position: absolute;
                bottom: 0;
                margin: 0;
                padding: 16px 24px;
            }
            body.login div#login p#nav a {}
            body.login div#login p#backtoblog {
                position: absolute;
                top: 100%;
                margin: 0;
                padding: 16px 0px;
            }
            body.login div#login p#backtoblog a {}
		</style>
	<?php
    }
}