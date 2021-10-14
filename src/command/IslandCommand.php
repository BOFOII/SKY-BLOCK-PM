<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\command;


use ZAlpha\SkyBlock\island\RankIds;
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

abstract class IslandCommand {

    public function getAliases(): array {
        return [];
    }

    public function checkIsland(Session $session): bool {
        if($session->hasIsland()) {
            return false;
        }
        $session->sendTranslatedMessage(new MessageContainer("NEED_ISLAND"));
        return true;
    }

    public function checkFounder(Session $session): bool {
        if($this->checkIsland($session)) {
            return true;
        } elseif($session->getRank() == RankIds::FOUNDER) {
            return false;
        }
        $session->sendTranslatedMessage(new MessageContainer("MUST_BE_FOUNDER"));
        return true;
    }

    public function checkLeader(Session $session): bool {
        if($this->checkIsland($session)) {
            return true;
        } elseif($session->getRank() == RankIds::FOUNDER or $session->getRank() == RankIds::LEADER) {
            return false;
        }
        $session->sendTranslatedMessage(new MessageContainer("MUST_BE_LEADER"));
        return true;
    }

    public function checkOfficer(Session $session): bool {
        if($this->checkIsland($session)) {
            return true;
        } elseif($session->getRank() != RankIds::MEMBER) {
            return false;
        }
        $session->sendTranslatedMessage(new MessageContainer("MUST_BE_OFFICER"));
        return true;
    }

    public function checkClone(?Session $session, ?Session $ySession): bool {
        if($session === $ySession) {
            $session->sendTranslatedMessage(new MessageContainer("CANT_BE_YOURSELF"));
            return true;
        }
        return false;
    }

    public abstract function getName(): string;

    public abstract function getUsageMessageContainer(): MessageContainer;

    public abstract function getDescriptionMessageContainer(): MessageContainer;

    public abstract function onCommand(Session $session, array $args): void;

}