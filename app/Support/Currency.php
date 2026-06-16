<?php

namespace App\Support;

class Currency
{
    public static function cop(int|float|string|null $amount): string
    {
        return '$ '.number_format((float) ($amount ?? 0), 0, ',', '.');
    }
}
