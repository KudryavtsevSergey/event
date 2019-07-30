<?php

namespace Sun\Contracts;

interface EventInterface
{
    /**
     * @param $value
     * @param null $index
     * @return void
     */
    public function subscribe($value, $index = null);

    /**
     * @param $index
     * @return void
     */
    public function unsubscribe($index);
}
