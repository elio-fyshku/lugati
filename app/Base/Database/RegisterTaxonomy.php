<?php

namespace App\Base\Database;

class RegisterTaxonomy
{
    /**
     * @var Taxonomy
     */
    protected $taxonomy;
    public function __construct(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }
    /**
     * @param Taxonomy $postType
     */
    public function register()
    {
        $params = $this->taxonomy->get();
        register_taxonomy($params['name'], $params['object_type'], $params['options']);
    }

    /**
     * @param Taxonomy
     * @return $this
     */
    public static function init(Taxonomy $taxonomy)
    {
        return new static($taxonomy);
    }
}
