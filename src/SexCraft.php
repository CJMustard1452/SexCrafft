<?php

namespace CJMustard1452\SexCraft;

use CJMustard1452\SexCraft\penis\PenisFactory;
use CJMustard1452\SexCraft\skin\SkinManager;
use pocketmine\entity\Skin;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class SexCraft {

    public static array $defaultSkins = [];
    public static array $penisData = [];
    public static Config $config;

    public function __construct() {
        self::$config = new Config(Loader::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        self::$penisData = self::$config->getAll();
    }

    public static function getPlayerPenisName(string $username): ?string {
        if(!isset(self::$penisData[strtolower($username)])) return null;
        return self::$penisData[strtolower($username)];
    }

    public static function setPlayerPenis(string $username, string $penis): void {
        self::$penisData[strtolower($username)] = $penis;
    }

    public static function getPlayerPenisSkin(Player $player): Skin {
        if(($penis = self::getPlayerPenisName($player->getName())) == PenisFactory::NONE || !isset(PenisFactory::$penises[$penis])) 
        return self::$defaultSkins[strtolower($player->getName())];

        return SkinManager::addAsset($player->getSkin(), PenisFactory::$penises[$penis], PenisFactory::SKINID, "geometry.cosmetic", PenisFactory::$geometry);
    }

    public static function applySkin(Player $player, ?String $newname = "new"): void {
        $player->changeSkin(self::getPlayerPenisSkin($player), $newname, "old");
    }

    public static function onDisable(): void {
        self::$config->setAll(self::$penisData);
        self::$config->save();
    }
}