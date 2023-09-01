<?php
namespace Profitbase\Helpers;

use Profitbase\Request\Post;

final class Token
{
    public static $CACHE_LIFETIME = 86400; // 24 hours
    public static $CACHE_DIR = '/../../data/cache/';

    private string $appKey;
    private string $url;

    private string $accessToken;

    public function __construct(string $url, string $app_key)
    {
        $this->url = $url;
        $this->appKey = $app_key;
    }

    public function access(): string
    {
        if (!empty($this->accessToken))
        {
            return $this->accessToken;
        }

        $this->accessToken = $this->getCached();

        if (empty($this->accessToken))
        {
            $post = new Post($this);
            $result = $post->make($this->url . '/authentication', [
                'type' => 'api-app',
                'credentials' => [
                    'pb_api_key' => $this->appKey
                ]
            ]);

            $this->accessToken = $result['access_token'] ?? '';
            $this->setCached($this->accessToken);
        }

        return $this->accessToken;
    }

    private function getCached(): string
    {
        $cache_filename = dirname(__FILE__) . self::$CACHE_DIR . 'token.cache';

        if (
            !is_readable($cache_filename)
            || filemtime($cache_filename) < (time() - self::$CACHE_LIFETIME)
            )
        {
            return '';
        }

        return file_get_contents($cache_filename);
    }

    private function setCached(string $access_token)
    {
        $cache_filename = dirname(__FILE__) . self::$CACHE_DIR . 'token.cache';
        
        file_put_contents($cache_filename, $access_token);
    }
}