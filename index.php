<?php

use Sun\Event;

include_once __DIR__ . '/vendor/autoload.php';

class A
{
    static function test(MyClass $instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Static: Hello " . get_class($instance);
    }
}

class B
{
    function test(MyClass $instance)
    {
        echo "called: " . __METHOD__ . "<br/>";
        return "Class: Hello " . get_class($instance);
    }
}

function test(MyClass $instance)
{
    echo "called: " . __METHOD__ . "<br/>";
    return "Function: Hello " . get_class($instance);
}

//class must extend Event
class MyClass extends Event
{
    /**
     * Execute method
     */
    public function executeMethod()
    {
        $this->execute(['test']);
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
$myClass->subscribe(function (MyClass $instance, $data) {
    echo "called: " . __METHOD__ . "<br/>";
    echo "<pre>" . print_r($data, 1) . "</pre>";
    return "Closure: Hello " . get_class($instance);
});
//call method
$myClass->executeMethod();
