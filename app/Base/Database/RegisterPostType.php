<?php

namespace App\Base\Database;

class RegisterPostType
{
    /**
     * @var PostType
     */
    protected $post_type;
    public function __construct(PostType $post_type)
    {
        $this->post_type = $post_type;
    }
    /**
     * @param PostType $postType
     */
    public function register()
    {
        $params = $this->post_type->get();
        register_post_type($params['name'], $params['options']);
    }

    /**
     * @param PostType
     * @return $this
     */
    public static function init(PostType $post_type)
    {
        return new static($post_type);
    }
}
