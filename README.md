# Location Info
[![Latest Stable Version](https://poser.pugx.org/madebydaniz/location-info/v/stable)](https://packagist.org/packages/madebydaniz/location-info)
[![Total Downloads](https://poser.pugx.org/madebydaniz/location-info/downloads)](https://packagist.org/packages/madebydaniz/location-info)
[![License](https://poser.pugx.org/madebydaniz/location-info/license)](https://packagist.org/packages/madebydaniz/location-info)

This is a tool to search OSM data by name and address and to generate synthetic addresses of OSM points (reverse geocoding).



## Requirements

- [PHP](https://secure.php.net/manual/en/install.php) >= 7.1
- [Composer](https://getcomposer.org/download/)
- [curl](https://packagist.org/packages/curl/curl)

## Installation

Install via Composer:

```bash
$ composer require madebydaniz/location-info
```

## Usage
Reference : https://nominatim.org/release-docs/develop/api/Search/
```php
$address = "Stephansplatz 2, 1010, Wien";
$data = LocationInfo::getInstance()::search($address);
print_r($data);

#output
Array
(
    [place_id] => 4868677
    [licence] => Data © OpenStreetMap contributors, ODbL 1.0. https://osm.org/copyright
    [osm_type] => node
    [osm_id] => 567056993
    [boundingbox] => Array
        (
            [0] => 48.2080963
            [1] => 48.2081963
            [2] => 16.3722742
            [3] => 16.3723742
        )

    [lat] => 48.2081463
    [lon] => 16.3723242
    [display_name] => 2, Stephansplatz, Stubenviertel, KG Innere Stadt, Innere Stadt, Wien, 1010, Österreich
    [class] => place
    [type] => house
    [importance] => 0.441
)
```

#TODO : return format
- [ ] html
- [ ] xml
- [x] json
- [x] jsonv2
- [ ] geojson
- [ ] geocodejson
