<?php

namespace App\Base\Database;




/**
 * labels
 *      - √ 'name' - general name for the post type, usually plural. The same and overridden by $post_type_object->label. Default is Posts/Pages
 *      - √ 'singular_name' - name for one object of this post type. Default is Post/Page
 *      - √ 'add_new' - the add new text. The default is "Add New" for both hierarchical and non-hierarchical post types. When internationalizing this string, please use a gettext context matching your post type. Example: _x('Add New', 'product');
 *      - √ 'add_new_item' - Default is Add New Post/Add New Page.
 *      - √ 'edit_item' - Default is Edit Post/Edit Page.
 *      - √ 'new_item' - Default is New Post/New Page.
 *      - √ 'view_item' - Default is View Post/View Page.
 *      - 'view_items' - Label for viewing post type archives. Default is 'View Posts' / 'View Pages'.
 *      - √ 'search_items' - Default is Search Posts/Search Pages.
 *      - √ 'not_found' - Default is No posts found/No pages found.
 *      - √ 'not_found_in_trash' - Default is No posts found in Trash/No pages found in Trash.
 *      - √ 'parent_item_colon' - This string isn't used on non-hierarchical types. In hierarchical ones the default is 'Parent Page:'.
 *      - √ 'all_items' - String for the submenu. Default is All Posts/All Pages.
 *      - 'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
 *      - 'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'.
 *      - 'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
 *      - 'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
 *      - 'featured_image' - Default is Featured Image.
 *      - 'set_featured_image' - Default is Set featured image.
 *      - 'remove_featured_image' - Default is Remove featured image.
 *      - 'use_featured_image' - Default is Use as featured image.
 *      - √ 'menu_name' - Default is the same as `name`.
 *      - 'filter_items_list' - String for the table views hidden heading.
 *      - 'items_list_navigation' - String for the table pagination hidden heading.
 *      - 'items_list' - String for the table hidden heading.
 *      - 'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`.
 * description - (string) (optional) A short descriptive summary of what the post type is.
 * √ public (boolean) - (optional) Controls how the type is visible to authors (show_in_nav_menus, show_ui) and readers 
 * exclude_from_search - (boolean) (importance) Whether to exclude posts with this post type from front end search results.
 * publicly_queryable - (boolean) (optional) Whether queries can be performed on the front end as part of parse_request().
 * √ show_ui - (boolean) (optional) Whether to generate a default UI for managing this post type in the admin.
 * √ show_in_nav_menus - (boolean) (optional) Whether post_type is available for selection in navigation menus.
 * show_in_menu - (boolean or string) (optional) Where to show the post type in the admin menu. show_ui must be true.
 * show_in_admin_bar - (boolean) (optional) Whether to make this post type available in the WordPress admin bar.
 * menu_position - (integer) (optional) The position in the menu order the post type should appear. show_in_menu must be true.
 *      - 5 - below Posts
 *      - 10 - below Media
 *      - 15 - below Links
 *      - 20 - below Pages
 *      - 25 - below comments
 *      - 60 - below first separator
 *      - 65 - below Plugins
 *      - 70 - below Users
 *      - 75 - below Tools
 *      - 80 - below Settings
 *      - 100 - below second separator
 * menu_icon - (string) (optional) The url to the icon to be used for this menu or the name of the icon from the iconfont [1]
 *      - 'dashicons-video-alt' (Uses the video icon from Dashicons[2])
 *      - 'get_template_directory_uri() . "/images/cutom-posttype-icon.png"' (Use a image located in the current theme)
 *      - 'data:image/svg+xml;base64,' . base64_encode( "<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 459 459"> <path fill="black" d="POINTS"/></svg>" )' (directly embedding a svg with 'fill="black"' will allow correct colors.
 * capability_type - (string or array) (optional) The string to use to build the read, edit, and delete capabilities. May be passed as an array to allow for alternative plurals when using this argument as a base to construct the capabilities, e.g. array('story', 'stories') the first array element will be used for the singular capabilities and the second array element for the plural capabilities, this is instead of the auto generated version if no array is given which would be "storys". The 'capability_type' parameter is used as a base to construct capabilities unless they are explicitly set with the 'capabilities' parameter. It seems that `map_meta_cap` needs to be set to false or null, to make this work (see note 2 below).
 *      - Default: "post"
 * capabilities - (array) (optional) An array of the capabilities for this post type.
 *      - Default: capability_type is used to construct
 *      By default, seven keys are accepted as part of the capabilities array:
 *      - edit_post, read_post, and delete_post - These three are meta capabilities, which are then generally mapped to corresponding primitive capabilities depending on the context, for example the post being edited/read/deleted and the user or role being checked. Thus these capabilities would generally not be granted directly to users or roles.
 *      - edit_posts - Controls whether objects of this post type can be edited.
 *      - edit_others_posts - Controls whether objects of this type owned by other users can be edited. If the post type does not support an author, then this will behave like edit_posts.
 *      - publish_posts - Controls publishing objects of this post type.
 *      - read_private_posts - Controls whether private objects can be read.
 * map_meta_cap - (boolean) (optional) Whether to use the internal default meta capability handling.
 * √ hierarchical - (boolean) (optional) Whether the post type is hierarchical (e.g. page). Allows Parent to be specified. The 'supports' parameter should contain 'page-attributes' to show the parent select box on the editor page.
 * √ supports - (array/boolean) (optional) An alias for calling add_post_type_support() directly. As of 3.5, boolean false can be passed as value instead of an array to prevent default (title and editor) behavior.
 * register_meta_box_cb - (callback ) (optional) Provide a callback function that will be called when setting up the meta boxes for the edit form. The callback function takes one argument $post, which contains the WP_Post object for the currently edited post. Do remove_meta_box() and add_meta_box() calls in the callback.
 * taxonomies - (array) (optional) An array of registered taxonomies like category or post_tag that will be used with this post type. This can be used in lieu of calling register_taxonomy_for_object_type() directly. Custom taxonomies still need to be registered with register_taxonomy().
 * √ has_archive - (boolean or string) (optional) Enables post type archives. Will use $post_type as archive slug by default.
 * √ rewrite - (boolean or array) (optional) Triggers the handling of rewrites for this post type. To prevent rewrites, set to false.
 * permalink_epmask - (string) (optional) The default rewrite endpoint bitmasks. For more info see Trac Ticket 12605 and this - Make WordPress Plugins summary of endpoints.
 * √ query_var - (boolean or string) (optional) Sets the query_var key for this post type.
 * can_export - (boolean) (optional) Can this post_type be exported.
 * delete_with_user - (boolean) (optional) Whether to delete posts of this type when deleting a user. If true, posts of this type belonging to the user will be moved to trash when then user is deleted. If false, posts of this type belonging to the user will not be trashed or deleted. If not set (the default), posts are trashed if post_type_supports('author'). Otherwise posts are not trashed or deleted.
 * show_in_rest - (boolean) (optional) Whether to expose this post type in the REST API.
 * rest_base - (string) (optional) The base slug that this post type will use when accessed using the REST API.
 * rest_controller_class - (string) (optional) An optional custom controller to use instead of WP_REST_Posts_Controller. Must be a subclass of WP_REST_Controller.
 * _builtin - (boolean) (not for general use) Whether this post type is a native or "built-in" post_type. Note: this Codex entry is for documentation - core developers recommend you don't use this when registering your own post type
 * _edit_link - (boolean) (not for general use) Link to edit an entry with this post type. Note: this Codex entry is for documentation - core developers recommend you don't use this when registering your own post type
 */
