<?php

namespace App\Console\Commands;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand
{
    /**
     * @var \Symfony\Component\Finder\Finder
     */
    protected $finder;

    /**
     * @var string
     */
    protected $baseDir;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var string
     */
    protected $replacement;

    public function __construct(string $baseDir)
    {
        $this->baseDir = $baseDir;
        $this->finder = Finder::create();
    }

    /**
	 * Push all records to Elastic for a given index.
	 *
	 * ## OPTIONS
	 *
	 * [<indexName>]
	 * : The id of the index without the prefix.
	 *
	 * [--clear]
	 * : Clear all existing records prior to pushing the records.
	 *
	 * [--all]
	 * : Re-indexes all the enabled indices.
	 *
	 * ## EXAMPLES
	 *
	 *     wp es re-index
	 *
	 * @alias re-index
     * @param mixed $args Args.
     * @param mixed $assoc_args Assoc Args.
	 */
    public function execute($args, $assoc_args)
    {
        dd($args, $assoc_args);
    }

}