<?php

namespace Deimos\Expressions;

class Division extends \Deimos\Operator
{

    /**
     * @var int
     */
    protected $precedence = 5;

    /**
     * @param \SplStack $stack
     * @return float
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $right / $left;
    }
    
}