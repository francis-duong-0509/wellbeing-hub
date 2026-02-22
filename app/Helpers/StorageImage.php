<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('storage_s3_url')) {
    function storage_s3_url($path, $default = '') {
        if ($path === null) {
            return $default;
        }

        return Storage::disk(config('filesystems.default'))->url($path);
    }
}