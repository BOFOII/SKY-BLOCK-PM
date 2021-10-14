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

class PalmIsland extends IslandGenerator
{

    public function getName(): string
    {
        return "Palm";
    }

    public function generateChunk(ChunkManager $world, int $chunkX, int $chunkZ): void
    {
        if ($chunkX == 0 and $chunkZ == 0) {
            $world->setBlockAt(9, 39, 4, VanillaBlocks::SAND());
            $world->setBlockAt(8, 37, 4, VanillaBlocks::SAND());
            $world->setBlockAt(8, 35, 5, VanillaBlocks::SAND());
            $world->setBlockAt(8, 39, 4, VanillaBlocks::SAND());
            $world->setBlockAt(7, 39, 4, VanillaBlocks::SAND());
            $world->setBlockAt(10, 39, 5, VanillaBlocks::SAND());
            $world->setBlockAt(10, 39, 6, VanillaBlocks::END_STONE_BRICKS());
            $world->setBlockAt(11, 39, 7, VanillaBlocks::SAND());
            $world->setBlockAt(11, 39, 8, VanillaBlocks::END_STONE_BRICKS());
            $world->setBlockAt(10, 39, 8, VanillaBlocks::SAND());
            $world->setBlockAt(11, 39, 9, VanillaBlocks::SAND());
            $world->setBlockAt(10, 39, 9, VanillaBlocks::SAND());
            $world->setBlockAt(9, 39, 9, VanillaBlocks::END_STONE_BRICKS());
            $world->setBlockAt(10, 39, 10, VanillaBlocks::SAND());
            $world->setBlockAt(9, 39, 10, VanillaBlocks::GOLD());
            $world->setBlockAt(9, 39, 11, VanillaBlocks::SAND());
            $world->setBlockAt(8, 39, 10, VanillaBlocks::SAND());
            $world->setBlockAt(8, 39, 9, VanillaBlocks::SAND());
            $world->setBlockAt(7, 39, 10, VanillaBlocks::SAND());
            $world->setBlockAt(8, 39, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 39, 5, VanillaBlocks::END_STONE_BRICKS());
            $world->setBlockAt(6, 39, 8, VanillaBlocks::END_STONE_BRICKS());
            $world->setBlockAt(6, 39, 5, VanillaBlocks::SAND());
            $world->setBlockAt(6, 39, 6, VanillaBlocks::SAND());
            $world->setBlockAt(6, 39, 7, VanillaBlocks::SAND());
            $world->setBlockAt(5, 39, 7, VanillaBlocks::SAND());
            $world->setBlockAt(5, 39, 8, VanillaBlocks::SAND());
            $world->setBlockAt(5, 39, 9, VanillaBlocks::SAND());
            $world->setBlockAt(6, 39, 9, VanillaBlocks::SAND());
            $world->setBlockAt(6, 39, 10, VanillaBlocks::SAND());
            $world->setBlockAt(7, 39, 8, VanillaBlocks::SAND());
            $world->setBlockAt(7, 39, 10, VanillaBlocks::SAND());
            $world->setBlockAt(7, 39, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 39, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(7, 39, 6, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 39, 8, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 39, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 39, 6, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 39, 5, VanillaBlocks::WATER()
            );
            $world->setBlockAt(9, 39, 8, VanillaBlocks::WATER()
            );
            $world->setBlockAt(9, 39, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(10, 39, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(9, 39, 6, VanillaBlocks::WATER()
            );
            $world->setBlockAt(9, 39, 5, VanillaBlocks::WATER()
            );
            $world->setBlockAt(10, 38, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 38, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 38, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 38, 7, VanillaBlocks::WATER()
            );
            $world->setBlockAt(7, 38, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 38, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 38, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 6, VanillaBlocks::WATER()
            );
            $world->setBlockAt(8, 38, 6, VanillaBlocks::WATER()
            );
            $world->setBlockAt(7, 38, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 38, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 38, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 5, VanillaBlocks::WATER()
            );
            $world->setBlockAt(7, 38, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 38, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 38, 4, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 38, 4, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 38, 4, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 37, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 37, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 37, 9, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(11, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(5, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 37, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(6, 37, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 37, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 37, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 37, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 36, 11, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 36, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 36, 10, VanillaBlocks::STONE());
            $world->setBlockAt(8, 36, 10, VanillaBlocks::STONE());
            $world->setBlockAt(7, 36, 10, VanillaBlocks::STONE());
            $world->setBlockAt(6, 36, 10, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 36, 9, VanillaBlocks::STONE());
            $world->setBlockAt(9, 36, 9, VanillaBlocks::STONE());
            $world->setBlockAt(8, 36, 9, VanillaBlocks::STONE());
            $world->setBlockAt(7, 36, 9, VanillaBlocks::STONE());
            $world->setBlockAt(6, 36, 9, VanillaBlocks::STONE());
            $world->setBlockAt(11, 36, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 36, 8, VanillaBlocks::STONE());
            $world->setBlockAt(9, 36, 8, VanillaBlocks::STONE());
            $world->setBlockAt(8, 36, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 36, 8, VanillaBlocks::STONE());
            $world->setBlockAt(6, 36, 8, VanillaBlocks::STONE());
            $world->setBlockAt(5, 36, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(10, 36, 7, VanillaBlocks::STONE());
            $world->setBlockAt(9, 36, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 36, 7, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(7, 36, 7, VanillaBlocks::STONE());
            $world->setBlockAt(6, 36, 7, VanillaBlocks::STONE());
            $world->setBlockAt(10, 36, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 36, 6, VanillaBlocks::STONE());
            $world->setBlockAt(8, 36, 6, VanillaBlocks::STONE());
            $world->setBlockAt(7, 36, 6, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(6, 36, 6, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 36, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 36, 5, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(8, 35, 10, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(9, 35, 9, VanillaBlocks::STONE());
            $world->setBlockAt(8, 35, 9, VanillaBlocks::STONE());
            $world->setBlockAt(7, 35, 9, VanillaBlocks::STONE());
            $world->setBlockAt(6, 35, 9, VanillaBlocks::STONE());
            $world->setBlockAt(10, 35, 8, VanillaBlocks::STONE());
            $world->setBlockAt(9, 35, 8, VanillaBlocks::STONE());
            $world->setBlockAt(8, 35, 8, VanillaBlocks::STONE());
            $world->setBlockAt(7, 35, 8, VanillaBlocks::STONE());
            $world->setBlockAt(6, 35, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(5, 35, 8, VanillaBlocks::SANDSTONE());
            $world->setBlockAt(9, 35, 7, VanillaBlocks::STONE());
            $world->setBlockAt(8, 35, 7, VanillaBlocks::STONE());
            $world->setBlockAt(7, 35, 7, VanillaBlocks::STONE());
            $world->setBlockAt(8, 35, 6, VanillaBlocks::STONE());
            $world->setBlockAt(9, 34, 9, VanillaBlocks::STONE());
            $world->setBlockAt(8, 34, 9, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(7, 34, 9, VanillaBlocks::STONE());
            $world->setBlockAt(9, 34, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(8, 34, 8, VanillaBlocks::STONE());
            $world->setBlockAt(7, 34, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(6, 34, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(8, 34, 7, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(8, 33, 9, VanillaBlocks::STONE());
            $world->setBlockAt(8, 33, 8, VanillaBlocks::STONE());
            $world->setBlockAt(9, 33, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(7, 33, 8, VanillaBlocks::STONE());
            $world->setBlockAt(8, 33, 7, VanillaBlocks::STONE());
            $world->setBlockAt(8, 32, 9, VanillaBlocks::STONE());
            $world->setBlockAt(8, 32, 8, VanillaBlocks::STONE());
            $world->setBlockAt(9, 32, 8, VanillaBlocks::STONE());
            $world->setBlockAt(8, 31, 8, VanillaBlocks::COBBLESTONE());
            $world->setBlockAt(8, 30, 8, VanillaBlocks::STONE());
            $world->setBlockAt(8, 29, 8, VanillaBlocks::STONE());
            $world->setBlockAt(7, 40, 8, VanillaBlocks::CHEST());
            $world->setBlockAt(5, 47, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 47, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 47, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(9, 47, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 47, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 47, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 47, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 47, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(9, 47, 7, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 47, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 47, 9, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 47, 9, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(9, 47, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 47, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(9, 47, 9, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 47, 9, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 47, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 47, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 47, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 47, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 47, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 47, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 46, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 3, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 6, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(4, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(4, 46, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 46, 5, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(4, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 46, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 46, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(6, 46, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 10, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 46, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(11, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(10, 46, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 46, 8, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(12, 45, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 45, 2, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 45, 3, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(4, 45, 4, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(3, 45, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(4, 45, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(5, 45, 11, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 45, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 45, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(13, 45, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(13, 45, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(12, 45, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 45, 8, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(8, 44, 2, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(3, 44, 8, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(8, 44, 12, VanillaBlocks::JUNGLE_LEAVES());
            $world->setBlockAt(7, 44, 7, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(6, 43, 7, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(6, 42, 7, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(6, 41, 8, VanillaBlocks::JUNGLE_LOG());
            $world->setBlockAt(6, 40, 8, VanillaBlocks::JUNGLE_LOG());
        }
    }

    public static function getWorldSpawn(): Vector3
    {
        return new Vector3(9, 40, 11);
    }

    public static function getChestPosition(): Vector3
    {
        return new Vector3(7, 40, 8);
    }
}
