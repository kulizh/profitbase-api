<?php
namespace Profitbase\Request;

use Profitbase\Helpers\Token;

class Get implements IRequest
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function make(string $url, array $payload)
    {
        $payload['access_token'] = $this->token->access();
        
        if (!empty($payload))
        {
            $url .= '?' . http_build_query($payload);
        }

        $result = file_get_contents($url);

        return json_decode($result, true);
    }
}