<?php

namespace AppBundle\Command;

class ServerStartCommand extends ServerCommand
{
    protected $commandName = 'endpoint:start';
    protected $originalCommand = 'server:start';
}
