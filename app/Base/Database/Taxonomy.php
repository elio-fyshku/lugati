<?php

namespace App\Base\Database;

/**
 * $args - (string) (optional) A plural descriptive name for the taxonomy marked for translation.
 * Arguments
 * 
 * labels -(array) (optional) labels - An array of labels for this taxonomy. By default tag labels are used for non-hierarchical types and category labels for hierarchical ones.
 *      - Default: if empty, name is set to label value, and singular_name is set to name value
 *      - √ 'name' - general name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default is _x( 'Post Tags', 'taxonomy general name' ) or _x( 'Categories', 'taxonomy general name' ). When internationalizing this string, please use a gettext context matching your post type. Example: _x('Writers', 'taxonomy general name');
 *      - √ 'singular_name' - name for one object of this taxonomy. Default is _x( 'Post Tag', 'taxonomy singular name' ) or _x( 'Category', 'taxonomy singular name' ). When internationalizing this string, please use a gettext context matching your post type. Example: _x('Writer', 'taxonomy singular name');
 *      - √ 'menu_name' - the menu name text. This string is the name to give menu items. If not set, defaults to value of name label.
 *      - √ 'all_items' - the all items text. Default is __( 'All Tags' ) or __( 'All Categories' )
 *      - √ 'edit_item' - the edit item text. Default is __( 'Edit Tag' ) or __( 'Edit Category' )
 *      - √ 'view_item' - the view item text, Default is __( 'View Tag' ) or __( 'View Category' )
 *      - √ 'update_item' - the update item text. Default is __( 'Update Tag' ) or __( 'Update Category' )
 *      - √ 'add_new_item' - the add new item text. Default is __( 'Add New Tag' ) or __( 'Add New Category' )
 *      - √ 'new_item_name' - the new item name text. Default is __( 'New Tag Name' ) or __( 'New Category Name' )
 *      - √ 'parent_item' - the parent item text. This string is not used on non-hierarchical taxonomies such as post tags. Default is null or __( 'Parent Category' )
 *      - √ 'parent_item_colon' - The same as parent_item, but with colon : in the end null, __( 'Parent Category:' )
 *      - √ 'search_items' - the search items text. Default is __( 'Search Tags' ) or __( 'Search Categories' )
 *      - √ 'popular_items' - the popular items text. This string is not used on hierarchical taxonomies. Default is __( 'Popular Tags' ) or null
 *      - √ 'separate_items_with_commas' - the separate item with commas text used in the taxonomy meta box. This string is not used on hierarchical taxonomies. Default is __( 'Separate tags with commas' ), or null
 *      - √ 'add_or_remove_items' - the add or remove items text and used in the meta box when JavaScript is disabled. This string is not used on hierarchical taxonomies. Default is __( 'Add or remove tags' ) or null
 *      - √ 'choose_from_most_used' - the choose from most used text used in the taxonomy meta box. This string is not used on hierarchical taxonomies. Default is __( 'Choose from the most used tags' ) or null
 *      - √ 'not_found' (3.6+) - the text displayed via clicking 'Choose from the most used tags' in the taxonomy meta box when no tags are available and (4.2+) - the text used in the terms list table when there are no items for a taxonomy. Default is __( 'No tags found.' ) or __( 'No categories found.' )
 * √ public - (boolean) (optional) Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users. The default settings of `$publicly_queryable`, `$show_ui`, and `$show_in_nav_menus` are inherited from `$public`.
 * publicly_queryable - (boolean) (optional) Whether the taxonomy is publicly queryable.

 * √ show_ui - (boolean) (optional) Whether to generate a default UI for managing this taxonomy.
 *      - Default: if not set, defaults to value of public argument. As of 3.5, setting this to false for attachment taxonomies will hide the UI.
 * show_in_menu - (boolean) (optional) Where to show the taxonomy in the admin menu. show_ui must be true.
 *      - Default: value of show_ui argument
 *      - 'false' - do not display in the admin menu
 *      - 'true' - show as a submenu of associated object types
 * √ show_in_nav_menus - (boolean) (optional) true makes this taxonomy available for selection in navigation menus.
 *      - Default: if not set, defaults to value of public argument
 * show_in_rest - (boolean) (optional) Whether to include the taxonomy in the REST API.
 *      - Default: false
 * rest_base - (string) (optional) To change the base url of REST API route.
 *      - Default: $taxonomy
 * rest_controller_class - (string) (optional) REST API Controller class name.
 *      - Default: WP_REST_Terms_Controller
 * √ show_tagcloud - (boolean) (optional) Whether to allow the Tag Cloud widget to use this taxonomy.
 *      - Default: if not set, defaults to value of show_ui argument
 * show_in_quick_edit - (boolean) (optional) Whether to show the taxonomy in the quick/bulk edit panel. (Available since 4.2)
 *      - Default: if not set, defaults to value of show_ui argument
 * meta_box_cb - (callback) (optional) Provide a callback function name for the meta box display. (Available since 3.8)
 *      - Default: null
 *      - Note: Defaults to the categories meta box (post_categories_meta_box() in meta-boxes.php) for hierarchical taxonomies and the tags meta box (post_tags_meta_box()) for non-hierarchical taxonomies. No meta box is shown if set to false.
 * √ show_admin_column - (boolean) (optional) Whether to allow automatic creation of taxonomy columns on associated post-types table. (Available since 3.5)
 *      - Default: false
 * description - (string) (optional) Include a description of the taxonomy.
 *      - Default: ""
 * √ hierarchical - (boolean) (optional) Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
 *      - Default: false
 *      - Note: Hierarchical taxonomies will have a list with checkboxes to select an existing category in the taxonomy admin box on the post edit page (like default post categories). Non-hierarchical taxonomies will just have an empty text field to type-in taxonomy terms to associate with the post (like default post tags).

 * update_count_callback - (string) (optional) A function name that will be called when the count of an associated $object_type, such as post, is updated. Works much like a hook.
 *      - Default: None - but see Note, below.
 *      - Note: While the default is '', when actually performing the count update in wp_update_term_count_now(), if the taxonomy is only attached to post types (as opposed to other WordPress objects, like user), the built-in _update_post_term_count() function will be used to count only published posts associated with that term, otherwise _update_generic_term_count() will be used instead, that does no such checking.
 *        This is significant in the case of attachments. Because an attachment is a type of post, the default _update_post_term_count() will be used. However, this may be undesirable, because this will only count attachments that are actually attached to another post (like when you insert an image into a post). This means that attachments that you simply upload to WordPress using the Media Library, but do not actually attach to another post will not be counted. If your intention behind associating a taxonomy with attachments was to leverage the Media Library as a sort of Document Management solution, you are probably more interested in the counts of unattached Media items, than in those attached to posts. In this case, you should force the use of _update_generic_term_count() by setting '_update_generic_term_count' as the value for update_count_callback.
 *        Another important consideration is that _update_post_term_count() only counts published posts. If you are using custom statuses, or using custom post types where being published is not necessarily a consideration for being counted in the term count, then you will need to provide your own callback that doesn't include the post_status portion of the where clause.

 * query_var - (boolean or string) (optional) False to disable the query_var, set as string to use custom query_var instead of default which is $taxonomy, the taxonomy's "name". True is not seen as a valid entry and will result in 404 issues.
 *      - Default: $taxonomy
 *      - Note: The query_var is used for direct queries through WP_Query like new WP_Query(array('people'=>$person_name)) and URL queries like /?people=$person_name. Setting query_var to false will disable these methods, but you can still fetch posts with an explicit WP_Query taxonomy query like WP_Query(array('taxonomy'=>'people', 'term'=>$person_name)).

 * rewrite - (boolean/array) (optional) Set to false to prevent automatic URL rewriting a.k.a. "pretty permalinks". Pass an $args array to override default URL settings for permalinks as outlined below:
 *      - Default: true
 *      - 'slug' - Used as pretty permalink text (i.e. /tag/) - defaults to $taxonomy (taxonomy's name slug)
 *      - 'with_front' - allowing permalinks to be prepended with front base - defaults to true
 *      - 'hierarchical' - true or false allow hierarchical urls (implemented in Version 3.1) - defaults to false
 *      - 'ep_mask' - (Required for pretty permalinks) Assign an endpoint mask for this taxonomy - defaults to EP_NONE. If you do not specify the EP_MASK, pretty permalinks will not work. For more info see this Make WordPress Plugins summary of endpoints.
 *      - Note: You may need to flush the rewrite rules after changing this. You can do it manually by going to the Permalink Settings page and re-saving the rules -- you don't need to change them -- or by calling $wp_rewrite->flush_rules(). You should only flush the rules once after the taxonomy has been created, not every time the plugin/theme loads.

 * capabilities - (array) (optional) An array of the capabilities for this taxonomy.
 *      - Default: None
 *      - 'manage_terms' - 'manage_categories'
 *      - 'edit_terms' - 'manage_categories'
 *      - 'delete_terms' - 'manage_categories'
 *      - 'assign_terms' - 'edit_posts'
 * sort - (boolean) (optional) Whether this taxonomy should remember the order in which terms are added to objects.
 *      - Default: None
 * _builtin - (boolean) (not for general use) Whether this taxonomy is a native or "built-in" taxonomy. Note: this Codex entry is for documentation - core developers recommend you don't use this when registering your own taxonomy
 *      - Default: false
 */
