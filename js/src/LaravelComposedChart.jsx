import React, {PureComponent} from 'react';
import {CartesianGrid, ComposedChart, Legend, Line, Bar, Area, ResponsiveContainer, Tooltip, XAxis, YAxis} from 'recharts';
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

    renderLines() {
        return this.props.elements.map((chartItem) => {
            const components = {
                line: Line,
                bar: Bar,
                area: Area,
            };

            const Component = components[chartItem.type];

            return (
                <Component
                    type="monotone"
                    dataKey={chartItem.key}
                    key={chartItem.key}
                    maxBarSize={25}
                    fill={chartItem.color}
                    stroke={chartItem.color}
                    strokeWidth={2}
                />
            );
        });
    }

    renderXAxis() {
        return this.props.rotateXAxis ? (
            <XAxis dataKey="name" angle={-45} textAnchor="end" height={50} style={{fontSize: '.85rem'}}/>
        ) : (
            <XAxis dataKey="name" style={{fontSize: '.85rem'}}/>
        );
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
                    <CartesianGrid stroke="#ddd"/>
                    {this.renderXAxis()}
                    <YAxis/>
                    <Tooltip/>
                    <Legend verticalAlign="top"/>

                    {this.renderLines()}
                </ComposedChart>
            </ResponsiveContainer>
        );
    }
}

export default LaravelComposedChart;
