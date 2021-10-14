<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */


declare(strict_types=1);

namespace ZAlpha\SkyBlock\island;

use pocketmine\world\World;
use pocketmine\world\WorldCreationOptions;
use ZAlpha\SkyBlock\event\island\IslandCreateEvent;
use ZAlpha\SkyBlock\event\island\IslandDisbandEvent;
use ZAlpha\SkyBlock\island\generator\IslandGenerator;
use ZAlpha\SkyBlock\island\generator\presets\BasicIsland;
use ZAlpha\SkyBlock\island\generator\presets\ShellyGenerator;
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class IslandFactory
{

    public static function createIslandWorld(string $identifier, string $type): World
    {
        $skyblock = SkyBlock::getInstance();

        $generatorManager = $skyblock->getGeneratorManager();
        if ($generatorManager->isGenerator($type)) {
            $generator = $generatorManager->getGenerator($type);
        } else {
            $generator = $generatorManager->getGenerator("Basic");
        }

        $server = $skyblock->getServer();
        $server->getWorldManager()->generateWorld($identifier, WorldCreationOptions::create()->setGeneratorClass(ShellyGenerator::class)->setSpawnPosition($generator::getWorldSpawn()));
        $server->getWorldManager()->loadWorld($identifier);
        $world = $server->getWorldManager()->getWorldByName($identifier);
        return $world;
    }

    public static function createIslandFor(Session $session, string $type): void
    {
        $identifier = uniqid("sb-");
        $islandManager = SkyBlock::getInstance()->getIslandManager();

        $islandManager->openIsland(
            $identifier,
            [$session->getOfflineSession()],
            true,
            $type,
            self::createIslandWorld($identifier, $type),
            0
        );

        $session->setIsland($island = $islandManager->getIsland($identifier));
        $session->setRank(RankIds::FOUNDER);
        $session->setLastIslandCreationTime(microtime(true));

        $session->save();
        $island->save();

        (new IslandCreateEvent($island))->call();
    }

    public static function disbandIsland(Island $island): void
    {
        foreach ($island->getLevel()->getPlayers() as $player) {
            $player->teleport($player->getServer()->getWorldManager()->getDefaultWorld()->getSpawnLocation());
        }
        foreach ($island->getMembers() as $offlineMember) {
            $onlineSession = $offlineMember->getOnlineSession();
            if ($onlineSession != null) {
                $onlineSession->setIsland(null);
                $onlineSession->setRank(RankIds::MEMBER);
                $onlineSession->save();
                $onlineSession->sendTranslatedMessage(new MessageContainer("ISLAND_DISBANDED"));
            } else {
                $offlineMember->setIslandId(null);
                $offlineMember->setRank(RankIds::MEMBER);
                $offlineMember->save();
            }
        }
        $island->setMembers([]);
        $island->save();
        SkyBlock::getInstance()->getIslandManager()->closeIsland($island);
        (new IslandDisbandEvent($island))->call();
    }
}
