<script src="{{ asset('vendor/recharts/app.js') }}"></script>

<div id="{{ $chartId }}"></div>

<script type="text/javascript">
    const props = {
        elements: {!! json_encode($elements) !!},
        data: {!! json_encode($data) !!},
        height: {{ $height }},
    };

    const container = document.getElementById('{{ $chartId }}');
    const Component = window.laravelRecharts.React.createElement(window.laravelRecharts.LaravelComposedChart, props);

    window.laravelRecharts.ReactDOM.render(Component, container);
</script>
