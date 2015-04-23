<?php
class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    // test the talk method
    public function testTalk() {
        $user = new User();
        $expected = "Hello world!";
        $actual = $user->talk();
        $this->assertEquals($expected, $actual);
    }
}
?>