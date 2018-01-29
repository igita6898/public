<?php
/**
 * Created by Igita Huang.
 * Author: Igita Huang <igita@qq.com>
 * Date: 2018/1/25 16:47
 */

include "LuckMoney.php";
echo "<pre>";
$L = new LuckMoney(100,100);
print_r($L->getMaxLuckMoney());

echo "</pre>";
echo rand(0,1);
die();
echo sprintf("%.2f",rand(1,99)/100);

echo "<hr>";
echo "<br>";
$start = time() + microtime(true);
for($i=0;$i<999999;$i++){
    $s = rand(1,99)/100;
}
$end = time() + microtime(true);

echo $end - $start;

echo "<hr>";
echo "<br>";


$start = time() + microtime(true);
for($i=0;$i<999999;$i++){
    $s = mt_rand()/mt_getrandmax();
}
$end = time() + microtime(true);

echo $end - $start;

echo "<hr>";
echo "<br>";