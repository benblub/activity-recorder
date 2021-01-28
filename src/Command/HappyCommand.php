<?php


namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HappyCommand extends Command
{
    protected static $defaultName = 'app:happy';

    protected function configure()
    {
        $this
            ->setDescription('A happy Command!')
            ->setHelp('Just a happy Command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Happy CMD',
            'Have fun!'
        ]);

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;
    }
}