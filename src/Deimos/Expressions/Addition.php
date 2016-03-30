<?php

namespace Deimos\Expressions;

class Addition extends \Deimos\Operator
{

    /**
     * @var int
     */
    protected $precedence = 4;

    /**
     * @param \SplStack $stack
     * @return mixed
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = $stack->pop()->operate($stack);
        return $left + $right;
    }
    
}