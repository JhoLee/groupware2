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

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
        $month = $day * 30;
        $year = $day * 365;

        if ($diff < $minute) {
            $result = '방금';
        } else if ($diff >= $minute and $diff < $hour) {
            $result = round($diff / $minute) . '분전';
        } else if ($diff >= $hour and $diff < $day) {
            $result = round($diff / $hour) . '시간전';
        } else if ($diff >= $day and $diff < $day * 2) {
            $result = '어제';
        } else if ($diff >= $day and $diff < $week) {
            $result = round($diff / $day) . '일전';
        } else if ($diff >= $week and $diff < $month) {
            $result = round($diff / $week) . '주전';
        } else if ($diff >= $month and $diff < $year) {
            $result = round($diff / $month) . '달전';
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

        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;
        $month = $day * 30;
        $year = $day * 365;

        if ($diff < $day) {
            $result = '오늘';
        } else if ($diff >= $day and $diff < $day * 2) {
            $result = '어제';
            //} else if ($diff >= ($d * 2) and $diff < ($d * 3)) {
            //$result = '2일전';
        } else if ($diff >= ($day * 2) and $diff < $week) {
            $result = round($diff / $day) . '일전';
        } else if ($diff >= $week and $diff < $month) {
            $result = round($diff / $week) . '주전';
        } else if ($diff >= $month and $diff < $year) {
            $result = round($diff / $month) . '달전';
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