<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\island\generator;

use pocketmine\world\generator\GeneratorManager;
use pocketmine\permission\Permission;
use pocketmine\permission\PermissionManager;
use ZAlpha\SkyBlock\island\generator\presets\BasicIsland;
use ZAlpha\SkyBlock\island\generator\presets\LostIsland;
use ZAlpha\SkyBlock\island\generator\presets\OPIsland;
use ZAlpha\SkyBlock\island\generator\presets\PalmIsland;
use ZAlpha\SkyBlock\island\generator\presets\ShellyGenerator;
use ZAlpha\SkyBlock\SkyBlock;

class IslandGeneratorManager {

    /** @var SkyBlock */
    private $plugin;

    /** @var IslandGenerator[]|string[] */
    private $generators = [];

    /**
     * GeneratorManager constructor.
     * @param SkyBlock $plugin
     */
    public function __construct(SkyBlock $plugin) {
        $this->plugin = $plugin;
        $this->registerDefaultGenerators();
    }

    /**
     * Returns the name of all the generators
     *
     * @return string[]
     */
    public function getGenerators(): array {
        return $this->generators;
    }

    /**
     * @param string $name
     * @return null|string|IslandGenerator
     */
    public function getGenerator(string $name): ?string {
        return $this->generators[strtolower($name)] ?? null;
    }

    public function isGenerator(string $name): bool {
        return isset($this->generators[strtolower($name)]);
    }

    private function registerGeneratorPermission(string $name): void {
        PermissionManager::getInstance()->addPermission(new Permission("skyblock.island.". $name));
    }

    public function registerDefaultGenerators(): void {
        $this->generators = [
            "shelly" => ShellyGenerator::class,
            "palm" => PalmIsland::class,
            "op" => OPIsland::class,
            "lost" => LostIsland::class,
            "basic" => BasicIsland::class
        ];
        foreach ($this->generators as $name => $class) {
            GeneratorManager::getInstance()->addGenerator($class, $name, true);
            if(isset($this->generators[$name])) {
                $this->plugin->getLogger()->debug("Overwriting generator: $name");
            }
            $this->registerGeneratorPermission($name);
        }
    }
}