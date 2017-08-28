<?php

namespace AppBundle\Command;

class ServerStopCommand extends ServerCommand
{
    protected $commandName = 'endpoint:stop';
    protected $originalCommand = 'server:stop';
    protected $useInput = false;
}
