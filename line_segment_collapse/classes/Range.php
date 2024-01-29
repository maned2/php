<?php

namespace classes;

/**
 * класс - отрезок в одномерном пространстве
 */
class Range
{
    public $x1;
    public $x2;

    public function __construct(int $x1, int $x2)
    {
        if ($x2 < $x1) {
            $this->x1 = $x2;
            $this->x2 = $x1;
        } else {
            $this->x1 = $x1;
            $this->x2 = $x2;
        }
    }

    /**
     * проверяет вложен ли текущий отрезок ($this) в искомый ($range)
     * @param Range $range
     * @return bool
     */
    public function isIncluded(Range $range): bool
    {
        if ($this->x1 >= $range->x1 && $this->x2 <= $range->x2) {
            return true;
        }

        return false;
    }

    /**
     * Проверяет вложен ли искомый отрезок ($range) в текущий ($this)
     * @param Range $range
     * @return bool
     */
    public function isHave(Range $range): bool
    {
        if ($this->x1 <= $range->x1 && $this->x2 >= $range->x2) {
            return true;
        }

        return false;
    }

    /**
     * проверяет соприкасается или накладывается текущий отрезок с искомым слева
     * @param Range $range
     * @return bool
     */
    public function isImposedLeft(Range $range): bool
    {
        if ($this->x1 <= $range->x2 && $this->x1 > $range->x1) {
            return true;
        }

        return false;
    }

    /**
     * проверяет соприкасается или накладывается текущий отрезок с искомым справа
     * @param Range $range
     * @return bool
     */
    public function isImposedRight(Range $range): bool
    {
        if ($this->x2 >= $range->x1 && $this->x2 < $range->x2) {
            return true;
        }

        return false;
    }

    public function __toString()
    {
        return "[{$this->x1}, {$this->x2}]";
    }

    public function toArray()
    {
        return [$this->x1, $this->x2];
    }
}