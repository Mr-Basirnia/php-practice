<?php

namespace App;

class Helpers
{
    /**
     * It converts a camelCase string to a snake_case string.
     *
     * @param string $value The string to convert
     * @param string $delimiter The delimiter to use in the returned string.
     */
    public static function camelCaseToUnderscore(string $value, string $delimiter = '_'): string
    {
        return trim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $value)), $delimiter);
    }
}