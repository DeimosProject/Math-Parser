<?php

namespace Deimos;

class MathTest extends \PHPUnit_Framework_TestCase
{

    public function testExampleAdd()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2 +3 '), 5);
    }

    public function testExampleSub()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2 -3 '), -1);
    }

    public function testExampleMul()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2 *3 '), 6);
    }

    public function testExampleDiv()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('3 /2 '), 1.5);
    }

    public function testExampleMod()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2 %3 '), 1 << 1);
    }

    public function testExamplePow()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2 ^10 '), 1 << 10);
    }

    public function testExampleNumber()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('77777'), 77777);
    }

    public function testExampleParenthesis()
    {
        $math = new Math();
        $this->assertEquals($math->evaluate('2+2*2'), 6);
        $this->assertEquals($math->evaluate('(2+2)*2'), 1 << 3);
        $this->assertEquals($math->evaluate('2+2*((2 + 2) * 2)'), (1 << 4) | (1 << 1));
        $this->assertEquals($math->evaluate('(2 * (2 + 2))*((2 + 2) * 2)'), 1 << 6);
        $this->assertEquals($math->evaluate('(2 ^ 3)*((2 ^ 2) * 2)'), 1 << 6);
    }

}
