<?php

namespace classes;

class RangeExpr implements ExpressionInterface
{
    private $expressions = [];

    /**
     * @param ExpressionInterface[] $expressions
     * @throws \Exception
     */
    public function __construct(array $expressions)
    {
        if (count($expressions) > 2) {
            throw new \Exception('Range can only take 2 expressions');
        }
        $this->expressions = $expressions;
    }

    public function __toString(): string
    {
        $str = join(':', $this->expressions);
        return "{{$str}}";
    }
}