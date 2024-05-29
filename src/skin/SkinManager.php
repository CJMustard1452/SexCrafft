<?php

namespace CJMustard1452\SexCraft\skin;

use pocketmine\entity\Skin;
use GdImage;

class SkinManager {

    public static function addAsset(Skin $skin, GdImage $asset, ?String $skinId = "", ?String $geometryName = "", ?String $geometry = "", ): Skin {
		$skinData = $skin->getSkinData();
        $im = imagecreatetruecolor(64, 64);
        $skinPos = 0;

		imagefill($im, 0, 0, imagecolorallocatealpha($im, 0, 0, 0, 127));
		for ($y = 0; $y < 64; $y++) {
			for ($x = 0; $x < 64; $x++) {
				$r = ord($skinData[$skinPos]);
				$skinPos++;
				$g = ord($skinData[$skinPos]);
				$skinPos++;
				$b = ord($skinData[$skinPos]);
				$skinPos++;
				$a = 127 - intdiv(ord($skinData[$skinPos]), 2);
				$skinPos++;
				$col = imagecolorallocatealpha($im, $r, $g, $b, $a);
				imagesetpixel($im, $x, $y, $col);
			}
		}

        imagecopy($im, $asset, (imagesx($im)/2)-(imagesx($asset)/2), (imagesy($im)/2)-(imagesy($asset)/2), 0, 0, imagesx($asset), imagesy($asset));
        
        $data = "";
        for ($y = 0, $height = imagesy($im); $y < $height; $y++) {
            for ($x = 0, $width = imagesx($im); $x < $width; $x++) {
                $color = imagecolorat($im, $x, $y);
                $data .= pack("c", ($color >> 16) & 0xFF)
                    . pack("c", ($color >> 8) & 0xFF)
                    . pack("c", $color & 0xFF)
                    . pack("c", 255 - (($color & 0x7F000000) >> 23));
            }
        }

        return new Skin($skinId, $data, "", $geometryName, $geometry);
    }
}