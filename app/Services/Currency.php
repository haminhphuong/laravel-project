<?php

namespace App\Services;
use NumberFormatter;

class Currency
{
    public function getPrice($price): bool|string
    {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return  $formatter->formatCurrency($price, config('app.currency'));
    }
}
