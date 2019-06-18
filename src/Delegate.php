<?php

namespace Sun;

use mysql_xdevapi\Exception;
use Sun\Contracts\DelegateInterface;

class Delegate implements DelegateInterface
{
    /**
     * @var callable
     */
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function invoke(Event $event, $parameters = [])
    {
        if (!is_callable($this->callback)) {
            throw new Exception("Function not callable!");
        }

        $parameters = array_merge([$event], (array)$parameters);

        return call_user_func_array($this->callback, $parameters);
    }
}
