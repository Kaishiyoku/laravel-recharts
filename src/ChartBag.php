<?php

namespace Kaishiyoku\LaravelRecharts;

use Illuminate\Contracts\View\View;

class ChartBag
{
    /**
     * @var string
     */
    private $assets;

    /**
     * @var \Illuminate\Contracts\View\View
     */
    private $chart;

    /**
     * @param string $assets
     * @param \Illuminate\Contracts\View\View $chart
     */
    public function __construct(string $assets, View $chart)
    {
        $this->assets = $assets;
        $this->chart = $chart;
    }

    /**
     * @return string
     */
    public function assets(): string
    {
        return $this->assets;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        return $this->chart;
    }
}
