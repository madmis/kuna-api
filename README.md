# Kuna.io REST API PHP Client

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]
[![Build Status][testing-image]][testing-link]
[![Coverage Status][coverage-image]][coverage-link]
[![Latest Stable Version][stable-image]][package-link]
[![Total Downloads][downloads-image]][package-link]
[![License][license-image]][license-link]

[Kuna.io](https://kuna.io/documents/api) provides REST APIs that you can use
 to interact with platform programmatically.

This API client will help you interact with Kuna by REST API. 
 
## Table Of Contents

- [License](#license)
- [Kuna REST API Reference](#kuna-rest-api-reference)
- [Contributing](#contributing)
- [Install](#install)
- [Usage](#usage)
    - [Mapping](#mapping)
    - [Error handling](#error-handling)
- [Running the tests](#running-the-tests)
    - [Running Unit tests](#running-unit-tests)
- [Library api](#library-api)    
    - [Shared resources (Public Kuna API)](#shared-resources-public-kuna-api)    
    - [Private resources (Private Kuna API) ](#private-resources-private-kuna-api)    


## License

MIT License

## Kuna REST API Reference

https://kuna.io/documents/api


## Contributing
To create new endpoint - [create issue](https://github.com/madmis/kuna-api/issues/new) 
or [create pull request](https://github.com/madmis/kuna-api/compare)


## Install
    
    composer require cryptopupua/kuna-api 1.1.*


## Usage
```php
require __DIR__.'/vendor/autoload.php';

use cryptopupua\KunaApi\Api;
use cryptopupua\KunaApi\Exception\IncorrectResponseException;
use cryptopupua\KunaApi\KunaApi;
use cryptopupua\KunaApi\Model\History;
use cryptopupua\KunaApi\Model\MyAccount;
use cryptopupua\KunaApi\Model\Order;
use cryptopupua\KunaApi\Model\Ticker;


$api = new KunaApi(
    'https://kuna.io',
    'public key',
    'secret key'
);
$timestamp = $api->shared()->timestamp();
```
### Mapping

Each endpoint response (exclude: timestamp) can be received as `array` or as `object`.

To use mapping response to `object` set parameter `$mapping` to `true`. 

```php
$issue = $api->signed()->activeOrders(Http::PAIR_ETHUAH, true);

// Result
[
    {
    class madmis\KunaApi\Model\Order {
        protected $id => 10003
        protected $side => "sell"
        protected $ordType => "limit"
        protected $price => 10000
        protected $avgPrice => 0
        protected $state => "wait"
        protected $market => "ethuah"
        protected $createdAt => DateTime
        protected $volume => 0.01
        protected $volume => 0.01
        protected $remainingVolume => 0.01
        protected $executedVolume => 0
        protected $tradesCount => 0
      }
    
    },
    ...
] 
```

### Error handling
Each client request errors wrapped to custom exception **madmis\ExchangeApi\Exception\ClientException**  

```php
class madmis\ExchangeApi\Exception\ClientException {
  private $request => class GuzzleHttp\Psr7\Request
  private $response => NULL
  protected $message => "cURL error 7: Failed to connect to 127.0.0.1 port 8080: Connection refused (see http://curl.haxx.se/libcurl/c/libcurl-errors.html)"
  ...
}
```

**ClientException** contains original **request object** and **response object** if response available

```php
class madmis\ExchangeApi\Exception\ClientException {
  private $request => class GuzzleHttp\Psr7\Request 
  private $response => class GuzzleHttp\Psr7\Response {
    private $reasonPhrase => "Unauthorized"
    private $statusCode => 401
    ...
  }
  protected $message => "Client error: 401"
  ...  
}
```

So, to handle errors use try/catch

```php
try {
    $api->signed()->activeOrders(Http::PAIR_ETHUAH, true);
} catch (madmis\ExchangeApi\Exception\ClientException $ex) {
    // any actions (log error, send email, ...) 
}
``` 


## Running the tests
To run the tests, you'll need to install [phpunit](https://phpunit.de/). 
Easiest way to do this is through composer.

    composer install

### Running Unit tests

    php vendor/bin/phpunit -c phpunit.xml.dist


[testing-link]: https://travis-ci.org/madmis/kuna-api
[testing-image]: https://travis-ci.org/madmis/kuna-api.svg?branch=master

[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/77152883-412e-4a91-86b6-fb976243a020
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/77152883-412e-4a91-86b6-fb976243a020/mini.png

[package-link]: https://packagist.org/packages/madmis/kuna-api
[downloads-image]: https://poser.pugx.org/madmis/kuna-api/downloads
[stable-image]: https://poser.pugx.org/madmis/kuna-api/v/stable
[license-image]: https://poser.pugx.org/madmis/kuna-api/license
[license-link]: https://packagist.org/packages/madmis/kuna-api

[coverage-link]: https://coveralls.io/github/madmis/kuna-api?branch=master
[coverage-image]: https://coveralls.io/repos/github/madmis/kuna-api/badge.svg?branch=master

## Library api

### Shared resources (Public Kuna API)

* [Time from the exchange server](https://kuna.io/api/v2/timestamp)

    ```php
    $timestamp = $api->shared()->timestamp();
    ```

* [Recent Market Data](https://kuna.io/api/v2/tickers/btcuah)

   ```php
     $tickers = $api->shared()->tickers('btcuah');
   ```

* [Order Book](https://kuna.io/api/v2/order_book?market=btcuah)

   ```php
     $orders = $api->shared()->orderBook('btcuah');
   ```

* [Asks Order Book](https://kuna.io/api/v2/order_book?market=btcuah)

   ```php
     $orders = $api->shared()->asksOrderBook('btcuah');
   ```

* [Bids Order Book](https://kuna.io/api/v2/order_book?market=btcuah)

   ```php
     $orders = $api->shared()->bidsOrderBook('btcuah');
   ```

* [Trades History](https://kuna.io/api/v2/trades?market=btcuah)

   ```php
     $orders = $api->shared()->tradesHistory('btcuah');
   ```

### Private resources (Private Kuna API) 

* [Information About the User and Assets](https://kuna.io/api/v2/members/me)

   ```php
     $orders = $api->signed()->me();
   ```

* [Order Placing - create BUY order](https://kuna.io/api/v2/orders)

   ```php
     $orders = $api->signed()->createBuyOrder('btcuah', 1.00, 350000, true);
   ```

* [Order Placing - create SELL order](https://kuna.io/api/v2/orders)

   ```php
     $orders = $api->signed()->createSellOrder('btcuah', 1.00, 420000, true);
   ```

* [Order Cancel](https://kuna.io/api/v2/order/delete)

   ```php
     $orders = $api->signed()->cancelOrder(124578, true);
   ```

* [Active User Orders](https://kuna.io/api/v2/orders)

   ```php
     $orders = $api->signed()->activeOrders('btcuah', true);
   ```

* [User Trade History](https://kuna.io/api/v2/trades/my)

   ```php
     $orders = $api->signed()->myHistory('btcuah', true);
   ```
