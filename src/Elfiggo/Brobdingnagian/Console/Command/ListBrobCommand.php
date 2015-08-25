<?php
namespace Elfiggo\Brobdingnagian\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class ListBrobCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('broblist')
            ->setDefinition(array(
                new InputArgument('brob', InputArgument::OPTIONAL, 'Enable list mode'),
            ))
            ->setDescription('Outputs a list of messages about class size')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command allows you to run your phpspec suite and view which classes are Brobdingnagian:


  <info>phpspec r %command.full_name%</info>

EOF
            )
        ;
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
       $output->writeln("Ran");
    }

} 
