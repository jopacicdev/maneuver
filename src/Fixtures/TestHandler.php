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

    public function indexAction()
    {
        echo 'Controller Action Invoked!';
    }

    public static function staticHandler()
    {
        echo 'Static Handler Invoked!';
    }
}
