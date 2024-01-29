<?php

namespace classes;

class MdxQuery implements ExpressionInterface
{
    private $columns;
    private $rows;
    private $from;
    private $with;

    /**
     * @param mixed $value
     * @return $this
     */
    public function from($value): self
    {
        $this->from = $value;
        return $this;
    }

    /**
     * @param $expression
     * @return $this
     */
    public function columns($expression): self
    {
        $this->columns = $expression;
        return $this;
    }

    public function rows(ExpressionInterface $expression): self
    {
        $this->rows = $expression;
        return $this;
    }

    public function with(string $value): self
    {
        $this->with = $value;
        return $this;
    }


    private function getColumnsString(): string
    {
        return "{$this->columns} ON COLUMNS";
    }

    private function getRowsString(): string
    {
        return "{$this->rows} ON ROWS";
    }

    private function getFromString(): string
    {
        if ($this->from instanceof ExpressionInterface) {
            $str = "(
    {$this->from}
    )";
        } else {
            $str = "{$this->from}";
        }
        return "FROM {$str}";
    }

    public function __toString(): string
    {
        $str = '';

        if ($this->with) {
            $str .= "WITH {$this->with}
";
        }
        $comma = ($this->rows !== null) ? "," : "";
        $str .= "SELECT
    {$this->getColumnsString()}{$comma}
";

        if ($this->rows !== null) {
            $str .= "    {$this->getRowsString()}
";
        }

        $str .= "{$this->getFromString()}";

        return $str;

//        if ($this->rows === null) {
//            return "SELECT
//    {$this->getColumnsString()}
//{$this->getFromString()}";
//        } else {
//            return "SELECT
//    {$this->getColumnsString()},
//    {$this->getRowsString()}
//{$this->getFromString()}";
//        }
    }

    public function getRawQuery(): string
    {
        return $this->__toString();
    }
}