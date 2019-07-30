<?php

namespace Sun;

use Exception;
use Sun\Contracts\DelegateInterface;

class Delegate implements DelegateInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * Delegate constructor.
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param Event $event
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    public function invoke(Event $event, array $parameters = [])
    {
        if (!is_callable($this->callback)) {
            throw new Exception("Function not callable!");
        }

        $parameters = array_merge([$event], (array)$parameters);

        return call_user_func_array($this->callback, $parameters);
    }
}
