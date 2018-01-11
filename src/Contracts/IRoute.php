<?php

namespace Maneuver\Contracts;

/**
 * Interface IRoute
 * @package Maneuver\Contracts
 */
interface IRoute
{
    /**
     * @return mixed
     */
    public function handle();

    /**
     * @return string
     */
    public function getRoute() : string;

    /**
     * @return string
     */
    public function getVerb() : string;

    /**
     * @return string|callable
     */
    public function getHandler();
}