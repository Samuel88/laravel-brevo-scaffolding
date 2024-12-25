<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewsletterContactRequest;
use App\Services\BrevoService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BrevoController extends Controller
{
    public function __construct(private BrevoService $brevoService) {

    }

    public function showNewsletterForm(): View {
        return view("brevo.showForm");
    }

    public function addNewsletterContact(AddNewsletterContactRequest $request)   {
        try {
            $this->brevoService->addContactToList($request->email);
            return redirect()->back()->with("success","Email aggiunta con successo");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
}
