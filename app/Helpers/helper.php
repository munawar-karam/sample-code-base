<?php

if (!function_exists('generate_unique_encrypted_id')) {
    function generate_unique_encrypted_id()
    {
        return str_replace(' ','',\Illuminate\Support\Str::random(15).time().\Illuminate\Support\Str::random(15).microtime());
    }
}
