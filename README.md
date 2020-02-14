# Sylapi/Courier-enadawca

**Courier library**

## Installation

Courier to install, simply add it to your `composer.json` file:

```json
{
    "require": {
        "sylapi/courier-enadawca": "~1.0"
    }
}
```


## Shipping information:
```php

$courier = new Courier('Enadawca');

$courier->sandbox(true);
$courier->setLogin('123456');
$courier->setPassword('abc12345def');

$courier->setOptions([
        'weight' => 3.00,
        'width' => 30.00,
        'height' => 50.00,
        'depth' => 10.00,
        'amount' => 2390.10,
        'cod' => true,
        'saturday' => false,
        'custom' => [
            'parcel_cost' => 8,
            'ubezpieczenie' => 1000,
            'gabaryt' => 'XXL'
        ],
        'references' => 'order #4567',
        'note' => 'Note'
    ]);
```