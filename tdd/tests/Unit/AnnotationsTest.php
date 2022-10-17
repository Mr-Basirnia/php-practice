<?php

namespace tests\Unit;

use PHPUnit\Framework\TestCase;

class AnnotationsTest extends TestCase
{
    private $value;

    public function testCorrectValue(): int
    {
        $this->value++;
        $this->assertEquals(1, $this->value);
        return $this->value;
    }

    /**
     * @depends testCorrectValue
     * @return void
     */
    public function testCorrectValue2($value)
    {
        $value++;
        $this->assertEquals(2, $value);
    }
}
