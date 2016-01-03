<?php

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Lumen.');
    }

    public function testIfOneMoreOneIsTwo()
    {
        $a = 2;
        $b = 2;
        $this->assertEquals('4', $a+$b);
    }
}
