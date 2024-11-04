<?php

namespace App\Traits;

trait Encoder
{
    public function encryption(string $key)
    {
        return base64_encode(base64_encode($key));
    }

    public function decryption(string $key)
    {
        return base64_decode(base64_decode($key));
    }
}
    