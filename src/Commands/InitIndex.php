<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午3:04
 */

namespace Ace\Suggestion\Commands;

use Ace\Suggestion\Indexer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class InitIndex extends Command
{
    protected function configure()
    {
        $this
            ->setName('index:init')
            ->setDescription('initialize a index for suggestion')
            ->addOption(
                'reset',
                null,
                InputOption::VALUE_NONE,
                'If set, delete index at first.'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $Indexer = new Indexer();

        if ($input->getOption('reset')) {
            $Indexer->deleteIndex();
        }

        $Indexer->initIndex();
    }

}