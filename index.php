<?php

use Sun\Event;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    protected $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        $this->execute();
        $this->executeCallback(function ($result) {
            echo "result: {$result}<br/>";
        });
    }

    public function __get($name)
    {
        return $this->data[$name];
    }
}

$myClass = new MyClass();
$myClass->subscribe([A::class, 'test']);
$myClass->subscribe([new B, 'test']);
$myClass->subscribe('test');
$myClass->name = 'name 2';
