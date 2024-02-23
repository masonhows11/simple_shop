<?php

namespace App\Rules;

use Closure;

use GuzzleHttp\Client;
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
        if($value != json_decode($response->getBody())->success )
        {
            $fail(__('messages.recaptcha_not_valid'));
        }
    }

}
