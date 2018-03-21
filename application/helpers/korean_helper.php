<?php
defined('BASEPATH') OR exit('No direct script access allowed');
const CURRENCY = '￦';
date_default_timezone_set('Asia/Seoul');
if (!function_exists('kdate')) {
    function kdate($stamp)
    {
        return date('Y년 m월 d일 H시 i분 s초', $stamp);
    }

}
if (!function_exists('simplest_kdate')) {
    function simplest_kdate($time)
    {
        $stamp = strtotime($time);
        return date('m/d', $stamp);
    }
}
if (!function_exists('simple_kdate')) {
    function simple_kdate($time)
    {
        $stamp = strtotime($time);
        return date('m월 d일', $stamp);
    }
}

if (!function_exists('compute_time')) {
    function compute_time($datetime)
    {
        if (empty($datetime)) {
            return date('방금');
        }
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        $m = 60;
        $h = $m * 60;
        $d = $h * 24;
        $w = $d * 7;
        $y = $d * 365;

        if ($diff < $m) {
            $result = '방금';
        } else if ($diff >= $m and $diff < $h) {
            $result = round($diff / $m) . '분전';
        } else if ($diff >= $h and $diff < $d) {
            $result = round($diff / $h) . '시간전';
        } else if ($diff >= $d and $diff < $w) {
            $result = round($diff / $d) . '일전';
        } else if ($diff >= $w and $diff < $y) {
            $result = round($diff / $w) . '주전';
        } else {
            $result = kdate($datetime);
        }

        return $result;
    }
}
if (!function_exists('compute_date')) {
    function compute_date($datetime)
    {
        if (empty($datetime)) {
            return date('언젠가');
        }
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        $m = 60;
        $h = $m * 60;
        $d = $h * 24;
        $w = $d * 7;
        $y = $d * 365;

        if ($diff < $d) {
            $result = '오늘';
        } else if ($diff >= $d and $diff < $d * 2) {
            $result = '어제';
            //} else if ($diff >= ($d * 2) and $diff < ($d * 3)) {
            //$result = '2일전';
        } else if ($diff >= ($d * 3) and $diff < $w) {
            $result = round($diff / $d) . '일전';
        } else if ($diff >= $w and $diff < $y) {
            $result = round($diff / $w) . '주전';
        } else {
            $result = kdate($datetime);
        }

        return $result;
    }
}

if (!function_exists('kmoney')) {
    function kmoney($value = 0)
    {
        return CURRENCY . number_format($value);
    }
}