<?php

namespace Deimos\Expressions;

class Multiplication extends Division
{

    /**
     * @param \SplStack $stack
     * @return mixed
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $left * $right;
    }

}