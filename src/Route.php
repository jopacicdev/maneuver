<?php

namespace Maneuver;

class Route
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    private $verb;
    private $route;
    private $handler;

    public function __construct(string $verb, string $route, string $handler)
    {
        $this->verb = $verb;
        $this->route = $route;
        $this->handler = $handler;
    }

    public function getVerb() : string
    {
        return $this->verb;
    }

    public function getRoute() : string
    {
        return $this->route;
    }

    public function getHandler() : string
    {
        return $this->handler;
    }

    public function handle()
    {
        $handler = $this->getHandler();
        $instance = new $handler;

        $instance();
    }

    public static function isValid(string $verb) : bool
    {
        return in_array($verb, self::getVerbs(), false);
    }

    public static function getVerbs() : array
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}