<?php

namespace Maneuver\Fixtures;

/**
 * Class TestHandler
 * @package Maneuver\Fixtures
 */
class TestHandler {

    public function __invoke()
    {
        echo 'Handler Invoked!';
    }
}