class PostType
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


    public function __construct()
    {
        $this->labels = [
            // 'name'                => __( 'Name', 'yourtextdomain'),
            // 'singular_name'       => __( 'Name', 'yourtextdomain'),
            'all_items' => __('All items', 'yourtextdomain'),
            'new_item' => __('New item', 'yourtextdomain'),
            'add_new' => __('Add New', 'yourtextdomain'),
            'add_new_item' => __('Add New item', 'yourtextdomain'),
            'edit_item' => __('Edit item', 'yourtextdomain'),
            'view_item' => __('View item', 'yourtextdomain'),
            'search_items' => __('Search items', 'yourtextdomain'),
            'not_found' => __('No item found', 'yourtextdomain'),
            'not_found_in_trash' => __('No item found in trash', 'yourtextdomain'),
            'parent_item_colon' => __('Parent item', 'yourtextdomain'),
            // 'menu_name' => __( 'Name', 'yourtextdomain'),
        ];

        $this->options = [
            'public' => true,
            'hierarchical' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'has_archive' => false,
            'rewrite' => true,
            'query_var' => true,
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
     * @param string $name
     * @return $this
     */
    public function name($name)
    {
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
    public function singular_name($singular_name)
    {
        $this->labels['singular_name'] = $this->translate($singular_name);
        return $this;
    }

    /**
     * @param string $all_items
     * @return $this
     */
    public function all_items($all_items)
    {
        $this->labels['all_items'] = $this->translate($all_items);
        return $this;
    }

    /**
     * @param string $new_item
     * @return $this
     */
    public function new_item($new_item)
    {
        $this->labels['new_item'] = $this->translate($new_item);
        return $this;
    }

    /**
     * @param string $add_new_item
     * @return $this
     */
    public function add_new_item($add_new_item)
    {
        $this->labels['add_new_item'] = $this->translate($add_new_item);
        return $this;
    }

    /**
     * @param string $edit_item
     * @return $this
     */
    public function edit_item($edit_item)
    {
        $this->labels['edit_item'] = $this->translate($edit_item);
        return $this;
    }

    /**
     * @param string $view_item
     * @return $this
     */
    public function view_item($view_item)
    {
        $this->labels['view_item'] = $this->translate($view_item);
        return $this;
    }

    /**
     * @param string $search_items
     * @return $this
     */
    public function search_items($search_items)
    {
        $this->labels['search_items'] = $this->translate($search_items);
        return $this;
    }

    /**
     * @param string $not_found
     * @return $this
     */
    public function not_found($not_found)
    {
        $this->labels['not_found'] = $this->translate($not_found);
        return $this;
    }

    /**
     * @param string $not_found_in_trash
     * @return $this
     */
    public function not_found_in_trash($not_found_in_trash)
    {
        $this->labels['not_found_in_trash'] = $this->translate($not_found_in_trash);
        return $this;
    }

    /**
     * @param string $parent_item_colon
     * @return $this
     */
    public function parent_item_colon($parent_item_colon)
    {
        $this->labels['parent_item_colon'] = $this->translate($parent_item_colon);
        return $this;
    }

    /**
     * @param string $parent_item_colon
     * @return $this
     */
    public function menu_name($parent_item_colon)
    {
        $this->labels['menu_name'] = $this->translate($menu_name);
        return $this;
    }

    /**
     * @param string $view_items
     * @return $this
     */
    public function view_items($view_items) {
        $this->labels['view_items'] = $view_items;
        return $this;
    }

    /**
     * @param string $archives
     * @return $this
     */
    public function archives($archives) {
        $this->labels['archives'] = $archives;
        return $this;
    }

    /**
     * @param string $attributes
     * @return $this
     */
    public function attributes($attributes) {
        $this->labels['attributes'] = $attributes;
        return $this;
    }

    /**
     * @param string $insert_into_item
     * @return $this
     */
    public function insert_into_item($insert_into_item) {
        $this->labels['insert_into_item'] = $insert_into_item;
        return $this;
    }

    /**
     * @param string $uploaded_to_this_item
     * @return $this
     */
    public function uploaded_to_this_item($uploaded_to_this_item) {
        $this->labels['uploaded_to_this_item'] = $uploaded_to_this_item;
        return $this;
    }

    /**
     * @param string $featured_image
     * @return $this
     */
    public function featured_image($featured_image) {
        $this->labels['featured_image'] = $featured_image;
        return $this;
    }

    /**
     * @param string $set_featured_image
     * @return $this
     */
    public function set_featured_image($set_featured_image) {
        $this->labels['set_featured_image'] = $set_featured_image;
        return $this;
    }

    /**
     * @param string $remove_featured_image
     * @return $this
     */
    public function remove_featured_image($remove_featured_image) {
        $this->labels['remove_featured_image'] = $remove_featured_image;
        return $this;
    }

    /**
     * @param string $use_featured_image
     * @return $this
     */
    public function use_featured_image($use_featured_image) {
        $this->labels['use_featured_image'] = $use_featured_image;
        return $this;
    }

    /**
     * @param string $filter_items_list
     * @return $this
     */
    public function filter_items_list($filter_items_list) {
        $this->labels['filter_items_list'] = $filter_items_list;
        return $this;
    }

    /**
     * @param string $items_list_navigation
     * @return $this
     */
    public function items_list_navigation($items_list_navigation) {
        $this->labels['items_list_navigation'] = $items_list_navigation;
        return $this;
    }

    /**
     * @param string $items_list
     * @return $this
     */
    public function items_list($items_list) {
        $this->labels['items_list'] = $items_list;
        return $this;
    }

    /**
     * @param string $name_admin_bar
     * @return $this
     */
    public function name_admin_bar($name_admin_bar) {
        $this->labels['name_admin_bar'] = $name_admin_bar;
        return $this;
    }

    /**
     * @param array $supports : array( 'title', 'editor', 'thumbnail' )
     * @return $this
     */
    public function supports($supports)
    {
        $this->options['supports'] = $supports;
        return $this;
    }

    /**
     * @param bool $public
     * @return $this
     */
    public function public($public)
    {
        $this->options['public'] = $public;
        return $this;
    }

    /**
     * @param bool $hierarchical
     * @return $this
     */
    public function hierarchical($hierarchical)
    {
        $this->options['hierarchical'] = $hierarchical;
        return $this;
    }

    /**
     * @param bool $show_ui
     * @return $this
     */
    public function show_ui($show_ui)
    {
        $this->options['show_ui'] = $show_ui;
        return $this;
    }

    /**
     * @param bool $show_in_nav_menus
     * @return $this
     */
    public function show_in_nav_menus($show_in_nav_menus)
    {
        $this->options['show_in_nav_menus'] = $show_in_nav_menus;
        return $this;
    }

    /**
     * @param bool $has_archive
     * @return $this
     */
    public function has_archive($has_archive)
    {
        $this->options['has_archive'] = $has_archive;
        return $this;
    }

    /**
     * @param bool $rewrite
     * @return $this
     */
    public function rewrite($rewrite)
    {
        $this->options['rewrite'] = $rewrite;
        return $this;
    }

    /**
     * @param bool $query_var
     * @return $this
     */
    public function query_var($query_var)
    {
        $this->options['query_var'] = $query_var;
        return $this;
    }

    /**
     * @param
     * @return $this
      */
    public function description($description) {
        $this->options["description"] = $description;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function exclude_from_search($exclude_from_search) {
        $this->options["exclude_from_search"] = $exclude_from_search;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function publicly_queryable($publicly_queryable) {
        $this->options["publicly_queryable"] = $publicly_queryable;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_menu($show_in_menu) {
        $this->options["show_in_menu"] = $show_in_menu;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_admin_bar($show_in_admin_bar) {
        $this->options["show_in_admin_bar"] = $show_in_admin_bar;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function menu_position($menu_position) {
        $this->options["menu_position"] = $menu_position;
        return $this;
    }

    /**
     * @param
     * @return $this
    */
    public function menu_icon($menu_icon) {
        $this->options["menu_icon"] = $menu_icon;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function capability_type($capability_type) {
        $this->options["capability_type"] = $capability_type;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function capabilities($capabilities) {
        $this->options["capabilities"] = $capabilities;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function map_meta_cap($map_meta_cap) {
        $this->options["map_meta_cap"] = $map_meta_cap;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function register_meta_box_cb($register_meta_box_cb) {
        $this->options["register_meta_box_cb"] = $register_meta_box_cb;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function taxonomies($taxonomies) {
        $this->options["taxonomies"] = $taxonomies;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function permalink_epmask($permalink_epmask) {
        $this->options["permalink_epmask"] = $permalink_epmask;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function can_export($can_export) {
        $this->options["can_export"] = $can_export;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function delete_with_user($delete_with_user) {
        $this->options["delete_with_user"] = $delete_with_user;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function show_in_rest($show_in_rest) {
        $this->options["show_in_rest"] = $show_in_rest;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function rest_base($rest_base) {
        $this->options["rest_base"] = $rest_base;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function rest_controller_class($rest_controller_class) {
        $this->options["rest_controller_class"] = $rest_controller_class;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function _builtin($_builtin) {
        $this->options["_builtin"] = $_builtin;
        return $this;
    }

    /**
     * @param
     * @return $this
     */
    public function _edit_link($_edit_link) {
        $this->options["_edit_link"] = $_edit_link;
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
        ];

        return $params;
    }

    /**
     * @return RegisterPostType
     */
    public function register()
    {
        return RegisterPostType::init($this);
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
        return $label; //__($label, 'yourtextdomain');
    }

}
