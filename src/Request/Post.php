<?php
namespace Profitbase\Request;

use Profitbase\Helpers\Token;

class Post implements IRequest
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function make(string $url, array $payload)
    {
        echo $url;
        print_r($payload);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

        $result = curl_exec($ch);

        curl_close($ch);

        return json_decode($result, true);
    }
}