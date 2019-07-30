<?php

use Sun\Event;

include_once __DIR__ . '/vendor/autoload.php';

class A
{
    static function test($instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Static: Hello " . $instance->name;
    }
}

class B
{
    function test($instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Class: Hello " . $instance->name;
    }
}

function test($instance)
{
    echo "called: " . __METHOD__ . "<br/>";
    return "Function: Hello " . $instance->name;
}

class MyClass extends Event
{
    public $name = 'my_class';

    public function executeMethod()
    {
        $this->execute();
        $this->executeCallback(function ($result) {
            echo "result: {$result}<br/>";
        });
    }
}

$myClass = new MyClass();
$myClass->subscribe([A::class, 'test']);
$myClass->subscribe([new B, 'test']);
$myClass->subscribe('test');
$myClass->executeMethod();
