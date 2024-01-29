<?php

namespace classes;

class TupleExpr implements ExpressionInterface
{
    private $expressions = [];

    /**
     * @param ExpressionInterface[] $expressions
     */
    public function __construct(array $expressions)
    {
        $this->expressions = $expressions;
    }

    public function __toString(): string
    {
        $str = join(', ', $this->expressions);
        return "({$str})";
    }
}