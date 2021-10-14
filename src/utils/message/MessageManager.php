<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\utils\message;


use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\Utils;

class MessageManager {

    /** @var string[] */
    private $messages;

    public function __construct(SkyBlock $plugin) {
        $this->messages = json_decode(file_get_contents($plugin->getDataFolder() . "messages.json"), true);
    }

    /**
     * @return string[]
     */
    public function getMessages(): array {
        return $this->messages;
    }

    public function getMessage(MessageContainer $container): string {
        $identifier = $container->getId();
        $message = $this->messages[$identifier] ?? "Message ($identifier) not found";
        $message = Utils::translateColors($message);
        $arryv = '';
        $palue = '';
        foreach($container->getArgs() as $arg => $value) {
            $arryv = $arg;
            $palue = $value;
            //$message = str_replace("{" . $arg . "}", $value, $message);
        }
        return $message . $arryv . $palue;
    }

    public function addMessage(string $identifier, string $message): void {
        $this->messages[$identifier] = $message;
    }

}