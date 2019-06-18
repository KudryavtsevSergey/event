<?php

namespace Sun;

use Sun\Contracts\EventInterface;

class Event implements EventInterface
{
    /**
     * @var ArrayDelegate
     */
    protected $arrayDelegate;

    public function __construct()
    {
        $this->arrayDelegate = new ArrayDelegate();
    }

    /**
     * @param $value
     * @param null $index
     */
    public function subscribe($value, $index = null)
    {
        $this->arrayDelegate->offsetSet($index, $value);
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
        foreach ($this->arrayDelegate as $delegate) {
            $delegate->invoke($this, $parameters);
        }
    }

    /**
     * @param callable $callback
     * @param array $parameters
     */
    protected function executeCallback(callable $callback, $parameters = [])
    {
        $parameters = (array)$parameters;
        foreach ($this->arrayDelegate as $delegate) {
            $callback($delegate->invoke($this, $parameters));
        }
    }
}
