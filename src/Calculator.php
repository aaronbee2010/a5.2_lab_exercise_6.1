<?php declare(strict_types=1);

namespace App;

class Calculator
{
    private static function splitInputString(string $n1): array
    {
        // Return two zeroes as operands if input string is empty
        if ($n1 === "") {
            return ["0", "0"];
        }

        // Return the operand and a zero within the array if the input string only contains one integer
        if (Utils::isNumeric($n1)) {
            return [$n1, "0"];
        }
        
        $separator = ",";

        if ( !str_contains($n1, $separator) )
        {
            $separator = Utils::validSeparator($n1);
        }

        $numbers = explode($separator, $n1);

        foreach ($numbers as $number)
        {
            if (!preg_match("/^-/", $number) && !Utils::isNumeric($number))
            {
                throw new \ValueError("Input string contains invalid character.");
            }
        }

        return $numbers;
    }

    public static function divide(string $n1): int
    {
        $numbers = self::splitInputString($n1);

        $numerator = Utils::toNumber($numbers[0]);
        $denominator = Utils::toNumber($numbers[1]);

        return intdiv($numerator, $denominator);
    }

    public static function multiply(string $n1): int
    {
        $numbers = self::splitInputString($n1);

        $a = Utils::toNumber($numbers[0]);
        $b = Utils::toNumber($numbers[1]);

        return $a * $b;
    }

    public static function subtract(string $n1): int
    {
        $numbers = self::splitInputString($n1);

        $a = Utils::toNumber($numbers[0]);
        $b = Utils::toNumber($numbers[1]);

        return $a - $b;
    }

    public static function add(string $n1): int
    {
        if (preg_match("/\-/", $n1)) {
            throw new \ValueError("Negative numbers not allowed");
        }
        
        $result = 0;
        
        $numbers = self::splitInputString($n1);

        foreach ($numbers as $number)
        {
            $result += Utils::toNumber($number);
        }

        return $result;
    }
}
