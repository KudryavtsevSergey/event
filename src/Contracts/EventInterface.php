<?php

namespace Sun\Contracts;

interface EventInterface
{
    /**
     * @param callable $callback
     * @param null $index
     * @return mixed
     */
    public function subscribe(callable $callback, $index = null);

    /**
     * @param $index
     * @return void
     */
    public function unsubscribe($index);
}
