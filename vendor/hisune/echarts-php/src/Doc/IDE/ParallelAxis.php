<?php
/**
 * Created by Hisune EchartsPHP AutoGenerate.
 * @author: Hisune <hi@hisune.com>
 */

namespace Hisune\EchartsPHP\Doc\IDE;

use Hisune\EchartsPHP\Property;

/**
 * @property int $dim
 *    坐标轴的维度序号。
 *     例如 series-parallel.data 中有如下数据：
 *     [
 *         [1,  55,  9,   56,  0.46,  18,  6,  良],
 *         [2,  25,  11,  21,  0.65,  34,  9,  优],
 *         [3,  56,  7,   63,  0.3,   14,  5,  良],
 *         [4,  33,  7,   29,  0.33,  16,  6,  优],
 *         { // 数据项也可以是 Object，从而里面能含有对线条的特殊设置。
 *             value: [5,  42,  24,  44,  0.76,  40,  16, 优]
 *             lineStyle: {...},
 *         }
 *         ...
 *     ]
 *     
 *     数据中，每一行是一个『数据项』，每一列属于一个『维度』。（例如上面数据每一列的含义分别是：『日期』,『AQI指数』, 『PM2.5』, 『PM10』, 『一氧化碳值』, 『二氧化氮值』, 『二氧化硫值』）。
 *     dim 定义了数据的哪个维度（即哪个『列』）会对应到此坐标轴上。
 *     从 0 开始计数。例如，假设坐标轴的 dim 为 1，则表示数据中的第二列会对应到此坐标轴上。
 *
 * @property int $parallelIndex Default: 0
 *    用于定义『坐标轴』对应到哪个『坐标系』中。
 *     比如有如下配置：
 *     myChart.setOption({
 *         parallel: [
 *             {...},                      // 第一个平行坐标系
 *             {...}                       // 第二个平行坐标系
 *         ],
 *         parallelAxis: [
 *             {parallelIndex: 1, ...},    // 第一个坐标轴，对应到第二个平行坐标系
 *             {parallelIndex: 0, ...},    // 第二个坐标轴，对应到第一个平行坐标系
 *             {parallelIndex: 1, ...},    // 第三个坐标轴，对应到第二个平行坐标系
 *             {parallelIndex: 0, ...}     // 第四个坐标轴，对应到第一个平行坐标系
 *         ],
 *         ...
 *     });
 *     
 *     只有一个平行坐标系时可不用设置，自动取默认值 0。
 *
 * @property boolean $realtime Default: true
 *    是否坐标轴刷选的时候，实时刷新视图。如果设为 false，则在刷选动作结束时候，才刷新视图。
 *     大数据量时，建议设置成 false，从而避免卡顿。
 *
 * @property ParallelAxis\AreaSelectStyle $areaSelectStyle
 *    在坐标轴上可以进行框选，这里是一些框选的设置。
 *
 * @property string $type Default: 'value'
 *    坐标轴类型。
 *     可选：
 *     
 *     value
 *       数值轴，适用于连续数据。
 *     
 *     category
 *       类目轴，适用于离散的类目数据，为该类型时必须通过 data 设置类目数据。
 *     
 *     time
 *       时间轴，适用于连续的时序数据，与数值轴相比时间轴带有时间的格式化，在刻度计算上也有所不同，例如会根据跨度的范围来决定使用月，星期，日还是小时范围的刻度。
 *     
 *     log
 *       对数轴。适用于对数数据。
 *
 * @property string $name
 *    坐标轴名称。
 *
 * @property string $nameLocation Default: 'end'
 *    坐标轴名称显示位置。
 *     可选：
 *     
 *     start
 *     middle
 *     end
 *
 * @property ParallelAxis\NameTextStyle $nameTextStyle
 *    坐标轴名称的文字样式。
 *
 * @property int $nameGap Default: 15
 *    坐标轴名称与轴线之间的距离。
 *
 * @property int $nameRotate
 *    坐标轴名字旋转，角度值。
 *
 * @property boolean $inverse Default: false
 *    是否是反向坐标轴。ECharts 3 中新加。
 *
 * @property boolean|array $boundaryGap
 *    坐标轴两边留白策略，类目轴和非类目轴的设置和表现不一样。
 *     类目轴中 boundaryGap 可以配置为 true 和 false。默认为 true，这时候刻度只是作为分隔线，标签和数据点都会在两个刻度之间的带(band)中间。
 *     非类目轴，包括时间，数值，对数轴，boundaryGap是一个两个值的数组，分别表示数据最小值和最大值的延伸范围，可以直接设置数值或者相对的百分比，在设置 min 和 max 后无效。
 *     示例：
 *     boundaryGap: [20%, 20%]
 *
 * @property int|string $min
 *    坐标轴刻度最小值。
 *     可以设置成特殊值 dataMin，此时取数据在该轴上的最小值作为最小刻度。
 *     不设置时会自动计算最小值保证坐标轴刻度的均匀分布。
 *     在类目轴中，也可以设置为类目的序数（如类目轴 data: [类A, 类B, 类C] 中，序数 2 表示 类C。也可以设置为负数，如 -3）。
 *
 * @property int|string $max
 *    坐标轴刻度最大值。
 *     可以设置成特殊值 dataMax，此时取数据在该轴上的最大值作为最大刻度。
 *     不设置时会自动计算最大值保证坐标轴刻度的均匀分布。
 *     在类目轴中，也可以设置为类目的序数（如类目轴 data: [类A, 类B, 类C] 中，序数 2 表示 类C。也可以设置为负数，如 -3）。
 *
 * @property boolean $scale Default: false
 *    只在数值轴中（type: value）有效。
 *     是否是脱离 0 值比例。设置成 true 后坐标刻度不会强制包含零刻度。在双数值轴的散点图中比较有用。
 *     在设置 min 和 max 之后该配置项无效。
 *
 * @property int $splitNumber Default: 5
 *    坐标轴的分割段数，需要注意的是这个分割段数只是个预估值，最后实际显示的段数会在这个基础上根据分割后坐标轴刻度显示的易读程度作调整。
 *     在类目轴中无效。
 *
 * @property int $minInterval Default: 0
 *    自动计算的坐标轴最小间隔大小。
 *     例如可以设置成1保证坐标轴分割刻度显示成整数。
 *     {
 *         minInterval: 1
 *     }
 *     
 *     只在数值轴中（type: value）有效。
 *
 * @property int $interval
 *    强制设置坐标轴分割间隔。
 *     因为 splitNumber 是预估的值，实际根据策略计算出来的刻度可能无法达到想要的效果，这时候可以使用 interval 配合 min、max 强制设定刻度划分，一般不建议使用。
 *     无法在类目轴中使用。在时间轴（type: time）中需要传时间戳，在对数轴（type: log）中需要传指数值。
 *
 * @property int $logBase Default: 10
 *    对数轴的底数，只在对数轴中（type: log）有效。
 *
 * @property boolean $silent Default: false
 *    坐标轴是否是静态无法交互。
 *
 * @property boolean $triggerEvent Default: false
 *    坐标轴的标签是否响应和触发鼠标事件，默认不响应。
 *     事件参数如下：
 *     {
 *         // 组件类型，xAxis, yAxis, radiusAxis, angleAxis
 *         // 对应组件类型都会有一个属性表示组件的 index，例如 xAxis 就是 xAxisIndex
 *         componentType: string,
 *         // 未格式化过的刻度值, 点击刻度标签有效
 *         value: ,
 *         // 坐标轴名称, 点击坐标轴名称有效
 *         name: 
 *     }
 *
 * @property ParallelAxis\AxisLine $axisLine
 *    坐标轴轴线相关设置。
 *
 * @property ParallelAxis\AxisTick $axisTick
 *    坐标轴刻度相关设置。
 *
 * @property ParallelAxis\AxisLabel $axisLabel
 *    坐标轴刻度标签的相关设置。
 *
 * @property array $data
 *    类目数据，在类目轴（type: category）中有效。
 *     示例：
 *     // 所有类目名称列表
 *     data: [周一, 周二, 周三, 周四, 周五, 周六, 周日]
 *     // 每一项也可以是具体的配置项，此时取配置项中的 `value` 为类目名
 *     data: [{
 *         value: 周一,
 *         // 突出周一
 *         textStyle: {
 *             fontSize: 20,
 *             color: red
 *         }
 *     }, 周二, 周三, 周四, 周五, 周六, 周日]
 *
 * {_more_}
 */
class ParallelAxis extends Property {}