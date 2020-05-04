<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/4/10
 * Time: 17:26
 */


$data=[];
function quickSort($num){
    if(!$num) return false;
    global $data;
    $data = $num;
    $left = 0;;
    $right = count($data)-1;
    $pointer = [];
    array_push($pointer,$left,$right);
    while (! empty($pointer)){
        //先弹出left, right
        $right = array_pop($pointer);     //取数组最后一个元素
        $left    = array_pop($pointer);
        $pivot  = getPivot($left, $right);
        //先压入$left, 在压入$right
        if($left < $pivot - 1) array_push($pointer, $left, $pivot - 1);
        if($pivot + 1 < $right) array_push($pointer, $pivot + 1, $right);
    }
    return $data;

}

function getPivot($left,$right){
    global $data;
    $pivot = $data[$left];
    while ($left < $right){
        while ($left < $right && $data[$right] >= $pivot) $right--;
        $data[$left] = $data[$right];
        while ($left < $right && $data[$left] <= $pivot) $left++;
        $data[$right] = $data[$left];
    }
    //当$left = $right
    $data[$left] = $pivot;             //把中间数添加到$low结束的位置
    return $left;

}

var_dump(quickSort([2, 5, 6, 12, 1]));