class Taxonomy
{
    public $name;
    /**
     * @var array
     */
    protected $labels;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array|string (required) Name of the object type for the taxonomy object. Object-types can be built-in Post Type or any Custom Post Type that may be registered.
     */
    protected $object_type;
    


    public function __construct()
    {
        $this->labels = [
            // 'name'                       => __('Name', 'yourtextdomain'),
            // 'singular_name'              => __('Name', 'yourtextdomain'),
            // 'menu_name'                  => __('Name', 'yourtextdomain'),
            'all_items'                  => __('All items', 'yourtextdomain'),
            'parent_item'                => __('Parent item', 'yourtextdomain'),
            'parent_item_colon'          => __('Parent item:', 'yourtextdomain'),
            'new_item_name'              => __('New item', 'yourtextdomain'),
            'add_new_item'               => __('Add New item', 'yourtextdomain'),
            'edit_item'                  => __('Edit item', 'yourtextdomain'),
            'update_item'                => __('Update item', 'yourtextdomain'),
            'view_item'                  => __('View item', 'yourtextdomain'),
            'separate_items_with_commas' => __('Separate items with commas', 'yourtextdomain'),
            'add_or_remove_items'        => __('Add or remove items', 'yourtextdomain'),
            'choose_from_most_used'      => __('Choose from the most used', 'yourtextdomain'),
            'popular_items'              => __('Popular items', 'yourtextdomain'),
            'search_items'               => __('Search item', 'yourtextdomain'),
            'not_found'                  => __('Not Found', 'yourtextdomain'),
        ];

        $this->options = [
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        ];
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function slug($slug)
    {
        $this->name = $slug;
        return $this;
    }

    /**
     * @param array|string $object_type
     * @return $this
     */
    public function set_object_type($object_type) {
        $this->object_type = $object_type;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name($name) {
        $this->labels['name'] = $this->translate($name);
        if (!isset($this->labels['singular_name']) || !$this->labels['singular_name']) {
            $this->labels['singular_name'] = $this->translate($name);
        }

        if (!isset($this->labels['menu_name']) || !$this->labels['menu_name']) {
            $this->labels['menu_name'] = $this->translate($name);
        }
        return $this;
    }

    /**
     * @param string $singular_name
     * @return $this
     */
    public function singular_name($singular_name) {
        $this->labels['singular_name'] = $this->translate($singular_name);
        return $this;
    }

    /**
     * @param string $menu_name
     * @return $this
     */
    public function menu_name($menu_name) {
        $this->labels['menu_name'] = $this->translate($menu_name);
        return $this;
    }

    /**
     * @param string $all_items
     * @return $this
     */
    public function all_items($all_items) {
        $this->labels['all_items'] = $this->translate($all_items);
        return $this;
    }

    /**
     * @param string $parent_item
     * @return $this
     */
    public function parent_item($parent_item) {
        $this->labels['parent_item'] = $this->translate($parent_item);
        return $this;
    }

    /**
     * @param string $parent_item_colon
     * @return $this
     */
    public function parent_item_colon($parent_item_colon) {
        $this->labels['parent_item_colon'] = $this->translate($parent_item_colon);
        return $this;
    }

    /**
     * @param string $new_item_name
     * @return $this
     */
    public function new_item_name($new_item_name) {
        $this->labels['new_item_name'] = $this->translate($new_item_name);
        return $this;
    }

    /**
     * @param string $add_new_item
     * @return $this
     */
    public function add_new_item($add_new_item) {
        $this->labels['add_new_item'] = $this->translate($add_new_item);
        return $this;
    }

    /**
     * @param string $edit_item
     * @return $this
     */
    public function edit_item($edit_item) {
        $this->labels['edit_item'] = $this->translate($edit_item);
        return $this;
    }

    /**
     * @param string $update_item
     * @return $this
     */
    public function update_item($update_item) {
        $this->labels['update_item'] = $this->translate($update_item);
        return $this;
    }

    /**
     * @param string $view_item
     * @return $this
     */
    public function view_item($view_item) {
        $this->labels['view_item'] = $this->translate($view_item);
        return $this;
    }

    /**
     * @param string $separate_items_with_commas
     * @return $this
     */
    public function separate_items_with_commas($separate_items_with_commas) {
        $this->labels['separate_items_with_commas'] = $this->translate($separate_items_with_commas);
        return $this;
    }

    /**
     * @param string $add_or_remove_items
     * @return $this
     */
    public function add_or_remove_items($add_or_remove_items) {
        $this->labels['add_or_remove_items'] = $this->translate($add_or_remove_items);
        return $this;
    }

    /**
     * @param string $choose_from_most_used
     * @return $this
     */
    public function choose_from_most_used($choose_from_most_used) {
        $this->labels['choose_from_most_used'] = $this->translate($choose_from_most_used);
        return $this;
    }

    /**
     * @param string $popular_items
     * @return $this
     */
    public function popular_items($popular_items) {
        $this->labels['popular_items'] = $this->translate($popular_items);
        return $this;
    }

    /**
     * @param string $search_items
     * @return $this
     */
    public function search_items($search_items) {
        $this->labels['search_items'] = $this->translate($search_items);
        return $this;
    }

    /**
     * @param string $not_found
     * @return $this
     */
    public function not_found($not_found) {
        $this->labels['not_found'] = $this->translate($not_found);
        return $this;
    }
    
    /**
     * @param bool $hierarchical
     * @return $this
     */
    public function hierarchical($hierarchical) {
        $this->options['hierarchical'] = $hierarchical;
        return $this;
    }

    /**
     * @param bool $public
     * @return $this
     */
    public function public($public) {
        $this->options['public'] = $public;
        return $this;
    }

    /**
     * @param bool $show_ui
     * @return $this
     */
    public function show_ui($show_ui) {
        $this->options['show_ui'] = $show_ui;
        return $this;
    }

    /**
     * @param bool $show_admin_column
     * @return $this
     */
    public function show_admin_column($show_admin_column) {
        $this->options['show_admin_column'] = $show_admin_column;
        return $this;
    }

    /**
     * @param bool $show_in_nav_menus
     * @return $this
     */
    public function show_in_nav_menus($show_in_nav_menus) {
        $this->options['show_in_nav_menus'] = $show_in_nav_menus;
        return $this;
    }

    /**
     * @param bool $show_tagcloud
     * @return $this
     */
    public function show_tagcloud($show_tagcloud) {
        $this->options['show_tagcloud'] = $show_tagcloud;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_menu($show_in_menu) {
        $this->options['show_in_menu'] = $show_in_menu;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_rest($show_in_rest) {
        $this->options['show_in_rest'] = $show_in_rest;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function rest_base($rest_base) {
        $this->options['rest_base'] = $rest_base;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function rest_controller_class($rest_controller_class) {
        $this->options['rest_controller_class'] = $rest_controller_class;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_quick_edit($show_in_quick_edit) {
        $this->options['show_in_quick_edit'] = $show_in_quick_edit;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function meta_box_cb($meta_box_cb) {
        $this->options['meta_box_cb'] = $meta_box_cb;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function description($description) {
        $this->options['description'] = $description;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function update_count_callback($update_count_callback) {
        $this->options['update_count_callback'] = $update_count_callback;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function query_var($query_var) {
        $this->options['query_var'] = $query_var;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function rewrite($rewrite) {
        $this->options['rewrite'] = $rewrite;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function capabilities($capabilities) {
        $this->options['capabilities'] = $capabilities;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function sort($sort) {
        $this->options['sort'] = $sort;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function _builtin($_builtin) {
        $this->options['_builtin'] = $_builtin;
        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        $options = $this->options;
        $options['labels'] = $this->labels;

        $params = [
            'name' => $this->name,
            'options' => $options,
            'object_type' => $this->object_type,
        ];

        return $params;
    }

    /**
     * @return RegisterTaxonomy
     */
    public function register()
    {
        return RegisterTaxonomy::init($this);
    }


    /**
     * @return $this
     */
    public static function create()
    {
        return new static();
    }


    /**
     * @param string $label
     * @return string
     */
    protected function translate($label)
    {
        return $label; // __($label, 'textdomain');
    }
    
}
