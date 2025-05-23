<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SecurityHelper
{
    public static function isPasswordPwned($password)
    {
        $sha1 = strtoupper(sha1($password));
        $prefix = substr($sha1, 0, 5);
        $suffix = substr($sha1, 5);

        $response = Http::withHeaders([
            'User-Agent' => 'Laravel Password Checker'
        ])->get("https://api.pwnedpasswords.com/range/{$prefix}");

        if ($response->failed()) {
            return false; // ne bloque pas en cas de panne API
        }

        $lines = explode("\n", $response->body());
        foreach ($lines as $line) {
            [$hashSuffix, $count] = explode(":", $line);
            if (trim($hashSuffix) === $suffix) {
                return true; // mot de passe compromis détecté
            }
        }

        return false;
    }
}
