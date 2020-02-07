<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;

class LaravelRecharts
{
    public function makeChart(array $elements, array $data, int $height)
    {
        $chartId = 'laravel-rechart-' . Uuid::uuid4();

        return View::make('recharts::chart', compact('chartId', 'elements', 'data', 'height'));
    }
}
