<?php
/**
 * Created by tanlin
 * Email: jokertanlin@didichuxing.com
 * Date: 2018/7/4
 * Time: 上午11:49
 */
include_once './SnowFlake.php';
$config = include_once './config.php';

$snowFlake = new SnowFlake($config);

// 默认使用0作为初始序列
$id1 = $snowFlake->getId();
var_dump($id1);

// 序列号自增
$id2 = $snowFlake->getId();
var_dump($id2);

// 指定序列号
$id3 = $snowFlake->getId(5);
var_dump($id3);