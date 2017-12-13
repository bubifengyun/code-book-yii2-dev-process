<?php
/**
 * Created by Hisune EchartsPHP AutoGenerate.
 * @author: Hisune <hi@hisune.com>
 */

namespace Hisune\EchartsPHP\Doc\IDE\SingleAxis\Tooltip\AxisPointer;

use Hisune\EchartsPHP\Property;

/**
 * @property boolean $show Default: false
 *    是否显示文本标签。如果 tooltip.axisPointer.type 设置为 cross 则默认显示标签，否则默认不显示。
 *
 * @property int|string $precision Default: 'auto'
 *    文本标签中数值的小数点精度。默认根据当前轴的值自动判断。也可以指定如 2 表示保留两位小数。
 *
 * @property string|callable $formatter
 *    文本标签文字的格式化器。
 *     如果为 string，可以是例如：formatter: some text {value} some text，其中 {value} 会被自动替换为轴的值。
 *     如果为 function，可以是例如：
 *     参数：
 *     {Object} params: 含有：
 *     {Object} params.value: 轴当前值，如果 axis.type 为 category 时，其值为 axis.data 里的数值。如果 axis.type 为 time，其值为时间戳。
 *     {Array.&lt;Object&gt;} params.seriesData: 一个数组，是当前 axisPointer 最近的点的信息，每项内容为
 *     {
 *         componentType: series,
 *         // 系列类型
 *         seriesType: string,
 *         // 系列在传入的 option.series 中的 index
 *         seriesIndex: number,
 *         // 系列名称
 *         seriesName: string,
 *         // 数据名，类目名
 *         name: string,
 *         // 数据在传入的 data 数组中的 index
 *         dataIndex: number,
 *         // 传入的原始数据项
 *         data: Object,
 *         // 传入的数据值
 *         value: number|Array,
 *         // 数据图形的颜色
 *         color: string,
 *     
 *     }
 *     
 *     每项内容还包括轴的信息：
 *     {
 *         axisDim: x, // x, y, angle, radius, single
 *         axisId: xxx,
 *         axisName: xxx,
 *         axisIndex: 3,
 *         axisValue: 121, // 当前 axisPointer 对应的 value。
 *         axisValueLabel: 文本
 *     }
 *     
 *     返回值：
 *     显示的 string。
 *     例如：
 *     formatter: function (params) {
 *         // 假设此轴的 type 为 time。
 *         return some text + echarts.format.formatTime(params.value);
 *     }
 *
 * @property boolean $margin Default: '3'
 *    label 距离轴的距离。
 *
 * @property Label\TextStyle $textStyle
 *    
 *
 * @property string|array $padding Default: '[5, 7, 5, 7]'
 *    axisPointer内边距，单位px，默认各方向内边距为5，接受数组分别设定上右下左边距。
 *     使用示例：
 *     // 设置内边距为 5
 *     padding: 5
 *     // 设置上下的内边距为 5，左右的内边距为 10
 *     padding: [5, 10]
 *     // 分别设置四个方向的内边距
 *     padding: [
 *         5,  // 上
 *         10, // 右
 *         5,  // 下
 *         10, // 左
 *     ]
 *
 * @property string $backgroundColor Default: 'auto'
 *    文本标签的背景颜色，默认是和 axis.axisLine.lineStyle.color 相同。
 *
 * @property string $borderColor
 *    文本标签的边框颜色。
 *
 * @property string $borderWidth Default: '0'
 *    文本标签的边框宽度。
 *
 * @property int $shadowBlur Default: 3
 *    图形阴影的模糊大小。该属性配合 shadowColor,shadowOffsetX, shadowOffsetY 一起设置图形的阴影效果。
 *     示例：
 *     {
 *         shadowColor: rgba(0, 0, 0, 0.5),
 *         shadowBlur: 10
 *     }
 *
 * @property string $shadowColor Default: '#aaa'
 *    阴影颜色。支持的格式同color。
 *
 * @property int $shadowOffsetX Default: 0
 *    阴影水平方向上的偏移距离。
 *
 * @property int $shadowOffsetY Default: 0
 *    阴影垂直方向上的偏移距离。
 *
 * {_more_}
 */
class Label extends Property {}