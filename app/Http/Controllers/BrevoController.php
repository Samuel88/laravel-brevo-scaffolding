<?php

namespace App\Http\Controllers;

use Brevo\Client\Model\CreateContact;
use Illuminate\Http\Request;

class BrevoController extends Controller
{
    public function addNewsletterEmail(Request $request) {
        $config = \Brevo\Client\Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', 'API_KEY');

        $apiInstance = new \Brevo\Client\Api\ContactsApi(
            new \GuzzleHttp\Client(),
            $config
        );

        $createContact = new CreateContact();
        $createContact['email'] = 'samuel.panicucci@gmail.com';
        $createContact['listIds'] = [2];
        
        try {
            $result = $apiInstance->createContact($createContact);
            dd($result);
        } catch (\Brevo\Client\ApiException $e) {
            dd($e->getMessage());
        }

        return redirect()->route('home');
    }
}
