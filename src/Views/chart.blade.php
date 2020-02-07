<div id="{{ $chartId }}"></div>

<script type="text/javascript">
    const props = {
        elements: {!! json_encode($elements) !!},
        data: {!! json_encode($data) !!},
        height: {{ $height }},
        rotateXAxis: {{ json_encode($rotateXAxis) }},
    };

    const chart = window.laravelRecharts.{{ $chartComponent }};

    const container = document.getElementById('{{ $chartId }}');
    const Component = window.laravelRecharts.React.createElement(chart, props);

    window.laravelRecharts.ReactDOM.render(Component, container);
</script>
