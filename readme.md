# PHP-обёртка над АПИ Profitbase

```php
require_once dirname(__FILE__) . '/../vendor/autoload.php';

$profitbaseApi = new Profitbase\Api('app-64e8axxxcdca3', 'pbxxxx');

$projects = $profitbaseApi->factory('projects')->getList();
$rooms = $profitbaseApi->factory('properties')->getList();
$layouts = $profitbaseApi->factory('presets')->getList();
```