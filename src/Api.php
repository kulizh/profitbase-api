<?php
namespace Profitbase;

use Profitbase\Helpers\Token;
use Profitbase\Models\ModelAbstract;

class Api
{
    private string $appKey;
    private string $url;

    private Token $token;

    public function __construct(string $app_key, string $domain)
    {
        $this->appKey = $app_key;
        $this->url = 'https://' . $domain . '.profitbase.ru/api/v4/json';

        $this->register();
    }

    public function factory(string $name, string $namespace = ''): ModelAbstract
    {
        $namespace = (empty($namespace)) 
            ? __NAMESPACE__ . '\Models\\'
            : $namespace;
        
        $classname = $namespace . ucfirst($name);

        if (class_exists($classname))
        {
            return new $classname($this->token, $this->url);
        }

        throw new \Exception('Class ' . $name . ' not found');
    }

    private function register()
    {
        $this->token = new Token($this->url, $this->appKey);
        $this->token->access();
    }
}