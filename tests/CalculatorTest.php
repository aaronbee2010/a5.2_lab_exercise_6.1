<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculator;

#[CoversClass(Calculator::class)]
class CalculatorTest extends TestCase
{
    public static function subtractProvider(): array
    {
        return [
            [2, "5,3"],
            [-8, "-5,3"],
            [2, "4,2"]
        ];
    }

    #[Test]
    #[DataProvider("subtractProvider")]
    public function subtract(int $expected, string $input): void
    {
        // Act
        $actual = Calculator::subtract($input);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function divideProvider(): array
    {
        return [
            [5, "10,2"],
            [-5, "10,-2"]
        ];
    }

    #[Test]
    #[DataProvider("divideProvider")]
    public function divide(int $expected, string $input): void
    {
        // Act
        $actual = Calculator::divide($input);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function divideExceptionProvider(): array
    {
        return [[1], [20], [500]];
    }

    #[Test]
    #[DataProvider("divideExceptionProvider")]
    public function divideWithSomeException(int $input): void
    {
        // Arrange / Assert
        $this->expectException(DivisionByZeroError::class);

        // Act
        Calculator::divide("{$input},0");
    }

    public static function multiplyProvider(): array {
        return [
            [50, "25,2"],
            [600, "150,4"]
        ];
    }

    #[Test]
    #[DataProvider("multiplyProvider")]
    public function multiply(int $expected, string $input): void
    {
        // Act
        $actual = Calculator::multiply($input);

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function addEmptyStringShouldReturnZero(): void
    {
        // Arrange
        $expected = 0;

        // Act
        $actual = Calculator::add("");

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[Test]
    #[DataProvider("divideExceptionProvider")]
    public function addOneNumberShouldReturnThatNumber1(int $expected): void
    {
        // Act
        $actual = Calculator::add("{$expected}");

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function addProvider(): array
    {
        return [
            [7, 5],
            [21, 41],
            [124, 283],
        ];
    }

    #[Test]
    #[DataProvider("addProvider")]
    public function addTwoCommaSeparatedNumbersShouldReturnTheSumOfThoseNumbers(int $a, int $b): void
    {
        // Arrange
        $expected = $a + $b;

        // Act
        $actual = Calculator::add("{$a},{$b}");

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[Test]
    #[DataProvider("addProvider")]
    public function addTwoNewlineSeparatedNumbersShouldReturnTheSumOfThoseNumbers(int $a, int $b): void
    {
        // Arrange
        $expected = $a + $b;

        // Act
        $actual = Calculator::add("{$a}\n{$b}");

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function addProvider2(): array
    {
        return [
            [7, 5, 3],
            [21, 41, 61],
            [124, 283, 592],
        ];
    }

    #[Test]
    #[DataProvider("addProvider2")]
    public function addThreeCommaSeparatedNumbersShouldReturnTheSumOfThoseNumbers(int $a, int $b, int $c): void
    {
        // Arrange
        $expected = $a + $b + $c;

        // Act
        $actual = Calculator::add("{$a},{$b},{$c}");

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function addProvider3(): array
    {
        return [
            [-7, 5],
            [21, -41],
            [-124, 283],
        ];
    }

    #[Test]
    #[DataProvider("addProvider3")]
    public function addNegativeNumbersShouldThrowExceptionWithMessage(int $a, int $b): void
    {
        // Arrange / Assert
        $this->expectExceptionMessage("Negative numbers not allowed");

        // Act
        Calculator::add("{$a},{$b}");
    }
}
