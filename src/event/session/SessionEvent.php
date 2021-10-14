<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\event\session;


use ZAlpha\SkyBlock\event\SkyBlockEvent;
use ZAlpha\SkyBlock\session\Session;

abstract class SessionEvent extends SkyBlockEvent {

    /** @var Session */
    private $session;

    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function getSession(): Session {
        return $this->session;
    }

}