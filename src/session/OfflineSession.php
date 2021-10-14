<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\session;



class OfflineSession extends BaseSession {

    public function getOnlineSession(): ?Session {
        $player = $this->manager->getPlugin()->getServer()->getPlayerExact($this->lowerCaseName);
        if($player != null) {
            return $this->manager->getSession($player);
        }
        return null;
    }

}