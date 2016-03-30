<?php

namespace Deimos\Expressions;

class Power extends Multiplication
{

    /**
     * @param \SplStack $stack
     * @return mixed
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return pow($right, $left);
    }

}