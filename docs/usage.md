# Usage

In your controller class:

```php
public function index()
{
    $laravelRecharts = new LaravelRecharts();
    
    $elements = [
        LaravelRecharts::element('User registrations', LaravelRecharts::TYPE_BAR, 'rgba(7, 192, 224, .5)'),
        LaravelRecharts::element('User posts', LaravelRecharts::TYPE_LINE, 'rgba(203, 78, 222, .5)'),
    ];
    $data = [
        [
            'name' => '2020/02/05',
            'User registrations' => 7,
            'User posts' => 4,
        ],
        [
            'name' => '2020/02/06',
            'User registrations' => 3,
            'User posts' => 5,
        ],
        [
            'name' => '2020/02/07',
            'User registrations' => 2,
            'User posts' => 2,
        ],
        [
            'name' => '2020/02/08',
            'User registrations' => 3,
            'User posts' => 5,
        ],
    ];
    $height = 300;
    
    $sampleChart = $laravelRecharts->makeChart($elements, $data, $height);

    return view('home', ['sampleChart' => $sampleChart]);
}
```

In your Blade template:

```php
{!! $sampleChart->assets() !!}
{!! $sampleChart->render() !!}
```

The assets call is needed to load the required JavaScript into the template.
Keep in mind that this is a bundled JavaScript file with all needed dependencies, including a version of React.
The bundle is large but the advantage here is that you still can use your React version you want while the
Laravel Recharts package will render properly with its own version while not interfering with your bundle.
This is possible because the React dependency is being injected into the `window.laravelRecharts` object.

<div id="sample-chart"></div>

## Minmalistic chart

There is also the ability to create a minimalistic chart without axis and cartesian grid.
This is useful if you want to render a chart inside text.

Just use the `$laravelRecharts->makeMinimalisticChart()` method.

<div id="sample-minimalistic-chart"></div>

<script type="text/javascript">
    const props = {
        elements: [
            {
                key: 'User registrations',
                type: 'bar',
                color: 'rgba(7, 192, 224, .5)',
            },
            {
                key: 'User posts',
                type: 'line',
                color: 'rgba(203, 78, 222, .5)',            
            },
        ],
        data: [
            {
                'name': '2020/02/05',
                'User registrations': 7,
                'User posts': 4,
            },
            {            
                'name': '2020/02/06',
                'User registrations': 3,
                'User posts': 5,
            },
            {
                'name': '2020/02/07',
                'User registrations': 2,
                'User posts': 2,
            },
            {
                'name': '2020/02/08',
                'User registrations': 3,
                'User posts': 5,
            },
        ],
        height: 300,
        rotateXAxis: false,
    };

    const chart = window.laravelRecharts.LaravelComposedChart;

    const container = document.getElementById('sample-chart');
    const Component = window.laravelRecharts.React.createElement(chart, props);

    window.laravelRecharts.ReactDOM.render(Component, container);
    
    const minimalisticChart = window.laravelRecharts.LaravelMinimalisticComposedChart;
    const minimalisticContainer = document.getElementById('sample-minimalistic-chart');
    const minimalisticElements = {
        elements: [
            {
                key: 'User registrations',
                type: 'bar',
                color: 'rgba(7, 192, 224, .5)',
            },
            {
                key: 'User posts',
                type: 'area',
                color: 'rgba(203, 78, 222, .5)',            
            },
        ],
    };
    const minimalisticProps = Object.assign({}, props, minimalisticElements, {height: 100, width: 200});
    const MinimalisticComponent = window.laravelRecharts.React.createElement(minimalisticChart, minimalisticProps);
    
    window.laravelRecharts.ReactDOM.render(MinimalisticComponent, minimalisticContainer);
</script>
