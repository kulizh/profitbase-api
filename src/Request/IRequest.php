<?php
namespace Profitbase\Request;

use Profitbase\Helpers\Token;

interface IRequest
{
    public function __construct(Token $token);

    public function make(string $url, array $payload);
}