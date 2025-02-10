<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GoogleRecaptcha implements Rule
{

    private $error; //1=>for required validation & 2=>for verification error
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // dd($value);
        if (!@$value) {
            $this->error = 1;
            return false;
        }
        $secretKey = config('services.recaptcha.secret_key');

        $response = $value;
        $userIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";
        $response = \file_get_contents($url);

        if (json_decode($response)->success) {
            return true;
        }
        $this->error = 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->error == 1) {
            return "Please verify you are a human";
        } else {
            return "Google Recaptcha Failed.\nPlease Try Again";
        }
    }
}