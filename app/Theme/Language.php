<?php
namespace App\Theme;

use App\Base\Singleton;

class Language extends Singleton
{
    public $dir = 'languages';

    protected function __construct()
    {
        add_action('wp_head', [$this, 'load_strings']);
    }

    public function load_strings() {
        $data = $this->get_file('strings');
        $data = apply_filters(app_prefix() . '_translations', $data);
        ?>
        <script type="text/javascript" id="<?php echo app_prefix(); ?>-translations">
            window.TRANSLATIONS = <?php echo wp_json_encode($data); ?>;
        </script>
        <?php
    }

    public function get_file($filename) {
        $data = require get_template_directory() . DIRECTORY_SEPARATOR . $this->dir . DIRECTORY_SEPARATOR . $filename . '.php';

        return $data ?? [];
    }
}
