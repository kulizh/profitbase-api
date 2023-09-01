<?php
namespace Profitbase\Models;

use Profitbase\Helpers\Token;
use Profitbase\Request\Get;

abstract class ModelAbstract
{
    protected string $method;
    protected string $url;

    protected Token $token;

    public function __construct(Token $token, string $api_url)
    {
        $this->token = $token;
        $this->url = $api_url . $this->method;
    }

    public function getList(): array
    {
        $get = new Get($this->token);
        
        return $get->make($this->url, []);
    }
}