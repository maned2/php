<?php

namespace classes;

class DefaultExpr implements ExpressionInterface
{
    private $columns;
    private $element;

    public function __construct(array $columns, ?string $element = null)
    {

        $this->columns = $columns;
        $this->element = $element;
    }

    public function __toString():string
    {
        $str = '';
        foreach ($this->columns as $key => $column) {
            $str .= "[{$column}]";
            if ($key !== count($this->columns) -1) {
                $str .= '.';
            }
        }

        if ($this->element) {
            $str .= ".&[{$this->element}]";
        }
        return $str;
    }
}