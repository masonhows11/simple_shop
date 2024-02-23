<?php

namespace App\Rules;

use Closure;
use http\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class RecaptchaRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //

        $client = new Client([
            'base_uri' => 'https://www.google.com/recaptcha/api/',
        ]);

        $response = $client->post('siteverify',[
            'query'=> [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $value,
            ]
        ]);

        dd(json_decode($response->getBody()));
    }

}
