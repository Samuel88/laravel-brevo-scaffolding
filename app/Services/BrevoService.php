<?php
namespace App\Services;

use Brevo\Client\Api\ContactsApi;
use Brevo\Client\Configuration;
use Brevo\Client\ApiException;
use Brevo\Client\Model\CreateContact;

class BrevoService {
    private ContactsApi $contactsApi;

    public function __construct(
        private string $brevoApiKey,
        private int $defaultListId,
    ) {
        // Configurazione API di Brevo
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', $this->brevoApiKey);
        $this->contactsApi = new ContactsApi(null, $config);
    }

    public function addContactToList(string $email, array $listIds = [])
    {
        if ($this->contactExists($email)) {
            throw new \Exception("L'email è già presente su Brevo.");
        }

        $createContact = new CreateContact();
        $createContact['email'] = $email;
        $createContact['listIds'] = [$this->defaultListId];

        try {
            return $this->contactsApi->createContact($createContact);
        } catch (ApiException $e) {
            throw new \Exception("Errore API di Brevo: " . $e->getMessage());
        }
    }

    public function contactExists(string $email): bool
    {
        try {
            $this->contactsApi->getContactInfo($email);
            return true; // Contatto trovato
        } catch (ApiException $e) {
            // Controlla se l'errore riguarda un contatto non trovato
            if ($e->getCode() === 404) {
                return false; // Contatto non trovato
            }

            // Rilancia l'eccezione per errori diversi
            throw new \Exception("Errore durante il controllo del contatto: " . $e->getMessage());
        }
    }
}