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
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class VisitCommand extends IslandCommand {

    /** @var SkyBlock */
    private $plugin;

    public function __construct(IslandCommandMap $map) {
        $this->plugin = $map->getPlugin();
    }

    public function getName(): string {
        return "visit";
    }

    public function getAliases(): array {
        return ["teleport", "tp"];
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("VISIT_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("VISIT_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if(!isset($args[0])) {
            $session->sendTranslatedMessage(new MessageContainer("VISIT_USAGE"));
            return;
        }
        $offline = $this->plugin->getSessionManager()->getOfflineSession($args[0]);
        $islandId = $offline->getIslandId();
        if($islandId == null) {
            $session->sendTranslatedMessage(new MessageContainer("HE_DO_NOT_HAVE_AN_ISLAND", [
                "name" => $args[0]
            ]));
            return;
        }
        $this->plugin->getProvider()->loadIsland($islandId);
        $island = $this->plugin->getIslandManager()->getIsland($islandId);
        if($island->isLocked() and !($session->getPlayer()->isOp())) {
            $session->sendTranslatedMessage(new MessageContainer("HIS_ISLAND_IS_LOCKED", [
                "name" => $args[0]
            ]));
            $island->tryToClose();
            return;
        }
        $session->getPlayer()->teleport($island->getLevel()->getSpawnLocation());
        $session->sendTranslatedMessage(new MessageContainer("VISITING_ISLAND", [
            "name" => $args[0]
        ]));
    }

}