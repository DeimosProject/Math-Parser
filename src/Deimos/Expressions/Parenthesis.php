<?php

namespace Deimos\Expressions;

class Parenthesis extends \Deimos\TerminalExpression
{

    /**
     * @var int
     */
    protected $precedence = 6;

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->storage === '(';
    }
    
    public function operate(\SplStack $stack)
    {
        // TODO: Implement operate() method.
    }

}