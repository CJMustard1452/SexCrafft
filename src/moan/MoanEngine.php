<?php 

namespace CJMustard1452\SexCraft\moan;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class MoanEngine {

    public const MOAN_ONE = "moan_one";
    public const FAMILY_MATTERS = "family_matters";

    public static function brodcastSound(Array $players, string $sound, ?int $pitch = 1, ?int $volume = 1): void {
        $pk = new PlaySoundPacket();
        $pk->soundName = $sound;
        $pk->volume = $volume;
        $pk->pitch = $pitch;

        foreach($players as $player) {
            $pk->x = $player->getPosition()->getFloorX();
            $pk->y = $player->getPosition()->getFloorY();
            $pk->z = $player->getPosition()->getFloorZ();

            $player->getNetworkSession()->sendDataPacket($pk);
        }
    }
}
