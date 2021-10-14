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

class ChatCommand extends IslandCommand {

    public function getName(): string {
        return "chat";
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("CHAT_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("CHAT_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if($this->checkIsland($session)) {
            return;
        }
        $session->setInChat(!$session->isInChat());
        $session->sendTranslatedMessage(new MessageContainer($session->isInChat() ? "JOINED_ISLAND_CHAT" : "JOINED_GLOBAL_CHAT"));
    }

}