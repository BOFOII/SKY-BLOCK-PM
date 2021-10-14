<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\command\presets;


use ZAlpha\SkyBlock\command\IslandCommand;
use ZAlpha\SkyBlock\command\IslandCommandMap;
use ZAlpha\SkyBlock\island\IslandFactory;
use ZAlpha\SkyBlock\island\IslandManager;
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class DisbandCommand extends IslandCommand {

    /** @var IslandManager */
    private $islandManager;

    public function __construct(IslandCommandMap $map) {
        $this->islandManager = $map->getPlugin()->getIslandManager();
    }

    public function getName(): string {
        return "disband";
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("DISBAND_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("DISBAND_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if($this->checkFounder($session)) {
            return;
        }
        IslandFactory::disbandIsland($session->getIsland());
    }

}
