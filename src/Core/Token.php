<?php

declare(strict_types=1);

namespace Crawly;

final readonly class Token
{

    private const replacements = [
        "a" => "z",
        "b" => "y",
        "c" => "x",
        "d" => "w",
        "e" => "v",
        "f" => "u",
        "g" => "t",
        "h" => "s",
        "i" => "r",
        "j" => "q",
        "k" => "p",
        "l" => "o",
        "m" => "n",
        "n" => "m",
        "o" => "l",
        "p" => "k",
        "q" => "j",
        "r" => "i",
        "s" => "h",
        "t" => "g",
        "u" => "f",
        "v" => "e",
        "w" => "d",
        "x" => "c",
        "y" => "b",
        "z" => "a",
        "0" => "9",
        "1" => "8",
        "2" => "7",
        "3" => "6",
        "4" => "5",
        "5" => "4",
        "6" => "3",
        "7" => "2",
        "8" => "1",
        "9" => "0"
    ];

    public function __construct(public string $value)
    {
    }

    public function prepareToRequest(): string
    {
        $arrayToken = str_split($this->value);
        $newArrayToken = array_map(fn (string $element) => self::replacements[$element], $arrayToken);
        return implode($newArrayToken);
    }
}
