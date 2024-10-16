<?php

namespace App\Service\Notification;

use App\Notifications\NotifyNewSafe;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client as TwilioClient;


class Notification
{
    public static function sendTwilioSMS($phone, $body)
    {
        try {
            $sid = config('app.twilio_account_sid');
            $token = config('app.twilio_auth_token');

            Log::error("SID $sid / TOKEN $token / PHONE $phone");

            $twilio = new TwilioClient($sid, $token);
            $phone = '+55' . $phone;

            $message = $twilio->messages
                ->create($phone, // to
                    [
                        "body" => $body,
                        "from" => "+13186977289"
                    ]
                );

            return $message;
        }catch (\Exception $exception){
            Log::error('[Notification][sendTwilioSMS] ' . $exception->getMessage());
            return false;
        }
    }

    public function newInsuranceQuote($uuid, $user)
    {
        $user->notify(new NotifyNewSafe($uuid, null, null, 'new_insurance_quote'));
        self::sendTwilioSMS($user->phone, "Uma nova cotação de seguro, acaba de ser realizada. ID: ".$uuid);
    }

    public function customerQuestion($uuid, $user)
    {
        $user->notify(new NotifyNewSafe($uuid, null, null, 'new_insurance_quote'));
        self::sendTwilioSMS($user->phone, "Novo cliente com dúvidas, entre em contato com o possível cliente. ID: ".$uuid);
    }

    public function closeProposal($uuid, $user)
    {
        $user->notify(new NotifyNewSafe($uuid, null, null, 'close_proposal'));
        self::sendTwilioSMS($user->phone, "Novo cliente querendo fechar proposta, entre em contato com o possível cliente. ID: ".$uuid);
    }

    public function sendClient($uuid, $formDB)
    {
        $user = $formDB->user;
        $user->notify(new NotifyNewSafe($uuid, $user->name, $formDB));
        self::sendTwilioSMS($user->phone, "Obrigado pelo seu interesse na Finarte. Vamos analisar a sua solicitação e entraremos em contato em até 1 dia útil.");
    }
}