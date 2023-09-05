# PHP-обёртка для отправки запросов к Profitbase API
## Установка
Установите пакет с помощью (Composer)[https://packagist.org/packages/kulizh/profitbase-api]:
`composer require kulizh/profitbase-api`

## Базовое использование
Создаём объект. В конструктор класса передаём два параметра: ключ приложения и домен
```php
require_once dirname(__FILE__) . '/vendor/autoload.php';

$profitbaseApi = new Profitbase\Api('app-64e8axxxcdca3', 'pbxxxx');
```

Получение моделей реализовано с использованием фабрики. В пространстве имён `Profitbase\Models\` должен быть инициализирован класс с соответствующим именем. 

Классы моделей расширяют абстрактный класс `Profitbase\Models\ModelAbstract`, в котором уже реализован метод `getList(): array`, возвращающий результат гет-запроса

```php
// Получение списка ЖК
$complex_list = $profitbaseApi->model('complex')->getList();

// Получение списка корпусов
$buildings_list = $profitbaseApi->model('building')->getList();

// Получение списка планировок
$layouts_list = $profitbaseApi->model('layout')->getList();

// Получение списка квартир
$rooms_list = $profitbaseApi->model('room')->getList();
```

При получении списка квартир производится выборка __всех__ квартир вместе с custom_fields. 