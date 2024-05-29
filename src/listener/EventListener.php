<?php

namespace CJMustard1452\SexCraft\listener;

use CJMustard1452\SexCraft\penis\PenisFactory;
use CJMustard1452\SexCraft\SexCraft;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChangeSkinEvent;

class EventListener implements Listener {

    private array $array = [];

    public function onJoin(PlayerJoinEvent $playerJoinEvent): void {
        $player = $playerJoinEvent->getPlayer();

        SexCraft::$defaultSkins[strtolower($player->getName())] = $player->getSkin();
        SexCraft::applySkin($player);
    }

    public function onSkinChange(PlayerChangeSkinEvent $playerChangeSkinEvent): void {
        $player = $playerChangeSkinEvent->getPlayer();

        if(SexCraft::getPlayerPenisName($player->getName()) == PenisFactory::NONE) return;
        if($playerChangeSkinEvent->getNewSkin()->getSkinId() == PenisFactory::SKINID) return;

        SexCraft::applySkin($player);
    }
}