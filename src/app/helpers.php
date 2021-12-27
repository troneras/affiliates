<?php

const HEART_RADIUS = 6371000;

/**
 * Parse the give path as array json and return an array or array
 *
 * @param string  $path
 * @param bool  $associative
 *
 * @return array
 */
if (! function_exists('parse_file_as_json')) {
    function parse_file_as_json(string $path, bool $associative = true) {
        // mapping lines into an array
        return array_map(function ($line) use ($associative) {
            $json = json_decode($line, $associative);

            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \Exception(json_last_error_msg(), json_last_error());
            }

            return $json;
        }, file($path));
    }
}
