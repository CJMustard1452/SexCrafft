<?php

namespace CJMustard1452\SexCraft\resource;

use pocketmine\resourcepacks\ZippedResourcePack;
use CJMustard1452\SexCraft\Loader;
use ReflectionClass;
use ZipArchive;

class ResourceManager {

    public function __construct() {
        $target = Loader::getInstance()->getServer()->getResourcePackManager()->getPath() . DIRECTORY_SEPARATOR . "sexcraft.zip";
        $source = Loader::getInstance()->getResourceFolder() . DIRECTORY_SEPARATOR . "resource_pack";

        if(file_exists($target)) unlink($target);
        ResourceManager::buildResourcePack($source, $target);

        $rpm = Loader::getInstance()->getServer()->getResourcePackManager();
        $rp = new ZippedResourcePack($target);
        $refl = new ReflectionClass($rpm);

        $property = $refl->getProperty("resourcePacks");
        $property->setAccessible(true);

        $currentResourcePacks = $property->getValue($rpm);
        $currentResourcePacks[] = $rp;
        $property->setValue($rpm , $currentResourcePacks);

        $property = $refl->getProperty("serverForceResources");
        $property->setAccessible(true);
        $property->setValue($rpm , true);
    }

    public static function buildResourcePack(string $source, string $target): void {
        $zipArchive = new ZipArchive();
        $zipArchive->open($target, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            
        self::recurseDirectoryToZip($source, $zipArchive);        

        $zipArchive->close();
    }

    public static function recurseDirectoryToZip(string $path, ZipArchive $zipArchive, string $localDir = ""): void {
        foreach(scandir($path) as $item) {
            if($item == "." || $item == "..") continue;
            
            $itemPath = $path . DIRECTORY_SEPARATOR . $item;
            ($localDir == "") ? $localFile = $item : $localFile = $localDir . DIRECTORY_SEPARATOR . $item;

            if(!is_dir($path . DIRECTORY_SEPARATOR . $item)) {
                $zipArchive->addFile($itemPath, $localFile);
                continue;
            }

            $zipArchive->addEmptyDir($localFile);
            self::recurseDirectoryToZip($itemPath, $zipArchive, $localFile);
        }
    }
}