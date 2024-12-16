<?php

namespace App\Domain\Traits\GenerateData;

use Illuminate\Support\Str;

trait GenerateEmail
{
    private string $lyrics = "";
    private string  $dominio = "";

    public function generateEmail(): string
    {
        $this->lyrics();
        $this->dominio();
        $email = $this->lyrics . '@' . $this->dominio;
        return $email;
    }

    private function lyrics(): void
    {
        $this->lyrics = Str::random(10);
    }

    private function dominio(): void
    {
        $dominio = ['gmail.com', 'outlook.com', 'business.com.br'];
        $rand_keys = array_rand($dominio);
        $this->dominio = $dominio[$rand_keys];
    }
}
