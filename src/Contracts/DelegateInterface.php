<?php

namespace Sun\Contracts;

use Sun\Event;

interface DelegateInterface
{
    /**
     * @param Event $event
     * @param array $parameters
     * @return mixed
     */
    public function invoke(Event $event, array $parameters = []);
}
