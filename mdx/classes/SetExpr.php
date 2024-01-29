<?php

namespace classes;

class SetExpr implements ExpressionInterface
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

        if (count($this->expressions) <= 1) {
            return $str;
        }

        return "{{$str}}";
    }
}