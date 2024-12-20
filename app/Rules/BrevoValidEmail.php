<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use Config;

class BrevoValidEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $config = \Brevo\Client\Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', Config::get('app.brevo.api_key'));

        $apiInstance = new \Brevo\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $createContact = new \Brevo\Client\Model\CreateContact();
        $createContact['email'] = $value;
        $createContact['listIds'] = [intval(Config::get('app.brevo.list_id'))];

        //dd(intval(Config::get('app.brevo.list_id')));

        try {
            $result = $apiInstance->createContact($createContact);
            // TODO Controllare il risultato
        } catch (\Brevo\Client\ApiException $e) {
            $json = json_decode($e->getResponseBody(), true);
            if ($e->getCode() === 400 && $json['code'] === 'duplicate_parameter') {
                $fail("La mail {$value} è già presente");
            } else {
                $fail("Errore {$e->getMessage()}");
            }
        }

    }
}
