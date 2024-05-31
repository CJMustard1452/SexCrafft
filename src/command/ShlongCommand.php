<?php

namespace CJMustard1452\SexCraft\command;

use CJMustard1452\SexCraft\form\ShlongCommandForm;
use CJMustard1452\SexCraft\Loader;
use CJMustard1452\SexCraft\moan\MoanEngine;
use pocketmine\command\Command;
use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\plugin\PluginOwned;

class ShlongCommand extends Command implements PluginOwned {

    public function __construct() {
        parent::__construct("shlong", "SexCraft shlong menu.");
        $this->setPermission('sexcraft.admin');
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$sender instanceof Player) {
            $sender->sendMessage('§7(§3SexCraft§7) You can only use this command in game');
            return;
        }

        new ShlongCommandForm($sender);
    }

    public function getOwningPlugin(): Loader {
		return Loader::getInstance();
	}
}