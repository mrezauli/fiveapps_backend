<?php

namespace App;

use Fouladgar\MobileVerification\Contracts\SMSClient;
use Fouladgar\MobileVerification\Notifications\Messages\Payload;
use Illuminate\Support\Facades\Http;

class VonageSMSClient implements SMSClient
{
    public function sendMessage(Payload $payload): mixed
    {
        $response = Http::withBasicAuth(config('services.vonage.key'), config('services.vonage.secret'))
            ->post('https://rest.nexmo.com/sms/json', [
                'from' => config('services.vonage.sms_from'),
                'to' => $payload->getTo(),
                'text' => 'bditec',
            ]);

        return $response->json();
    }
}