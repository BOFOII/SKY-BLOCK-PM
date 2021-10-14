<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace ZAlpha\SkyBlock\command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use ZAlpha\SkyBlock\command\presets\AcceptCommand;
use ZAlpha\SkyBlock\command\presets\BlocksCommand;
use ZAlpha\SkyBlock\command\presets\CategoryCommand;
use ZAlpha\SkyBlock\command\presets\ChatCommand;
use ZAlpha\SkyBlock\command\presets\CooperateCommand;
use ZAlpha\SkyBlock\command\presets\CreateCommand;
use ZAlpha\SkyBlock\command\presets\DemoteCommand;
use ZAlpha\SkyBlock\command\presets\DenyCommand;
use ZAlpha\SkyBlock\command\presets\DisbandCommand;
use ZAlpha\SkyBlock\command\presets\FireCommand;
use ZAlpha\SkyBlock\command\presets\HelpCommand;
use ZAlpha\SkyBlock\command\presets\InviteCommand;
use ZAlpha\SkyBlock\command\presets\JoinCommand;
use ZAlpha\SkyBlock\command\presets\BanishCommand;
use ZAlpha\SkyBlock\command\presets\LeaveCommand;
use ZAlpha\SkyBlock\command\presets\LockCommand;
use ZAlpha\SkyBlock\command\presets\MembersCommand;
use ZAlpha\SkyBlock\command\presets\PromoteCommand;
use ZAlpha\SkyBlock\command\presets\SetSpawnCommand;
use ZAlpha\SkyBlock\command\presets\TransferCommand;
use ZAlpha\SkyBlock\command\presets\VisitCommand;
use ZAlpha\SkyBlock\session\SessionLocator;
use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\message\MessageContainer;

class IslandCommandMap extends Command {

    /** @var SkyBlock */
    private $plugin;

    /** @var IslandCommand[] */
    private $commands = [];

    public function __construct(SkyBlock $plugin) {
        $this->plugin = $plugin;
        parent::__construct("isle", "SkyBlock command", "Usage: /is", [
            "island",
            "is",
            "isle",
            "sb",
            "skyblock"
        ]);
        $plugin->getServer()->getCommandMap()->register("skyblock", $this);
    }

    /**
     * @return SkyBlock|Plugin
     */
    public function getPlugin(): Plugin {
        return $this->plugin;
    }

    /**
     * @return IslandCommand[]
     */
    public function getCommands(): array {
        return $this->commands;
    }

    public function getCommand(string $alias): ?IslandCommand {
        $alias = strtolower($alias);
        foreach($this->commands as $key => $command) {
            if(in_array($alias, $command->getAliases()) or $alias == strtolower($command->getName())) {
                return $command;
            }
        }
        return null;
    }

    public function registerCommand(IslandCommand $command): void {
        $this->commands[strtolower($command->getName())] = $command;
    }

    public function unregisterCommand(string $commandName): void {
        $name = strtolower($commandName);
        if(isset($this->commands[$name])) {
            unset($this->commands[$name]);
        }
    }

    public function registerDefaultCommands(): void {
        $this->registerCommand(new HelpCommand($this));
        $this->registerCommand(new CreateCommand($this));
        $this->registerCommand(new JoinCommand());
        $this->registerCommand(new LockCommand());
        $this->registerCommand(new ChatCommand());
        $this->registerCommand(new VisitCommand($this));
        $this->registerCommand(new LeaveCommand());
        $this->registerCommand(new MembersCommand());
        $this->registerCommand(new InviteCommand($this));
        $this->registerCommand(new AcceptCommand());
        $this->registerCommand(new DenyCommand());
        $this->registerCommand(new DisbandCommand($this));
        //$this->registerCommand(new BanishCommand($this));
        $this->registerCommand(new FireCommand($this));
        $this->registerCommand(new PromoteCommand());
        $this->registerCommand(new DemoteCommand());
        $this->registerCommand(new SetSpawnCommand());
        $this->registerCommand(new TransferCommand($this));
        $this->registerCommand(new CategoryCommand());
        $this->registerCommand(new BlocksCommand());
        $this->registerCommand(new CooperateCommand($this));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof Player) {
            $sender->sendMessage("Please, run this command in game");
            return;
        }

        $session = SessionLocator::getSession($sender);
        if(isset($args[0]) and $this->getCommand($args[0]) != null) {
            $this->getCommand(array_shift($args))->onCommand($session, $args);
        } else {
            $session->sendTranslatedMessage(new MessageContainer("TRY_USING_HELP"));
        }
    }

}