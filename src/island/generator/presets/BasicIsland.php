<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\island\generator\presets;

use pocketmine\block\VanillaBlocks;
use pocketmine\math\Vector3;
use pocketmine\world\ChunkManager;
use ZAlpha\SkyBlock\island\generator\IslandGenerator;

class BasicIsland extends IslandGenerator {

    public function getName(): string {
        return "Basic";
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void {
        if($chunkX == 0 && $chunkZ == 0) {
            for($x = 6; $x < 12; $x++) {
                for($z = 6; $z < 12; $z++) {
                    $world->setBlockAt($x, 61, $z, VanillaBlocks::DIRT());
                    $world->setBlockAt($x, 62, $z, VanillaBlocks::DIRT());
                    $world->setBlockAt($x, 63, $z, VanillaBlocks::GRASS());
                }
            }
            for($airX = 9; $airX < 12; $airX++) {
                for($airZ = 9; $airZ < 12; $airZ++) {
                    $world->setBlockAt($airX, 61, $airZ, VanillaBlocks::AIR());
                    $world->setBlockAt($airX, 62, $airZ, VanillaBlocks::AIR());
                    $world->setBlockAt($airX, 63, $airZ, VanillaBlocks::AIR());
                }
            }
//            $random = new Random();
//            $tree = new OakTree();
//            $tree->canPlaceObject($world, 11, 64, 6, $random);
            $world->setBlockAt(8, 64, 7, VanillaBlocks::CHEST());
        }
        if($chunkX == 4 and $chunkZ == 0) {
            for($x = 6; $x < 11; $x++) {
                for($z = 6; $z < 11; $z++) {
                    for($y = 60; $y < 65; $y++) {
                        $world->setBlockAt($x, $y, $z, VanillaBlocks::SAND());
                    }
                }
            }
            $world->setBlockAt(8, 65, 8, VanillaBlocks::CACTUS());
        }
    }

    public static function getWorldSpawn(): Vector3 {
        return new Vector3(8, 35, 8);
    }

    public static function getChestPosition(): Vector3 {
        return new Vector3(6, 35, 8);
    }

}
