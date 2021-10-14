<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\command\presets;


use ZAlpha\SkyBlock\island\RankIds;
use ZAlpha\SkyBlock\session\OfflineSession;
use ZAlpha\SkyBlock\session\SessionLocator;
use ZAlpha\SkyBlock\command\IslandCommand;
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class DemoteCommand extends IslandCommand {

    public function getName(): string {
        return "demote";
    }

    public function getUsageMessageContainer(): MessageContainer {
        return new MessageContainer("DEMOTE_USAGE");
    }

    public function getDescriptionMessageContainer(): MessageContainer {
        return new MessageContainer("DEMOTE_DESCRIPTION");
    }

    public function onCommand(Session $session, array $args): void {
        if($this->checkLeader($session) or $this->checkArgs($session, $args)) {
            return;
        }

        $offlineSession = SessionLocator::getOfflineSession($args[0]);
        if($this->checkClone($session, $offlineSession->getOnlineSession()) or $this->checkDifferentIsland($session, $offlineSession)) {
            return;
        }

        $lowerRank = $this->getLowerRank($offlineSession->getRank());

        if($lowerRank !== null) {
            $offlineSession->setRank($lowerRank);
            $offlineSession->save();
            $this->sendDemoteMessage($offlineSession);

            $session->sendTranslatedMessage(new MessageContainer("SUCCESSFULLY_DEMOTED_PLAYER", [
                "name" => $args[0],
                "to" => $session->getMessage(new MessageContainer($this->getRankName($lowerRank)))
            ]));
        } elseif($offlineSession->getRank() == RankIds::FOUNDER) {
            $session->sendTranslatedMessage(new MessageContainer("CANNOT_DEMOTE_FOUNDER"));
        } else {
            $session->sendTranslatedMessage(new MessageContainer("CANNOT_DEMOTE_MEMBER", [
                "name" => $args[0]
            ]));
        }
    }

    private function sendDemoteMessage(OfflineSession $session): void {
        $online = $session->getOnlineSession();
        if($online != null) {
            $online->sendTranslatedMessage(new MessageContainer("YOU_HAVE_BEEN_DEMOTED"));
        }
    }

    private function getLowerRank(int $rank): ?int {
        switch($rank) {
            case RankIds::OFFICER:
                return RankIds::MEMBER;
            case RankIds::LEADER:
                return RankIds::OFFICER;
        }
        return null;
    }

    private function getRankName(int $rank): ?string {
        switch($rank) {
            case RankIds::MEMBER:
                return "MEMBER";
            case RankIds::OFFICER:
                return "OFFICER";
            case RankIds::LEADER:
                return "LEADER";
            case RankIds::FOUNDER:
                return "FOUNDER";
        }
        return null;
    }

    private function checkArgs(Session $session, array $args): bool {
        if(count($args) < 1) {
            $session->sendTranslatedMessage(new MessageContainer("DEMOTE_USAGE"));
            return true;
        }
        return false;
    }

    private function checkDifferentIsland(Session $session, OfflineSession $offlineSession): bool {
        if($offlineSession->getIslandId() != $session->getIslandId()) {
            $session->sendTranslatedMessage(new MessageContainer("MUST_BE_PART_OF_YOUR_ISLAND", [
                "name" => $offlineSession->getLowerCaseName()
            ]));
            return true;
        }
        return false;
    }

}