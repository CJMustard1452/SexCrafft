<?php

namespace CJMustard1452\SexCraft\form;

use CJMustard1452\SexCraft\lib\form\BaseForm;

use CJMustard1452\SexCraft\lib\form\SimpleForm;
use CJMustard1452\SexCraft\penis\PenisFactory;
use CJMustard1452\SexCraft\SexCraft;

class ShlongCommandForm extends BaseForm {
    
    public function sendForm(): void {
        $form = new SimpleForm(function($player, $data) {
            if(!isset($data)) return;

            SexCraft::setPlayerPenis($player->getName(), $data);
            SexCraft::applySkin($player);

            $player->sendMessage("§7(§3SexCraft§7) Your shlong has been updated");
        });

        foreach(PenisFactory::$penises as $key => $data) {
            $form->addButton(PenisFactory::PENISIS_FORMATTED[$key], 0, "textures/items/bucket_milk.png", $key);
        }

        $form->setTitle("Choose your shlong.");
        $form->sendToPlayer($this->player);
    }
}