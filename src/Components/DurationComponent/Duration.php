<?php

namespace App\Components\DurationComponent;

class Duration
{
    /**
     * convert minute to second
     * @return string
     */
    public static function toSecond(string $time): ?string
    {
        list($minute, $second) = explode(':', $time);
        return $minute * 60 + $second;
    }
}