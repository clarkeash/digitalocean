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

### Sizes

List the available server sizes

```php
$sizes = $gateway->sizes();
```

### Regions

List the available server regions

```php
$regions = $gateway->regions();
```

### Images

List the available server images

```php
$images = $gateway->images();
```
