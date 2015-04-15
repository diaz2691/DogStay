<?php
class HelloWorld
{
    private $greeting;

    public function __construct()
    {
        $this->greeting = "Hello World";
    }

    public function getGreeting()
    {
        return $this->greeting;
    }


}

$helloObj = new HelloWorld();

echo $helloObj->getGreeting();
?>