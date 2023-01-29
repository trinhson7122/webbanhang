<?php

use Carbon\Carbon;

function printMoney(float $money): string
{
    return number_format($money, 0) . ' đ';
}

function arrSumCart($arr)
{
    if(isset($arr)){
        $sum = 0;
        foreach($arr as $item)
        {
            $sum += $item['price'] * $item['count'];
        }
        return $sum;
    }
    return 0;
}

function DateTimeForHuman($time){
    $dt = new Carbon($time);
    $dt->setLocale('vi');
    return $dt->diffForHumans(Carbon::now());
}

function getCountDiffInMonth($modelhasCreated_at, $diff = 0)
{
    $count = 0;
    $now = Carbon::now();
    foreach($modelhasCreated_at as $item)
    {
        $dt = new Carbon($item->created_at);
        if($dt->diffInMonths($now) == $diff){
            $count++;
        }
    }
    return $count;
}
function percent($num1, $num2)
{
    //dd($num2);
    if($num1 == 0) $num1 = 1;
    if($num2 == 0) $num2 = 1;
    $result = ($num1 / $num2) * 100 - 100;
    return number_format($result, '2');
}
function sumWithDateTime($models, $diff = 0, $property = 'id')
{
    $now = Carbon::now();
    $sum = 0;
    foreach($models as $item)
    {
        $dt = new Carbon($item->created_at);
        if($dt->diffInMonths($now) == $diff){
            $sum += $item->$property;
        }
    }
    return $sum;
}
?>