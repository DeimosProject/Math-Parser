<?php

namespace Deimos;

abstract class TerminalExpression
{

    /**
     * @var mixed
     */
    protected $storage;

    /**
     * @var int
     */
    protected $precedence = 0;

    /**
     * TerminalExpression constructor.
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $storage
     * @return TerminalExpression|Operator|Expressions\Parenthesis
     * @throws \Exception
     */
    public static function factory($storage)
    {

        if (is_object($storage) && $storage instanceof self) {
            return $storage;
        }

        if (is_numeric($storage)) {
            return new Expressions\Number($storage);
        }

        switch ($storage) {

            case '+':
                return new Expressions\Addition($storage);

            case '-':
                return new Expressions\Subtraction($storage);

            case '*':
                return new Expressions\Multiplication($storage);

            case '/':
                return new Expressions\Division($storage);

            case '^':
                return new Expressions\Power($storage);

            case '%':
                return new Expressions\Modulus($storage);

            case '(':
            case ')':
                return new Expressions\Parenthesis($storage);

        }

        throw new \InvalidArgumentException($storage);

    }

    /**
     * @param \SplStack $stack
     */
    abstract public function operate(\SplStack $stack);

    /**
     * @return mixed
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @return int
     */
    public function getPrecedence()
    {
        return $this->precedence;
    }

}