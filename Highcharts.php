<?php
/**
 * Created by liuyang.
 * User: liuyang
 * Date: 13-5-16
 * Time: 下午5:07
 * 需要加载一些js,例如Jquery,highcharts
 */

class Highcharts{
    /**
     * 带导航条的时间图表
     * @param $array
     * @param $title
     * @param $message
     * @param $id_div
     * @return string
     */
    public function baselinebar($array, $title, $message,$id_div)
    {
        $ret = $this->makedata($array); //数据的制作
        $color = $this->color(); // 显示的颜色
        $tooltip = $this->tooltip(); // 具体不详

        $str = "";
        $str .= "<script type='text/javascript'>";
        $str .= "$(function() {
       $('#".$id_div."').highcharts('StockChart', {
            rangeSelector : {
                selected : 1
            },
            title : {
                text : '" . $title . "'
            },
            series : [{
                name : '" . $message . "',
                data : [" . $ret . "],
                type : 'area',
                threshold : null,
                tooltip : {
                    ".$tooltip."
                },
                fillColor : {
                    ".$color."
                }]
            })
       });";
        $str .= "</script>";
        return $str;
    }

    /**
     * 数据的制作
     * @param $array
     * @return string
     */
    private function makedata($array){
        $x_time = array_keys($array);
        $y_count = array_values($array);
        $ret = '';
        foreach ($x_time as $k => $v) {
            $ret .= '[' . $v . ',' . $y_count[$k] . '],';
        }
        $ret = substr($ret, 0, -1);
        return $ret;
    }

    private function tooltip( $num =null ){
        $num = isset($tooltip) ?$tooltip:2;
        $tooltip = 'valueDecimals : '.$num;
        return $tooltip;
    }


    /**
     * 颜色
     * @return string
     */
    private function color (){
        $color = "linearGradient : {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1
        },
            stops : [[0, Highcharts.getOptions().colors[0]], [1, 'rgba(0,0,0,0)']]
        }";
        return $color;
    }

}
