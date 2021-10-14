<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\island\generator\presets;

use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\world\ChunkManager;
use pocketmine\world\generator\object\Tree;
use pocketmine\math\Vector3;
use ZAlpha\SkyBlock\island\generator\IslandGenerator;

class OPIsland extends IslandGenerator
{

    public function getName(): string
    {
        return "OP";
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
    {
        if ($chunkX == 0 && $chunkZ == 0) {
            for ($x = 0; $x < 16; $x++) {
                for ($z = 0; $z < 16; $z++) {
                    $world->setBlockAt($x, 0, $z, VanillaBlocks::BEDROCK());
                    for ($y = 1; $y <= 3; $y++) {
                        $world->setBlockAt($x, $y, $z, VanillaBlocks::STONE());
                    }
                    $world->setBlockAt($x, 4, $z, VanillaBlocks::DIRT());
                    $world->setBlockAt($x, 5, $z, VanillaBlocks::GRASS());
                }
            }
            $world->setBlockAt(10, 6, 8, VanillaBlocks::CHEST());
        }
    }

    public static function getWorldSpawn(): Vector3
    {
        return new Vector3(8, 7, 10);
    }

    public static function getChestPosition(): Vector3
    {
        return new Vector3(10, 6, 8);
    }
}
