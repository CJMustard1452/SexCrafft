<?php

namespace CJMustard1452\SexCraft\listener;

use CJMustard1452\SexCraft\SexCraft;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChangeSkinEvent;

class EventListener implements Listener {

    public function onJoin(PlayerJoinEvent $playerJoinEvent): void {
        $player = $playerJoinEvent->getPlayer();

        SexCraft::$defaultSkins[strtolower($player->getName())] = $player->getSkin();
        $player->changeSkin(SexCraft::getPlayerPenisSkin($player), "penis", "old");
    }

    public function onSkinChange(PlayerChangeSkinEvent $playerChangeSkinEvent): void {
        $player = $playerChangeSkinEvent->getPlayer();

        $player->changeSkin(SexCraft::getPlayerPenisSkin($player), "penis", "old");
    }
}