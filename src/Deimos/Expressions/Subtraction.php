<?php

namespace Deimos\Expressions;

class Subtraction extends Addition
{
    
    /**
     * @param \SplStack $stack
     * @return mixed
     */
    public function operate(\SplStack $stack)
    {
        $left = $stack->pop()->operate($stack);
        $right = 0;
        if ($stack->count()) {
            $right = $stack->pop()->operate($stack);
        }
        return $right - $left;
    }

}