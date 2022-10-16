<?php


use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function twoPlusFour()
    {
        $this->assertEquals(3, 1 + 1);
    }
}
