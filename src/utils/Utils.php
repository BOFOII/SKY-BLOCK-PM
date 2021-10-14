<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\utils;


use pocketmine\item\ItemFactory;
use pocketmine\utils\TextFormat;
use pocketmine\world\generator\GeneratorManager;
use ZAlpha\SkyBlock\island\generator\presets\BasicIsland;
use ZAlpha\SkyBlock\island\generator\presets\ShellyGenerator;

class Utils {

    public static function parseItems(array $items): array {
        return array_filter(array_map("self::parseItem", $items), function($value) {
            return $value != null;
        });
    }

//    public static function parseItem(string $item): ?ItemFactory {
//        $itemfactory = new ItemFactory();
//        $parts = array_map("intval", explode(",", str_replace(" ", "", $item)));
//        return (count($parts) > 0) ? $itemfactory->get($parts[0], $parts[1] ?? 0, $parts[2] ?? 1) : null;
//    }

    public static function translateColors(string $message): string {
        $message = str_replace("&", TextFormat::ESCAPE, $message);
        $message = str_replace("{BLACK}", TextFormat::BLACK, $message);
        $message = str_replace("{DARK_BLUE}", TextFormat::DARK_BLUE, $message);
        $message = str_replace("{DARK_GREEN}", TextFormat::DARK_GREEN, $message);
        $message = str_replace("{DARK_AQUA}", TextFormat::DARK_AQUA, $message);
        $message = str_replace("{DARK_RED}", TextFormat::DARK_RED, $message);
        $message = str_replace("{DARK_PURPLE}", TextFormat::DARK_PURPLE, $message);
        $message = str_replace("{ORANGE}", TextFormat::GOLD, $message);
        $message = str_replace("{GRAY}", TextFormat::GRAY, $message);
        $message = str_replace("{DARK_GRAY}", TextFormat::DARK_GRAY, $message);
        $message = str_replace("{BLUE}", TextFormat::BLUE, $message);
        $message = str_replace("{GREEN}", TextFormat::GREEN, $message);
        $message = str_replace("{AQUA}", TextFormat::AQUA, $message);
        $message = str_replace("{RED}", TextFormat::RED, $message);
        $message = str_replace("{LIGHT_PURPLE}", TextFormat::LIGHT_PURPLE, $message);
        $message = str_replace("{YELLOW}", TextFormat::YELLOW, $message);
        $message = str_replace("{WHITE}", TextFormat::WHITE, $message);
        $message = str_replace("{OBFUSCATED}", TextFormat::OBFUSCATED, $message);
        $message = str_replace("{BOLD}", TextFormat::BOLD, $message);
        $message = str_replace("{STRIKETHROUGH}", TextFormat::STRIKETHROUGH, $message);
        $message = str_replace("{UNDERLINE}", TextFormat::UNDERLINE, $message);
        $message = str_replace("{ITALIC}", TextFormat::ITALIC, $message);
        $message = str_replace("{RESET}", TextFormat::RESET, $message);
        return $message;
    }

    public static function getGeneratorByName(string $name): ?string {
        switch (strtolower($name)) {
            case "basic":
                return ShellyGenerator::class;
            case "sky":
                return ShellyGenerator::class;
        }

        try {
            return GeneratorManager::getInstance()->getGenerator($name, true);
        } catch (\InvalidArgumentException $e) {}

        return null;
    }

}