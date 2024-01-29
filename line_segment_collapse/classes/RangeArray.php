<?php

namespace classes;

/**
 * Класс - массив отрезков
 */
class RangeArray
{
    public $originalArray;
    public $items = [];

    public function __construct($originalArray)
    {
        $this->originalArray = $originalArray;
        foreach ($this->originalArray as $item)
        {
            $range = new Range($item[0], $item[1]);
            $this->items[] = $range;
        }
    }

    public function __toArray()
    {
        $this->items = array_values($this->items);
        return array_map(function ($item) {
            return $item->toArray();
        }, $this->items);
    }

    /**
     * основная функция класса - схлапывание отрезков
     *
     * @return array
     */
    public function collapse(): array
    {
        foreach ($this->items as $key => $range)
        {
            $this->compare($key, $range);
        }

        return $this->__toArray();
    }

    /**
     * Сравнивает входящий отрезок со всеми остальными
     * если он схлопывается - вызывает сама себя ещё раз, но уже с новым отрезком для проверки возможности схлопывания с другими
     * @param int $originalKey
     * @param Range $range
     * @return void
     */
    private function compare(int $originalKey, Range $range) {
        $attachedKey = -1;

        /** @var Range $rangeItem */
        foreach ($this->items as $key => $rangeItem) {
            if ($originalKey === $key || empty($this->items[$key])) {
                continue;
            }

            if ($rangeItem->isHave($range)) {
//                print_r("isHave $originalKey:{$range}, $key:{$rangeItem}\n");
                unset($this->items[$originalKey]);
                break;
            } elseif ($rangeItem->isIncluded($range)) {
//                print_r("isInclude $originalKey:{$range}, $key:{$rangeItem}\n");
                unset($this->items[$key]);
                break;
            } elseif ($rangeItem->isImposedLeft($range)) {
//                print_r("isImposedLeft $originalKey:{$range}, $key:{$rangeItem}\n");
                $attachedKey = $originalKey;
                $this->items[$originalKey] = new Range($range->x1, $rangeItem->x2);
                unset($this->items[$key]);
                break;
            } elseif ($rangeItem->isImposedRight($range)) {
//                print_r("isImposedRight $originalKey:{$range}, $key:{$rangeItem}\n");
                $attachedKey = $originalKey;
                $this->items[$originalKey] = new Range($rangeItem->x1, $range->x2);
                unset($this->items[$key]);
                break;
            }
        }

        if ($attachedKey !== -1) {
            $attachedRange = $this->items[$attachedKey];
            $this->compare($attachedKey, $attachedRange);
        }
    }
}