<?php

namespace Deimos\Expressions;

class Modulus extends Division
{

    /**
     * @param \SplStack $stack
     * @return int
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $right % $left;
    }
    
}