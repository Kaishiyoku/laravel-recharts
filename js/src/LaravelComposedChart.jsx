import React, {PureComponent} from 'react';
import {
    Area,
    Bar,
    CartesianGrid,
    ComposedChart,
    Legend,
    Line,
    ResponsiveContainer,
    Tooltip,
    XAxis,
    YAxis
} from 'recharts';
import PropTypes from 'prop-types';

class LaravelComposedChart extends PureComponent {
    static propTypes = {
        elements: PropTypes.arrayOf(
            PropTypes.exact({
                key: PropTypes.string.isRequired,
                type: PropTypes.oneOf(['line', 'bar']).isRequired,
                color: PropTypes.string.isRequired,
            })
        ).isRequired,
        data: PropTypes.arrayOf(
            PropTypes.shape({
                name: PropTypes.string,
            })
        ).isRequired,
        height: PropTypes.number.isRequired,
        rotateXAxis: PropTypes.bool,
    };

    static defaultProps = {
        rotateXAxis: false,
    };

    state = {
        disabledElements: [],
    };

    handleToggleLegendClick = (key) => {
        const normalizedKey = key.trim();

        const disabledElements = this.state.disabledElements.includes(normalizedKey)
            ? this.state.disabledElements.filter((line) => line !== normalizedKey)
            : this.state.disabledElements.concat([normalizedKey]);

        this.setState({disabledElements});
    };

    renderChartItems() {
        return this.props.elements.map(this.renderChartItem);
    }

    renderChartItem = (chartItem) => {
        const {color, key} = chartItem;

        const dataKey = this.state.disabledElements.includes(chartItem.key) ? `${chartItem.key} ` : chartItem.key;

        const components = {
            line: Line,
            bar: Bar,
            area: Area,
        };

        const Component = components[chartItem.type];

        return (
            <Component
                type="monotone"
                dataKey={dataKey}
                key={key}
                maxBarSize={25}
                fill={color}
                stroke={color}
                strokeWidth={2}
            />
        );
    };

    renderXAxis() {
        return this.props.rotateXAxis ? (
            <XAxis dataKey="name" angle={-45} textAnchor="end" height={50} style={{fontSize: '.85rem'}}/>
        ) : (
            <XAxis dataKey="name" style={{fontSize: '.85rem'}}/>
        );
    }

    legendFormatter = (value, entry, index) => {
        const color = this.state.disabledElements.includes(entry.dataKey.trim()) ? '#999999' : 'inherit';

        return (
            <a onClick={() => this.handleToggleLegendClick(entry.dataKey)} style={{color}}>
                {value}
            </a>
        );
    };

    render() {
        const legendPayload = this.props.elements.map((element) => {
            const {key, color} = element;

            return {key, color};
        });

        return (
            <ResponsiveContainer width="100%" height={this.props.height}>
                <ComposedChart
                    data={this.props.data}
                    margin={{
                        top: 20, right: 20, bottom: 20, left: 20,
                    }}
                >
                    <CartesianGrid stroke="#ddd"/>
                    {this.renderXAxis()}
                    <YAxis/>
                    <Tooltip/>

                    <Legend
                        verticalAlign="top"

                        formatter={this.legendFormatter}
                    />

                    {this.renderChartItems()}
                </ComposedChart>
            </ResponsiveContainer>
        );
    }
}

export default LaravelComposedChart;
