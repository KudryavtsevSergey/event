<?php

namespace Sun\Contracts;

use Sun\Event;

interface DelegateInterface
{
    public function invoke(Event $event, $parameters = []);
}
