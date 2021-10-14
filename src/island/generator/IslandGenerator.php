<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\island\generator;


use pocketmine\world\ChunkManager;
use pocketmine\world\generator\Generator;
use pocketmine\math\Vector3;

abstract class IslandGenerator extends Generator {

    public function __construct(int $seed, string $preset) {
        parent::__construct($seed, $preset);
    }

    public function populateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {
        return;
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {}

    public abstract static function getWorldSpawn(): Vector3;

    public abstract static function getChestPosition(): Vector3;

}