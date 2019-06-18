<?php

namespace Sun;

use ArrayObject;

class ArrayDelegate extends ArrayObject
{
    public function offsetSet($index, $value)
    {
        $delegate = new Delegate($value);
        parent::offsetSet($index, $delegate);
    }
}
