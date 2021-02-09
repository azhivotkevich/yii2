<?php


namespace app\helpers;


class StringHelper
{
    public static function mbUcFirst(string $string, string $enc = 'UTF-8'): string
    {
        $string = mb_strtolower($string);
        return mb_strtoupper(mb_substr($string, 0, 1, $enc), $enc)
            . mb_substr($string, 1, mb_strlen($string, $enc), $enc);
    }
}