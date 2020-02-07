<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;

class LaravelRecharts
{
    /**
     * @var string
     */
    public const TYPE_LINE = 'line';

    /**
     * @var string
     */
    public const TYPE_BAR = 'bar';

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function makeChart(array $elements, array $data, int $height): \Illuminate\Contracts\View\View
    {
        $chartId = 'laravel-rechart-' . Uuid::uuid4()->toString();

        return View::make('recharts::chart', compact('chartId', 'elements', 'data', 'height'));
    }

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function makeMinimalChart(array $elements, array $data, int $height): \Illuminate\Contracts\View\View
    {
        $chartId = 'laravel-rechart-' . Uuid::uuid4()->toString();

        return View::make('recharts::minimal_chart', compact('chartId', 'elements', 'data', 'height'));
    }

    /**
     * @param string $key
     * @param string $type
     * @param string $color
     * @return array
     */
    public static function element(string $key, string $type, string $color): array
    {
        return [
            'key' => $key,
            'type' => $type,
            'color' => $color,
        ];
    }

    /**
     * @param string $name
     * @param array $values
     * @return array
     */
    public static function dataEntry(string $name, array $values): array
    {
        return array_merge([
            'name' => $name,
        ], $values);
    }
}
