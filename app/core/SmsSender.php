<?php

namespace App\Service;

use APP\CORE\Env;
use Twilio\Rest\Client;
use Exception;

class SmsSender
{
    private Client $client;
    private string $from;

    public function __construct()
    {
        $this->client = new Client(Env::get('TWILO_SID'), Env::get('TWILO_TOKEN'));
        $this->from = Env::get('MESSAGE_FROM');
    }

    public function sendSms(string $to, string $message): string
    {
        try {
            $sms = $this->client->messages->create(
                $to,
                [
                    'from' => $this->from,
                    'body' => $message
                ]
            );
            return $sms->sid;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'envoi du SMS : " . $e->getMessage());
        }
    }

    public function getStatus(string $sid): string
    {
        return $this->client->messages($sid)->fetch()->status;
    }

    public function isSuccess(string $sid): bool
    {
        return $this->getStatus($sid) === 'delivered';
    }
}
