<?php

namespace App\Domain\Traits\GenerateData;

use Illuminate\Support\Str;

trait GeneratePassword
{
    private int $digit = 0;
    private string $lyrics = "";
    private string $upperCase = "";
    private string $lowerCase = "";
    private string $specialChar = "";

    public function generatePassword(): string
    {
        $this->generateLyrics();
        $this->lyricsCase();
        $this->generateDigit();
        $this->generateSpecialChars();

        $password = $this->upperCase . $this->digit . $this->specialChar . $this->lowerCase;
        return str_shuffle($password);
    }

    private function generateLyrics(): void
    {
        $this->lyrics = Str::random(6);
    }

    private function lyricsCase(): void
    {
        $part1 = substr($this->lyrics, 0, 3);
        $part2 = substr($this->lyrics, 3);

        $this->upperCase = strtoupper($part1);
        $this->lowerCase = strtolower($part2);
    }

    private function generateDigit(): void
    {
        $this->digit = rand(0, 100);
    }

    private function generateSpecialChars(): void
    {
        $specialChars = ['$','*','&','@','#'];
        $this->specialChar = $specialChars[array_rand($specialChars)];
    }
}
