<?php

namespace App\Support\Utils\DateFormat;

final class DefaultDate
{
    final public static function dateFormat(string $date): string
    {
        return date('d-m-Y H:i:s', strtotime($date));
    }
}