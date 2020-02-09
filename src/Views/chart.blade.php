<div id="{{ $chartId }}"></div>

<script type="text/javascript">
    function withWidth(obj, width = null) {
        if (width) {
            return Object.assign(obj, {width});
        }

        return obj;
    }

    const props = withWidth({
        elements: {!! json_encode($elements) !!},
        data: {!! json_encode($data) !!},
        height: {{ $height }},
        rotateXAxis: {{ json_encode($rotateXAxis) }},
    }, {{ $width }});

    const chart = window.laravelRecharts.{{ $chartComponent }};

    const container = document.getElementById('{{ $chartId }}');
    const Component = window.laravelRecharts.React.createElement(chart, props);

    window.laravelRecharts.ReactDOM.render(Component, container);
</script>
