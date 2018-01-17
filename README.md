# maneuver

Simple PHP router, perfect for PoCs or getting started with small app up and running fast.

<img align="left" height="300" src="https://s18.postimg.org/asniim515/95c1255a-6605-4e0d-bfcc-848ea8e0819e.png">

``` php
use Maneuver\Router;

$r = new Router;
$r->register('GET', '/hello', Invokable::class);
$r->routeRequest();
```

---

[![Build Status](https://travis-ci.org/jopacicdev/maneuver.svg?branch=master)](https://travis-ci.org/jopacicdev/maneuver)
[![codecov](https://codecov.io/gh/jopacicdev/maneuver/branch/master/graph/badge.svg)](https://codecov.io/gh/jopacicdev/maneuver)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
