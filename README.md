# Digital Ocean Gateway

[![Author](http://img.shields.io/badge/author-@clarkeash-blue.svg?style=flat-square)](https://twitter.com/clarkeash)
[![Travis](https://img.shields.io/travis/rackr/digitalocean.svg?style=flat-square)](https://travis-ci.org/rackr/digitalocean)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/rackr/digitalocean.svg?style=flat-square)](https://scrutinizer-ci.com/g/rackr/digitalocean)
[![Codecov](https://img.shields.io/codecov/c/github/rackr/digitalocean.svg?style=flat-square)](https://codecov.io/github/rackr/digitalocean)
[![License](https://img.shields.io/packagist/l/rackr/digitalocean.svg?style=flat-square)](https://github.com/rackr/digitalocean/blob/master/LICENSE)

A [DigitalOcean](https://www.digitalocean.com) Gateway for [Rackr Cloud](https://github.com/rackr/cloud).

# Usage

## With Rackr/Cloud

Instructions coming soon.

## Without Rackr/Cloud

### Create A Gateway

```php
$gateway = new \Rackr\DigitalOcean\Gateway(new GuzzleHttp\Client, ['token' => 'YOUR_TOKEN']);
```

Further examples will assume you have created the gateway.

#### Sizes

List the available server sizes

```php
$sizes = $gateway->sizes();
```

#### Regions

List the available server regions

```php
$regions = $gateway->regions();
```

#### Images

List the available server images

```php
$images = $gateway->images();
```

### Use an Instance

```php
$instance = $gateway->instance();
```

Further examples will assume you have created the instance.

#### Create

Create a new instance on the gateway

```php
$instance->create('example.com', '1gb', 'nyc1', 'ubuntu-14-04-x64');
```

#### All

List all instances

```php
$instance->all();
```

#### Info

Get details about the instance.

```php
$instance->info(123456);
```

#### Destroy

Destroy an instance.

```php
$instance->destroy(123456);
```

#### Power On

Power on  an instance.

```php
$instance->on(123456);
```

#### Power Off

Power off  an instance.

```php
$instance->off(123456);
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```
