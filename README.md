# maneuver

Simple PHP router, perfect for PoCs or getting started with small app up and running fast.

<img align="left" height="200" src="https://jopacicdev-public.s3.amazonaws.com/63719856-b017-4ba9-9c68-e7bb71a7b6a6_200x200.png">

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
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/97fe7076834742c0b59dd56e46a28563)](https://www.codacy.com/app/josip.opacic/maneuver?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=jopacicdev/maneuver&amp;utm_campaign=Badge_Grade)
