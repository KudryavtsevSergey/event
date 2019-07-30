<?php

namespace Sun;

use Sun\Contracts\EventInterface;

class Event implements EventInterface
{
    /**
     * @var ArrayDelegate
     */
    protected $arrayDelegate;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        $this->arrayDelegate = new ArrayDelegate();
    }

    /**
     * @param callable $callback
     * @param null $index
     */
    public function subscribe(callable $callback, $index = null)
    {
        $this->arrayDelegate->offsetSet($index, $callback);
    }

    /**
     * @param $index
     */
    public function unsubscribe($index)
    {
        $this->arrayDelegate->offsetUnset($index);
    }

    /**
     * @param array $parameters
     */
    protected function execute($parameters = [])
    {
        $parameters = (array)$parameters;
        array_walk($this->arrayDelegate, function (Delegate $delegate) use ($parameters) {
            $delegate->invoke($this, $parameters);
        });
    }

    /**
     * @param callable $callback
     * @param array $parameters
     */
    protected function executeCallback(callable $callback, array $parameters = [])
    {
        $parameters = (array)$parameters;
        foreach ($this->arrayDelegate as $delegate) {
            $callback($delegate->invoke($this, $parameters));
        }
    }
}
