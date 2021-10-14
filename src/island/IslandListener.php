<?php

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */


declare(strict_types=1);

namespace ZAlpha\SkyBlock\island;


use pocketmine\block\Solid;
use pocketmine\block\tile\Chest;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerBedEnterEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\item\ItemIds;
use pocketmine\player\Player;
use pocketmine\Server;
use ZAlpha\SkyBlock\island\generator\IslandGenerator;
use ZAlpha\SkyBlock\session\Session;
use ZAlpha\SkyBlock\session\SessionLocator;
use ZAlpha\SkyBlock\SkyBlock;
use ZAlpha\SkyBlock\utils\message\MessageContainer;
use ZAlpha\SkyBlock\utils\Utils;

class IslandListener implements Listener
{
    use CancellableTrait;

    /** @var IslandManager */
    private $manager;

    /** @var SkyBlock */
    private $plugin;

    public function __construct(IslandManager $manager)
    {
        $this->manager = $manager;
        $this->plugin = $manager->getPlugin();
    }

    /**
     * Prevents players from breaking blocks on others property
     */
    public function onBreak(BlockBreakEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        if (($island = $session->getIslandByLevel()) == null) {
            return;
        }
        $this->checkPermissionToInteract($island, $session, $event);
        if (!$this->isCancelled() and $event->getBlock() instanceof Solid) {
            $island->destroyBlock();
        }
    }

    private function checkPermissionToInteract(Island $island, Session $session, Cancellable $event)
    {
        if ($island->canInteract($session)) {
            return;
        }
        $session->sendTranslatedPopup(new MessageContainer("MUST_BE_MEMBER"));
        $this->cancel();
    }

    /**
     * Prevents players from placing blocks on others property
     */
    public function onPlace(BlockPlaceEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        if (($island = $session->getIslandByLevel()) == null) {
            return;
        }
        $this->checkPermissionToInteract($island, $session, $event);
        if (!$this->isCancelled() and $event->getBlock() instanceof Solid) {
            $island->addBlock();
        }
    }

    /**
     * Adds one to the block count if a new block is formed
     */
    public function onBlockForm(BlockFormEvent $event): void
    {
        $block = $event->getBlock();
        $island = $this->manager->getIsland($block->getWorld()->getDisplayName());
        if ($island != null and !$block instanceof Solid and $event->getNewState() instanceof Solid) {
            $island->addBlock();
        }
    }

    /**
     * Prevent players from interacting on others property
     */
    public function onInteract(PlayerInteractEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        $island = $session->getIslandByLevel();
        if ($island != null) {
            $this->checkPermissionToInteract($island, $session, $event);
        }
    }

    /**
     * Prevents players from sleeping on beds inside islands
     * This is known for causing unexpected behavior on the plugin
     */
    public function onEnterBed(PlayerBedEnterEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        if ($session->getIslandByLevel() != null) {
            $this->cancel();
        }
    }

    /**
     * Sends the message to the island private chat if the player is connected to it
     */
    public function onChat(PlayerChatEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        if (!$session->hasIsland() or !$session->isInChat()) {
            return;
        }
        $chatFormat = $this->plugin->getSettings()->getChatFormat();
        $chatFormat = str_replace("{username}", $session->getName(), $chatFormat);
        $chatFormat = str_replace("{message}", $event->getMessage(), $chatFormat);
        $chatFormat = Utils::translateColors($chatFormat);
        $event->setFormat($chatFormat);
        $event->setRecipients($session->getIsland()->getChattingPlayers());
    }

    /**
     * Prevent players from sending blocked commands inside islands
     */
    public function onCommand(PlayerCommandPreprocessEvent $event): void
    {
        $session = SessionLocator::getSession($event->getPlayer());
        $message = $event->getMessage();
        if ($session->getIslandByLevel() == null or $message[0] != "/") {
            return;
        }
        $command = strtolower(substr($message, 1));
        if (in_array($command, $this->plugin->getSettings()->getBlockedCommands())) {
            $session->sendTranslatedMessage(new MessageContainer("BLOCKED_COMMAND"));
            $this->cancel();
        }
    }

    /**
     * Makes sure nobody gets void damage if it's not enabled!
     */
    public function onDamage(EntityDamageEvent $event): void
    {
        $entity = $event->getEntity();
        $world = $entity->getWorld();

        if ($world == null) {
            return; // Basically a hack to prevent SkyBlock from crashing because of shitty poggit plugins
        }

        $island = $this->manager->getIslandByLevel($world);
        if ($island == null) {
            return;
        }

        if ($event instanceof EntityDamageByEntityEvent) {
            $this->onDamageByEntityInIsland($island, $event);
        } elseif ($event->getCause() == EntityDamageByEntityEvent::CAUSE_VOID and $this->plugin->getSettings()->isVoidDamageEnabled()) {
            $entity->teleport($island->getSpawnLocation());
            $this->cancel();
        }
    }

    /**
     * Prevents PvP inside islands and makes sure nobody can steal your paintings!
     */
    private function onDamageByEntityInIsland(Island $island, EntityDamageByEntityEvent $event): void
    {
        $entity = $event->getEntity();
        $damager = $event->getDamager();

        if ($entity instanceof Player) {
            $this->cancel();
        } elseif ($damager instanceof Player) {
            $this->checkPermissionToInteract($island, SessionLocator::getSession($damager), $event);
        }
    }

    /**
     * Removes the player as cooperator if possible and tries to close their island
     */
    public function onQuit(PlayerQuitEvent $event): void
    {
        $player = $event->getPlayer();
        if (!SessionLocator::isSessionOpen($player)) {
            return;
        }

        $session = SessionLocator::getSession($player);
        foreach ($this->manager->getIslands() as $island) {
            $island->removeCooperator($session);
        }

        $island = $session->getIslandByLevel();
        if ($island != null) {
            $session->teleportToSpawn();
            $island->tryToClose();
        } else {
            $session->clearInvitations();
        }
    }

    /**
     * Spawns the chest of recently created islands
     */
    public function onChunkLoad(ChunkLoadEvent $event): void
    {
        $world = $event->getWorld();
        $island = $this->manager->getIsland($world->getDisplayName());

        if ($island == null) {
            return;
        }

        $generator = $this->plugin->getGeneratorManager()->getGenerator($type = $island->getType());
        if ($generator === null or !is_subclass_of($generator, IslandGenerator::class)) {
            return;
        }

        $position = $generator::getChestPosition();
        $chest = $world->getBlock($position);
        $chestTile = $world->getTile($position);
        if($chestTile instanceof Chest) {
            $chestTile->getInventory()->setItem(4, ItemIds::BOW);
        }

        if ($world->getChunk($position->x >> 4, $position->z >> 4) === $event->getChunk() and $event->isNewChunk()) {
//            foreach ($this->plugin->getSettings()->getChestContentByGenerator($type) as $item) {
//                $chest->getInventory()->addItem($item);
//            }
        }
    }
}
