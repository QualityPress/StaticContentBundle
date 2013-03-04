<?php

namespace QualityPress\Bundle\StaticContentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CreateContentCommand
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class CreateContentCommand extends ContainerAwareCommand
{
    
    protected function configure()
    {
        $this
            ->setName('quality:static-content:create')
            ->setDescription('Create a list of contents')
            ->setDefinition(array())
            ->setHelp(<<<EOT
The <info>quality:static-content:create</info> command loads content fixtures from your bundle config file.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (false == $dialog->askConfirmation($output, '<question>Careful, content table will be purged. Do you want to continue Y/N ?</question>', false)) {
            return;
        }
        
        $dataBuilded = $this->getContainer()->get('qp.static_content.data_manipulator')->rebuild();
        $output->writeln(sprintf('Created <comment>%s</comment> data contents', $dataBuilded));
    }
    
}