<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock;

use pocketmine\plugin\PluginBase;
use ZAlpha\SkyBlock\command\IslandCommandMap;
use ZAlpha\SkyBlock\island\generator\IslandGeneratorManager;
use ZAlpha\SkyBlock\island\IslandManager;
use ZAlpha\SkyBlock\provider\json\JSONProvider;
use ZAlpha\SkyBlock\provider\Provider;
use ZAlpha\SkyBlock\session\SessionManager;
use ZAlpha\SkyBlock\utils\message\MessageManager;

class SkyBlock extends PluginBase
{

    /** @var SkyBlock */
    private static $instance;

    /** @var SkyBlockSettings */
    private $settings;

    /** @var Provider */
    private $provider;

    /** @var SessionManager */
    private $sessionManager;

    /** @var IslandManager */
    private $islandManager;

    /** @var IslandCommandMap */
    private $commandMap;

    /** @var IslandGeneratorManager */
    private $generatorManager;

    /** @var MessageManager */
    private $messageManager;

    public $generators = [];

    public static function getInstance(): SkyBlock
    {
        return self::$instance;
    }

    public function onLoad(): void
    {
        self::$instance = $this;
        if (!is_dir($dataFolder = $this->getDataFolder())) {
            mkdir($dataFolder);
        }
        $this->saveResource("messages.json");
        $this->saveResource("settings.yml");
    }

    public function onEnable(): void
    {
        $this->settings = new SkyBlockSettings($this);
        $this->provider = new JSONProvider($this);
        $this->sessionManager = new SessionManager($this);
        $this->islandManager = new IslandManager($this);
        $this->generatorManager = new IslandGeneratorManager($this);
        $this->messageManager = new MessageManager($this);
        $this->commandMap = new IslandCommandMap($this);
        $this->commandMap->registerDefaultCommands();
    }

    public function onDisable(): void
    {
        foreach ($this->islandManager->getIslands() as $island) {
            $island->save();
        }

        foreach ($this->sessionManager->getSessions() as $session) {
            $session->save();
        }
    }

    public function getSettings(): SkyBlockSettings
    {
        return $this->settings;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function getSessionManager(): SessionManager
    {
        return $this->sessionManager;
    }

    public function getIslandManager(): IslandManager
    {
        return $this->islandManager;
    }

    public function getGeneratorManager(): IslandGeneratorManager
    {
        return $this->generatorManager;
    }

    public function getMessageManager(): MessageManager
    {
        return $this->messageManager;
    }

    public function getCommandMap(): IslandCommandMap
    {
        return $this->commandMap;
    }

}