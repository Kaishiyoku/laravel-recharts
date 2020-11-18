<div id="{{ $chartId }}"></div>

<script type="text/javascript">
    function withWidth{{ $chartSuffix }}(obj, width = null) {
        if (width) {
            return Object.assign(obj, {width});
        }

        return obj;
    }

    const props{{ $chartSuffix }} = withWidth{{ $chartSuffix }}({
        elements: {!! json_encode($elements) !!},
        data: {!! json_encode($data) !!},
        height: {{ $height }},
        rotateXAxis: {{ json_encode($rotateXAxis) }},
        isDarkModeEnabled: {{ json_encode($isDarkModeEnabled) }},
    }, {{ $width }});

    const chart{{ $chartSuffix }} = window.laravelRecharts.{{ $chartComponent }};

    const container{{ $chartSuffix }} = document.getElementById('{{ $chartId }}');
    const Component{{ $chartSuffix }} = window.laravelRecharts.React.createElement(chart{{ $chartSuffix }}, props{{ $chartSuffix }});

    window.laravelRecharts.ReactDOM.render(Component{{ $chartSuffix }}, container{{ $chartSuffix }});
</script>
