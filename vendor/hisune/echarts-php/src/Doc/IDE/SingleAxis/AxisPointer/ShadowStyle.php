<?php
/**
 * Created by Hisune EchartsPHP AutoGenerate.
 * @author: Hisune <hi@hisune.com>
 */

namespace Hisune\EchartsPHP\Doc\IDE\SingleAxis\AxisPointer;

use Hisune\EchartsPHP\Property;

/**
 * @property string $color Default: 'rgba(150,150,150,0.3)'
 *    填充的颜色。
 *     
 *     颜色可以使用 RGB 表示，比如 rgb(128, 128, 128)，如果想要加上 alpha 通道表示不透明度，可以使用 RGBA，比如 rgba(128, 128, 128, 0.5)，也可以使用十六进制格式，比如 #ccc。除了纯色之外颜色也支持渐变色和纹理填充
 *     // 线性渐变，前四个参数分别是 x0, y0, x2, y2, 范围从 0 - 1，相当于在图形包围盒中的百分比，如果最后一个参数传 `true`，则该四个值是绝对的像素位置
 *     color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
 *       offset: 0, color: red // 0% 处的颜色
 *     }, {
 *       offset: 1, color: blue // 100% 处的颜色
 *     }], false)
 *     // 径向渐变，前三个参数分别是圆心 x, y 和半径，取值同线性渐变
 *     color: new echarts.graphic.RadialGradient(0.5, 0.5, 0.5, [...], false)
 *     // 纹理填充
 *     color: new echarts.graphic.Pattern(
 *       imageDom, // 支持为 HTMLImageElement, HTMLCanvasElement，不支持路径字符串
 *       repeat // 是否平铺, 可以是 repeat-x, repeat-y, no-repeat
 *     )
 *
 * @property int $shadowBlur
 *    图形阴影的模糊大小。该属性配合 shadowColor,shadowOffsetX, shadowOffsetY 一起设置图形的阴影效果。
 *     示例：
 *     {
 *         shadowColor: rgba(0, 0, 0, 0.5),
 *         shadowBlur: 10
 *     }
 *
 * @property string $shadowColor
 *    阴影颜色。支持的格式同color。
 *
 * @property int $shadowOffsetX Default: 0
 *    阴影水平方向上的偏移距离。
 *
 * @property int $shadowOffsetY Default: 0
 *    阴影垂直方向上的偏移距离。
 *
 * @property int $opacity
 *    图形透明度。支持从 0 到 1 的数字，为 0 时不绘制该图形。
 *
 * {_more_}
 */
class ShadowStyle extends Property {}