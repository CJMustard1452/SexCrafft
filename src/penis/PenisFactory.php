<?php

namespace CJMustard1452\SexCraft\penis;

use CJMustard1452\SexCraft\Loader;

class PenisFactory {

    public const NONE = "penis_none";
    public const WHITE = "penis_white";
    public const BLACK = "penis_black";
    public const BROWN = "penis_brown";
    public const GREEN = "penis_green";

    public const PENISIS_FORMATTED = [
        self::NONE => "None",
        self::WHITE => "White",
        self::BLACK => "Black",
        self::BROWN => "Brown",
        self::GREEN => "Green"
    ];

    public static array $penises = [];
    public static string $geometry = "";

    public function __construct() {
        $resource_path = Loader::getInstance()->getResourceFolder();
        $file_dir = $resource_path . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR;

        self::$geometry = file_get_contents($resource_path . DIRECTORY_SEPARATOR . "penis_geometry.json");

        self::$penises[self::NONE] = false;
        self::$penises[self::WHITE] = imagecreatefrompng($file_dir . self::WHITE . ".png");
        self::$penises[self::BLACK] = imagecreatefrompng($file_dir . self::BLACK . ".png");
        self::$penises[self::BROWN] = imagecreatefrompng($file_dir . self::BROWN . ".png");
        self::$penises[self::GREEN] = imagecreatefrompng($file_dir . self::GREEN . ".png");
    }
}
