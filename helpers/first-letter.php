<?php
declare(strict_types=1);

function firstLetter(string $word){
    return strtoupper(substr($word, 0, 1));
}