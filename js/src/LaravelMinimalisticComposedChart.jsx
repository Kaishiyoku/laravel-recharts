import React, {PureComponent} from 'react';
import {Bar, ComposedChart, Line, ResponsiveContainer} from 'recharts';
import PropTypes from 'prop-types';

class LaravelMinimalisticComposedChart extends PureComponent {
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
        width: PropTypes.number,
    };

    static defaultProps = {
        width: '100%',
    };

    renderLines() {
        return this.props.elements.map((chartItem) => {
            const components = {
                line: Line,
                bar: Bar,
            };

            const Component = components[chartItem.type];

            return <Component type="monotone" dataKey={chartItem.key} key={chartItem.key} maxBarSize={25} fill={chartItem.color} stroke={chartItem.color}/>
        });
    }

    render() {
        return (
            <ResponsiveContainer width={this.props.width} height={this.props.height}>
                <ComposedChart
                    data={this.props.data}
                    margin={{
                        top: 20, right: 20, bottom: 20, left: 20,
                    }}
                >
                    {this.renderLines()}
                </ComposedChart>
            </ResponsiveContainer>
        );
    }
}

export default LaravelMinimalisticComposedChart;
