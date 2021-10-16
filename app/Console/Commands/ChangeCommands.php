<?php

namespace App\Console\Commands;


class ChangeCommands
{
    /**
	 * Change current theme text-domain.
	 *
	 * ## OPTIONS
	 *
	 * [<new-textdomain>]
	 * : The new textdomain.
	 *
	 * ## EXAMPLES
	 *
	 *     wp please theme text-domain yourtextdomain
	 *
	 * @alias text-domain
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function text_domain($args, $assoc_args) {
        return (new ChangeTextDomainCommand())->run($args, $assoc_args);
	}
}
