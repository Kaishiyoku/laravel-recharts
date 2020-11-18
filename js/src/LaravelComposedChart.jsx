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
        gridColor: PropTypes.string,
    };

    static defaultProps = {
        rotateXAxis: false,
        gridColor: '#ddd',
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

        if (this.state.disabledElements.includes(chartItem.key)) {
            return null;
        }

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
        const color = this.state.disabledElements.includes(entry.id.trim()) ? '#999999' : 'inherit';

        return (
            <a onClick={() => this.handleToggleLegendClick(entry.id)} style={{color}}>
                {value}
            </a>
        );
    };

    getLegendPayload() {
        return this.props.elements.map(({key, type, color}) => {
            const legendTypeConverts = {
                bar: 'square',
            };

            const legendType = legendTypeConverts[type] || type;

            return {value: key, type: legendType, id: key, color};
        });
    }

    render() {
        return (
            <ResponsiveContainer width="100%" height={this.props.height}>
                <ComposedChart
                    data={this.props.data}
                    margin={{
                        top: 20, right: 20, bottom: 20, left: 20,
                    }}
                >
                    <CartesianGrid  stroke={this.props.gridColor}/>
                    {this.renderXAxis()}
                    <YAxis/>
                    <Tooltip/>

                    <Legend
                        verticalAlign="top"
                        formatter={this.legendFormatter}
                        payload={this.getLegendPayload()}
                    />

                    {this.renderChartItems()}
                </ComposedChart>
            </ResponsiveContainer>
        );
    }
}

export default LaravelComposedChart;
