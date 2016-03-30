<?php

namespace Deimos\Expressions;

class Number extends \Deimos\TerminalExpression
{

    /**
     * @param \SplStack $stack
     * @return mixed
     */
    public function operate(\SplStack $stack)
    {
        return $this->storage;
    }
    
}