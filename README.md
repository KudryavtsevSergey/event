# php event

git clone https://github.com/KudryavtsevSergey/event.git

cd event-master

composer install

```php
use Sun\Event;

include_once __DIR__ . '/vendor/autoload.php';

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
//call method
$myClass->executeMethod();
```

