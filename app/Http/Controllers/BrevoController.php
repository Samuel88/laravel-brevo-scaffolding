<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupToNewsletterRequest;
use Brevo\Client\Model\CreateContact;
use Config;
use Illuminate\Http\RedirectResponse;

class BrevoController extends Controller
{
    public function addNewsletterEmail(SignupToNewsletterRequest $request): RedirectResponse {
        return redirect()->route('home');
    }
}
