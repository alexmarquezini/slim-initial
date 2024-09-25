<?php


if(!function_exists('env')) {
    function env($key, $default = '')
    {
        if(!getenv($key)) {
            return $default;
        }
        return getenv($key);
    }
}

if(!function_exists('event')) {
    function event($event)
    {
        return new $event;
    }
}