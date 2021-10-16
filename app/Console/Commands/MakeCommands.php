<?php

namespace App\Console\Commands;


class MakeCommands
{
    /**
	 * Create new taxonomy.
     * This command allows you to create new taxonomy
	 *
	 * ## OPTIONS
	 *
	 * [<name>]
	 * : New taxonomy class name.
     * 
     * [--posts]
	 * : Get Posts for this taxonomy
	 *
	 *
	 * ## EXAMPLES
	 *
	 *     wp please theme taxonomy <name>
	 *
	 * @alias taxonomy
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function taxonomy($args, $assoc_args) {
        return (new TaxonomyGeneratorCommand())->run($args, $assoc_args);
	}

	/**
	 * Create new post type.
     * This command allows you to create new post type
	 *
	 * ## OPTIONS
	 *
	 * [<name>]
	 * : New post-type class name.
	 *
	 * ## EXAMPLES
	 *
	 *     wp please theme post-type <name>
	 *
	 * @alias post-type
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
	public function post_type($args, $assoc_args) {
        return (new PostTypeGeneratorCommand())->run($args, $assoc_args);
	}
}
