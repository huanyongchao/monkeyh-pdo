<?php
/** Q
 * @param $str
 */
//1、形如 “12321”, “789987”, “上海自来水来自海上” 的字符串称为“回文”，请写一个尽可能高效/高可维护的函数来判断输入的数字是否为回文；
//
//2、Excel 的行计数为数字（左侧纵列，1、2、3、4 标记第 1、2、3、4 行），列计数为字母（表格区域上方横列，A、B、C、D 代表第 1、2、3、4 列，AA、AB 代表第 27、28 列等）。请写一个函数，输入为数字 n（取值范围 1 - PHP_INT_MAX），输出为代表那一列的字母字符串（既 1 → A，2 → B，12 → L，27 → AA，123 → DS，1234 → AUL，12345 → RFU，...）；
//
//3、用户表示打开我们的网页很卡，你觉得会有哪些环节可能存在问题，如何解决？（环境：微信中打开使用 Vue 构建的单页应用，后端使用 PHP 做服务）；
//
//4、假定已经拥有了一段时间内上海市境内的外卖订单数据（包含店铺，收货坐标信息），如何能够查询给定坐标的预估月销量？
//
//（例如：采取的估算方式为，最近 1 个月内给定坐标半径 3 公里的订单量，可自行设定）
//
//请给出你能想到的最优的数据结构设计，数据预处理流程和查询流程

//====1.start_time 11:05======
function checkTest($str){
    $len = strlen($str);
    for($i=0;$i<$len;$i++) {
        if($str[$i] == $str[$len-$i-1]) {
            if(2*$i+2 >= $len) {
                echo 'is return';
            }
        } else {
            echo "is not return";
        }
    }
}

$str = '111123321111';
//checkTest($str);
//====end_time 11:09======

//====2.start_time 11:30======
function changeNumToStr($num = 0){

    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $arr_tmp = [];

    while($num > 26) {

        $step = $num % 26;
        $arr_tmp[] = $step;
        $num = $num/26;

    }

    $arr_tmp[] = (int)floor($num);
    $arr_tmp = array_reverse($arr_tmp);
    $res_str = '';
    foreach ($arr_tmp as $str_key) {
        $res_str .= $str[$str_key-1];
    }
    return $res_str;
}

changeNumToStr(12345);



//====3 start_time 12:00======
//1.页面文件过大，比如图片、视频等动态资源加载过慢，使用cdn加速
//2.接口数据均为同步，API接口获取数据过慢导致页面渲染过慢，慢日志排查API接口，逐步优化代码
//3.并发量比较大，根据日志追踪问题，逐一排查。1.增加缓存、缓解数据库压力。2.部署分布式服务
//4.排查mysql问题，检查索引，数据量过大的话结合业务内容优化（合理增加索引，优化字段，分表分库等）
//5.静默数据客户端本地数据存储缓存等

//====4 start_time 12:20======
