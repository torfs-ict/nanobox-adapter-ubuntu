<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class ServerCommand extends ContainerAwareCommand
{
    /**
     * @var string
     */
    protected $originalCommand = '';
    /**
     * @var string
     */
    protected $commandName = '';
    /**
     * @var bool
     */
    protected $useInput = true;

    protected function openFirewall() {
        $cmd = sprintf(
            'iptables -A INPUT -p tcp -d %s --dport %d -j ACCEPT',
            $this->getIpAddress(), $this->getPort()
        );
        exec($cmd);
    }

    protected function getIpAddress() {
        return $this->getContainer()->getParameter('nanobox.external_ip');
    }

    protected function getPort() {
        return $this->getContainer()->getParameter('endpoint.port');
    }

    protected function configure()
    {
        $this->setName($this->commandName);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->openFirewall();
        if ($this->useInput) {
            $forward = new ArrayInput(['addressport' => sprintf('%s:%s', $this->getIpAddress(), $this->getPort())]);
        } else {
            $forward = new ArrayInput([]);
        }
        $command = $this->getApplication()->find($this->originalCommand);
        return $command->run($forward, $output);
    }
}