<?php

namespace Deimos;

use Deimos\Expressions\Parenthesis;

class Math
{

    /**
     * @var array
     */
    protected $variables = array();

    /**
     * @param $string
     * @return mixed
     */
    public function evaluate($string)
    {
        $stack = $this->parse($string);
        return $this->run($stack);
    }
    
    /**
     * @param Operator $expression
     * @param \SplStack $output
     * @param \SplStack $operators
     */
    protected function parseOperator(Operator $expression, \SplStack &$output, \SplStack &$operators)
    {

        while (!$operators->isEmpty()) {

            $end = $operators->top();

            if ($end instanceof Operator) {
                if ($expression->getPrecedence() <= $end->getPrecedence()) {
                    $output->push($operators->pop());
                }
                else {
                    break;
                }
            }
            else {
                break;
            }

        }

        $operators->push($expression);

    }

    /**
     * @param Parenthesis $expression
     * @param \SplStack $output
     * @param \SplStack $operators
     */
    protected function parseParenthesis(Parenthesis $expression, \SplStack &$output, \SplStack &$operators)
    {

        if ($expression->isOpen()) {
            $operators->push($expression);
        }
        else {

            $clean = false;
            while (!$operators->isEmpty()) {

                $end = $operators->pop();

                if ($end instanceof Parenthesis) {
                    $clean = true;
                    break;
                }
                else {
                    $output->push($end);
                }

            }

            if (!$clean) {
                throw new \RuntimeException('Mismatched Parenthesis');
            }

        }
    }

    /**
     * @param \SplStack $stack
     * @return string
     */
    protected function render(\SplStack $stack)
    {

        $output = '';

        while (!$stack->isEmpty()) {
            $element = $stack->pop();
            $output .= $element->getStorage();
        }

        if (!empty($output)) {
            return $output;
        }

        throw new \RuntimeException('Could not render output');

    }

    /**
     * @param \SplStack $stack
     * @return mixed|string
     * @throws \Exception
     */
    protected function run(\SplStack $stack)
    {

        while (!$stack->isEmpty()) {

            $parameter = $stack->pop();

            if ($parameter instanceof Operator) {

                $value = $parameter->operate($stack);

                if (!is_null($value)) {
                    $stack->push(TerminalExpression::factory($value));
                }

            }
            else {
                break;
            }

        }

        if (isset($parameter)) {
            if ($parameter) {
                return $parameter->getStorage();
            }
            else {
                return $this->render($stack);
            }
        }

        throw new \RuntimeException;

    }

    /**
     * @param $string
     * @return \SplStack
     * @throws \Exception
     */
    public function parse($string)
    {

        $tokens = $this->tokenize($string);

        $output = new \SplStack();
        $operators = new \SplStack();

        foreach ($tokens as $token) {

            $token = $this->extractVariables($token);
            $expression = TerminalExpression::factory($token);

            if ($expression instanceof Operator) {
                $this->parseOperator($expression, $output, $operators);
            }
            elseif ($expression instanceof Parenthesis) {
                $this->parseParenthesis($expression, $output, $operators);
            }
            else {
                $output->push($expression);
            }

        }

        while (!$operators->isEmpty()) {

            $operator = $operators->pop();

            if ($operator instanceof Parenthesis) {
                throw new \RuntimeException('Mismatched Parenthesis');
            }

            $output->push($operator);

        }

        return $output;

    }

    /**
     * @param $string
     * @return mixed
     */
    protected function tokenize($string)
    {
        $parts = preg_split('((\f+|\+|-|\(|\)|\*|\^|/)|\s+)', $string, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $parts = array_map('trim', $parts);
        return $parts;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {

        if (isset($this->variables[$name])) {
            return $this->variables[$name];
        }

        throw new \InvalidArgumentException($name);

    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    /**
     * @param $name
     * @param $value
     */
    public function registerVariable($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @param $token
     * @return int|mixed
     */
    protected function extractVariables($token)
    {

        if (!empty($token) &&
            !is_numeric($token) &&
            !in_array($token, array('+', '-', '*', '/', '^'))) {

            return $this->{$token};
        }

        return $token;

    }

}