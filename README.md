# sputnik
Library with geocoder service by Rostelecom.

## Usage

```php
<?php
use JedSense\Sputnik;

$sputnik = new Sputnik\Geo();
$response = $sputnik
    ->setToken('apikey')
    ->setLimit(1)
    ->setQuery('address')
    ->geocode()
;

$kind = $response->getKind(); // Уровень определения адреса (пример: house)
$fullAddress = $response->getFullAddress(); // Текстовый ответ
$coordinate = $response->getCoordinates(); // Долгота, широта 
```

## License

This project is licensed under the [MIT license](LICENSE).
