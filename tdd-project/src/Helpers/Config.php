<?php

namespace App\Helpers;

use App\Exceptions\ConfigFileNotFoundException;

class Config
{

    /**
     * > It returns the content of a file, or a specific key from the file's content
     *
     * @param string $fileName The name of the file to get the content from.
     * @param string|int|null $key The key to get from the config file. If null, the entire file will be returned.
     * @return mixed|null The value of the key in the array.
     * @throws ConfigFileNotFoundException
     */
    public static function get(string $fileName, $key = null)
    {
        $fileContent = self::getFileContent($fileName);
        if (null === $key)
            return $fileContent;

        return $fileContent[$key] ?? null;
    }

    /**
     * It takes a filename as a parameter, checks if the file exists, and if it does
     * it return the content of the file
     *
     * @param string $filename The name of the file you want to get the content of.
     * @throws ConfigFileNotFoundException
     */
    public static function getFileContent(string $filename)
    {
        $filePath = realpath(__DIR__ . '/../Configs/' . $filename . '.php');

        if (!$filePath) {
            throw new ConfigFileNotFoundException();
        }
        return require $filePath;
    }
}