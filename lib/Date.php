<?php
declare(strict_types=1);

class Date
{
    static function format(?string $dateFormat, string $timestamp){
        $formattedDate = date($dateFormat, strtotime($timestamp));
        return $formattedDate;
    }
}