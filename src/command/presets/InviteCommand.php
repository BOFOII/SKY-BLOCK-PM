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
use ZAlpha\SkyBlock\session\SessionLocator;
use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\Invitation;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class InviteCommand extends IslandCommand {

    /** @var SkyBlock */
    private $plugin;

    public function __construct(IslandCommandMap $map) {
        $this->plugin = $map->getPlugin();
    }

    public function getName(): string {
        return "invite";
    }

    public function getAliases(): array {
        return ["inv"];
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("INVITE_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("INVITE_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if($this->checkOfficer($session)) {
            return;
        } elseif(!isset($args[0])) {
            $session->sendTranslatedMessage(new MessageContainer("INVITE_USAGE"));
            return;
        } elseif(count($session->getIsland()->getMembers()) >= $session->getIsland()->getSlots()) {
            $island = $session->getIsland();
            $next = $island->getNextCategory();
            if($next != null) {
                $session->sendTranslatedMessage(new MessageContainer("ISLAND_IS_FULL_BUT_YOU_CAN_UPGRADE", [
                    "next" => $next
                ]));
            } else {
                $session->sendTranslatedMessage(new MessageContainer("ISLAND_IS_FULL"));
            }
            return;
        }
        $player = $this->plugin->getServer()->getPlayer($args[0]);
        if($player == null) {
            $session->sendTranslatedMessage(new MessageContainer("NOT_ONLINE_PLAYER", [
                "name" => $args[0]
            ]));
            return;
        }
        $playerSession = SessionLocator::getSession($player);
        if($this->checkClone($session, $playerSession)) {
            return;
        } elseif($playerSession->hasIsland()) {
            $session->sendTranslatedMessage(new MessageContainer("CANNOT_INVITE_BECAUSE_HAS_ISLAND", [
                "name" => $player->getName()
            ]));
            return;
        }
        Invitation::send($session, $playerSession);
    }

}