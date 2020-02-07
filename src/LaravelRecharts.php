<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Support\Facades\View;

class LaravelRecharts
{
    public function makeLineChart()
    {
        return View::make('recharts::line_chart');
    }
}
