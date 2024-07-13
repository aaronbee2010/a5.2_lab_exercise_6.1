<?php declare(strict_types=1);

namespace App;

class Utils
{
    public static function toNumber(string $str): int
    {
        return intval($str);
    }

    public static function isNumeric(string $str): bool
    {
        return ctype_digit($str);
    }

    public static function validSeparator(string $str): string
    {
        foreach (str_split($str) as $char)
        {
            if (!self::isNumeric($char))
            {
                return $char;
            }
        }

        throw new \Exception("Could not find valid separator in string.");
    }
}
