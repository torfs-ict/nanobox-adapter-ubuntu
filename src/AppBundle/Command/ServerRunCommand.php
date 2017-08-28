<?php

namespace AppBundle\Command;

class ServerRunCommand extends ServerCommand
{
    protected $commandName = 'endpoint:run';
    protected $originalCommand = 'server:run';
}
