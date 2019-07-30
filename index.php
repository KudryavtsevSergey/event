<?php

use Sun\Event;

include_once __DIR__ . '/vendor/autoload.php';

class A
{
    static function test(MyClass $instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Static: Hello " . $instance->name;
    }
}

class B
{
    function test(MyClass $instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Class: Hello " . $instance->name;
    }
}

function test(MyClass $instance)
{
    echo "called: " . __METHOD__ . "<br/>";
    return "Function: Hello " . $instance->name;
}

//class must extend Event
class MyClass extends Event
{
    public $name = 'my_class';

    /**
     * Execute method
     */
    public function executeMethod()
    {
        $this->execute();
        $this->executeCallback(function ($result) {
            echo "result: {$result}<br/>";
        });
    }
}

//create new class
$myClass = new MyClass();
//subscribe static class
$myClass->subscribe([A::class, 'test']);
//subscribe non static class
$myClass->subscribe([new B, 'test']);
//subscribe function
$myClass->subscribe('test');
//subscribe function
$myClass->subscribe(function (MyClass $instance) {
    echo "called: " . __METHOD__ . "<br/>";
    return "Closure: Hello " . $instance->name;
});
//call method
$myClass->executeMethod();
