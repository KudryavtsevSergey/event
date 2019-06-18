<?php

namespace Sun\Contracts;

interface EventInterface
{
    public function subscribe($value, $index = null);

    public function unsubscribe($index);
}
