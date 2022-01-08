<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;
use PharIo\Manifest\Email;

class NewsLetter
{
    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client()->lists->addListMember($list, [
            "email_address" => request($email),
            "status" => "subscribed",
        ]);
    }

    private function client()
    {
        return (new ApiClient())->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }
}
