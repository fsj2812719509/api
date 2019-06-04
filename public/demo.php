<?php
/**
 * Created by PhpStorm.
 * User: 圆圈儿
 * Date: 2019/5/30
 * Time: 7:57
 */
$noncestr = "fushijia";
$timestamp = time();
$token = "fushijia";

$arr = [$noncestr,$timestamp,$token];
sort($arr,SORT_STRING);
$ast = implode($arr);
$sig = sha1($ast);
echo $noncestr;
echo '</br>';
echo $timestamp;
echo '</br>';
echo $sig;
echo '</br>';

