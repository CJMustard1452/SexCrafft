<?php

namespace CJMustard1452\SexCraft;

use CJMustard1452\SexCraft\resource\ResourceManager;
use CJMustard1452\SexCraft\command\ShlongCommand;
use CJMustard1452\SexCraft\listener\EventListener;
use CJMustard1452\SexCraft\penis\PenisFactory;
use pocketmine\plugin\PluginBase;

class Loader extends PluginBase {

    public static Loader $loader;

    public function onLoad(): void {
        self::$loader = $this;

        new ResourceManager();

        echo time();
        new SexCraft();
        new PenisFactory();
    }

    public function onEnable(): void {
        $this->getServer()->getCommandMap()->register("SexCraft", new ShlongCommand());
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
    }

    public function onDisable(): void {
        SexCraft::onDisable();
    }

    public static function getInstance(): Loader {
        return self::$loader;
    }
}
