# PHP-обёртка для отправки запросов к Profitbase API
## Установка
Установите пакет с помощью (Composer)[https://packagist.org/packages/kulizh/profitbase-api]:
`composer require kulizh/profitbase-api`


## Basic usage

```php
require_once dirname(__FILE__) . '/vendor/autoload.php';

// Initialize object
$profitbaseApi = new Profitbase\Api('app-64e8axxxcdca3', 'pbxxxx');

```