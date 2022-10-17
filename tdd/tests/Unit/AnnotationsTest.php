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

    /**
     * @dataProvider numberCollection
     * @return void
     */
    public function testIsValidNumber($collection)
    {
        $this->assertTrue($collection > 0);
    }

    public function numberCollection(): array
    {
        return [[1], [2], [3], [4], [5], [6], [7], [8], [9], [10]];
    }
}
