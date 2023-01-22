<?php
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
?>