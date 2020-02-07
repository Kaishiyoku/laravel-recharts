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
     * @var string
     */
    private const CHART_COMPONENT_NORMAL = 'LaravelComposedChart';

    /**
     * @var string
     */
    private const CHART_COMPONENT_MINIMAL = 'LaravelComposedChart';

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @return ChartBag
     * @throws \Exception
     */
    public function makeChart(array $elements, array $data, int $height): ChartBag
    {
        return $this->makeChartAbstract(self::CHART_COMPONENT_NORMAL, $elements, $data, $height);
    }

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @return ChartBag
     * @throws \Exception
     */
    public function makeMinimalChart(array $elements, array $data, int $height): ChartBag
    {
        return $this->makeChartAbstract(self::CHART_COMPONENT_MINIMAL, $elements, $data, $height);
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

    /**
     * @return string
     * @throws \Exception
     */
    private function generateChartId(): string
    {
        return 'laravel-rechart-' . Uuid::uuid4()->toString();
    }

    /**
     * @param string $chartComponent
     * @param array $elements
     * @param array $data
     * @param int $height
     * @return ChartBag
     * @throws \Exception
     */
    private function makeChartAbstract(string $chartComponent, array $elements, array $data, int $height): ChartBag
    {
        $chartId = $this->generateChartId();
        $cdn = View::make('recharts::cdn');
        $chart = View::make("recharts::chart", compact('chartId', 'chartComponent', 'elements', 'data', 'height'));

        $chartBag = new ChartBag($cdn, $chart);

        return $chartBag;
    }
}
