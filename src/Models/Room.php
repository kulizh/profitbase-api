<?php
namespace Profitbase\Models;

use Profitbase\Request\Get;

class Room extends ModelAbstract
{
    private static int $PROFITBASE_LIMIT = 100;

    protected string $method = '/property';

    public function getList(): array
    {
        $premises = [];
        $offset = 0;
        
        $get = new Get($this->token);
        
        while($row = $get->make($this->url, [
            'full' => 'true',
            'offset' => $offset
        ]))
        {
            
            $offset += self::$PROFITBASE_LIMIT;
            $premises = array_merge($premises, $row);
        }

        return $premises;
    }
}