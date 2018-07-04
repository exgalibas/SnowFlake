<?php
/**
 * Created by tanlin
 * Email: jokertanlin@didichuxing.com
 * Date: 2018/7/3
 * Time: 下午2:43
 */

class SnowFlake
{
    // 机器位数
    private $totalBit;

    // 时间戳位数
    private $timeBit;

    // 序列号位数
    private $sequenceBit;

    // 起始时间戳
    private $startTime;

    // 自定义段位数
    private $segment;

    // 起始序号
    private $startSequence;

    public function __construct($config)
    {
        $this->init($config);
        if (!$this->check()) {
            throw new Exception('check failed');
        }
    }

    public function init($config)
    {
        $this->totalBit = intval($config['totalBit']);
        $this->timeBit = intval($config['timeBit']);
        $this->sequenceBit = intval($config['sequenceBit']);
        $this->startTime = intval($config['startTime']);
        $this->segment = $config['segment'];
    }

    public function check()
    {
        return $this->checkEmpty() && $this->checkBit() && $this->checkTime();
    }

    public function checkBit()
    {
        $incrBit = $this->timeBit + $this->sequenceBit;
        foreach ($this->segment as $segment) {
            $incrBit += $segment[0];
        }
        if ($incrBit > ($this->totalBit - 1)) {
            return false;
        }

        return true;
    }

    public function checkEmpty()
    {
        if ($this->totalBit &&
            $this->timeBit  &&
            $this->sequenceBit &&
            $this->startTime &&
            $this->startSequence >= 0) {
            return true;
        }

        return false;
    }

    public function checkTime()
    {
        return $this->startTime <= time() && time() <= ~(-1 << $this->timeBit);
    }

    public function getId($startSequence = -1)
    {
        if ($startSequence >= 0) {
            $this->startSequence = $startSequence;
        }

        $now = time();
        $sequenceMask = ~(-1 << $this->sequenceBit);
        $id = ($this->startSequence + 1) & $sequenceMask;
        $this->startSequence = $id;
        $shift = $this->sequenceBit;
        foreach ($this->segment as $segment) {
            $id |= $segment[1] << $shift;
            $shift += $segment[0];
        }
        $id |= ($now - $this->startTime) << $shift;
        return $id;
    }
}