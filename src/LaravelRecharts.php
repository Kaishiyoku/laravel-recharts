<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

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
    public const TYPE_AREA = 'area';

    /**
     * @var string
     */
    private const CHART_COMPONENT_NORMAL = 'LaravelComposedChart';

    /**
     * @var string
     */
    private const CHART_COMPONENT_MINIMALISTIC = 'LaravelMinimalisticComposedChart';

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @param string|null $gridColor
     * @param string|null $tooltipBackgroundColor
     * @param bool $rotateXAxis
     * @return ChartBag
     * @throws \Exception
     */
    public function makeChart(array $elements, array $data, int $height, string $gridColor = '#ddd', string $tooltipBackgroundColor = '#fff', bool $rotateXAxis = false): ChartBag
    {
        return $this->makeChartAbstract(self::CHART_COMPONENT_NORMAL, $elements, $data, $height, null, $gridColor, $tooltipBackgroundColor, $rotateXAxis);
    }

    /**
     * @param array $elements
     * @param array $data
     * @param int $height
     * @param int $width
     * @return ChartBag
     * @throws \Exception
     */
    public function makeMinimalisticChart(array $elements, array $data, int $height, int $width = null): ChartBag
    {
        return $this->makeChartAbstract(self::CHART_COMPONENT_MINIMALISTIC, $elements, $data, $height, $width);
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
     * @param int|null $width
     * @param string|null $gridColor
     * @param string|null $tooltipBackgroundColor
     * @param bool $rotateXAxis
     * @return ChartBag
     * @throws \Exception
     */
    private function makeChartAbstract(string $chartComponent, array $elements, array $data, int $height, int $width = null, string $gridColor = null, string $tooltipBackgroundColor = null, bool $rotateXAxis = false): ChartBag
    {
        $chartId = $this->generateChartId();
        $chartSuffix = Str::camel($chartId);
        $cdn = View::make('recharts::cdn');
        $chart = View::make("recharts::chart", compact('chartId', 'chartSuffix', 'chartComponent', 'elements', 'data', 'height', 'width', 'gridColor', 'tooltipBackgroundColor', 'rotateXAxis'));

        $chartBag = new ChartBag($cdn, $chart);

        return $chartBag;
    }
}
