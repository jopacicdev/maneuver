<?php

namespace Maneuver;

use Maneuver\Contracts\IRoute;

class Route implements IRoute
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const DELETE = 'DELETE';

    /**
     * @var string
     */
    private $verb;
    /**
     * @var string
     */
    private $route;
    /**
     * @var string|callable
     */
    private $handler;

    /**
     * Route constructor.
     * @param string $verb
     * @param string $route
     * @param string|callable $handler
     */
    public function __construct(string $verb, string $route, $handler)
    {
        $this->verb = $verb;
        $this->route = (strpos($this->route, '/') === 0 ? '' : '/') . $route;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getVerb() : string
    {
        return $this->verb;
    }

    /**
     * @return string
     */
    public function getRoute() : string
    {
        return $this->route;
    }

    /**
     * @return string|callable
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Do the mojo!
     */
    public function handle()
    {
        $handler = $this->getHandler();

        if (is_callable($handler)) {
            $handler();
        } else if (strpos($handler, '@')) {
            $parts = explode('@', $handler);
            list($controller, $action) = $parts;
            $instance = new $controller;
            $instance->{$action}();
        } else {
            $instance = new $handler;
            $instance();
        }
    }

    /**
     * @param string $verb
     * @return bool
     */
    public static function isValid(string $verb) : bool
    {
        return in_array($verb, self::getVerbs(), false);
    }

    /**
     * @return array
     */
    public static function getVerbs() : array
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}
