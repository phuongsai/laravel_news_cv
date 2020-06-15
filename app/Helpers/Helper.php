<?php

use Carbon\Carbon;

class MyHelper
{
    public static function dMYDateFormat($value)
    {
        return Carbon::createFromFormat('d F Y', $value)->toDateString();
    }
}

if (!function_exists('customDateFormat')) {
    function customDateFormat($value)
    {
        return  \Carbon\Carbon::parse($value)->format('F d, Y');
    }
}

if (!function_exists('defaultPostImage')) {
    function defaultPostImage()
    {
        return  'http://res.cloudinary.com/phuonghoang/image/upload/v1588515341/posts/default_post_fkmbui.jpg';
    }
}

if (!function_exists('defaultUserImage')) {
    function defaultUserImage()
    {
        return  'http://res.cloudinary.com/phuonghoang/image/upload/v1588514190/profiles/default_user_dt79ye.png';
    }
}

if (!function_exists('intendedURL')) {
    function intendedURL()
    {
        if (!Session::has('pre_url')) {
            Session::put('pre_url', URL::previous());
        } else {
            if (URL::previous() != URL::to('login')) {
                Session::put('pre_url', URL::previous());
            }
        }
    }
}

if (!function_exists('capWord')) {
    function capWord(string $text)
    {
        return ucfirst($text);
    }
}
