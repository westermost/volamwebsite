<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('public_url'))
{
    function public_url($url = '')
    {
        return base_url('public/' . $url);
    }
}

if ( ! function_exists('rand_number'))
{
    function rand_number()
    {
        return rand(1718923789123123, 978012803812938);
    }
}

if ( ! function_exists('active_key'))
{
    function active_key()
    {
        return md5(uniqid(rand(), true)) . md5(uniqid(rand(), true));
    }
}

if ( ! function_exists('rand_pass'))
{
    function rand_pass($length = 8)
    {
        $randString = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($randString, ceil($length / strlen($randString)))), 0, $length);
    }
}

if ( ! function_exists('mail_config'))
{
    function mail_config($smtp_host = MAIL_SMTP_HOST, $smtp_user = MAIL_SMTP_USER, $smtp_pass = MAIL_SMTP_PASS)
    {
        $config['protocol']     = MAIL_PROTOCOL;

        if ($config['protocol'] == 'smtp')
        {
            $config['smtp_host']    = $smtp_host;// 'ssl://smtp.googlemail.com'
            $config['smtp_user']    = $smtp_user;
            $config['smtp_pass']    = $smtp_pass;
            if ($smtp_host == 'ssl://smtp.googlemail.com')
            {
                $config['smtp_port']     = '465';
            }
        }

        $config['charset'] = MAIL_CHARSET;
        $config['mailtype'] = MAIL_TYPE;
        $config['wordwrap'] = MAIL_WORDWRAP;
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        return $config;
    }
}

if(! function_exists('RandomString'))
{
    function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $randomLength = rand(50,100);
        for ($i = 0; $i < $randomLength; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if(! function_exists('getValue'))
{
    function getValue($target_array, $key, $default = null, $trim = false)
    {
        if (! is_array($target_array))
        {
            return $default;
        }

        if (array_key_exists($key, $target_array))
        {
            if ($trim == true)
            {
                $target_array[$key] = trim($target_array[$key]);
            }

            return $target_array[$key];
        }

        return $default;
    }
}

if(! function_exists('weekStartEndByDate'))
{
    function weekStartEndByDate($date, $format = 'Ymd')
    {
        //Is $date timestamp or date?
        if (is_numeric($date) AND strlen($date) == 10) {
            $time = $date;
        }else{
            $time = strtotime($date);
        }

        $week['week'] = date('W', $time);
        $week['year'] = date('o', $time);
        $week['year_week']           = date('oW', $time);
        $first_day_of_week_timestamp = strtotime($week['year']."W".str_pad($week['week'],2,"0",STR_PAD_LEFT));
        $week['first_day_of_week']   = date($format, $first_day_of_week_timestamp);
        $week['first_day_of_week_timestamp'] = $first_day_of_week_timestamp;
        $last_day_of_week_timestamp = strtotime($week['first_day_of_week']. " +6 days");
        $week['last_day_of_week']   = date($format, $last_day_of_week_timestamp);
        $week['last_day_of_week_timestamp']  = $last_day_of_week_timestamp;

        return $week;
    }
}

