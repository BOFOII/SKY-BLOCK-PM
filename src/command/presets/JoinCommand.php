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
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class JoinCommand extends IslandCommand {

    public function getName(): string {
        return "join";
    }

    public function getAliases(): array {
        return ["go", "spawn"];
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("JOIN_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("JOIN_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if($this->checkIsland($session)) {
            return;
        }
        $session->getPlayer()->teleport($session->getIsland()->getLevel()->getSpawnLocation());
        $session->sendTranslatedMessage(new MessageContainer("TELEPORTED_TO_ISLAND"));
    }

}