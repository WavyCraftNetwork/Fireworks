<?php

declare(strict_types=1);

namespace BlockHorizons\Fireworks;

use BlockHorizons\Fireworks\item\Fireworks;
use BlockHorizons\Fireworks\entity\FireworksRocket;
use pocketmine\utils\SingletonTrait;
use pocketmine\math\Vector3;
use pocketmine\world\World;
use pocketmine\entity\Location;
use pocketmine\Server;

class FireworkManager
{
    use singletonTrait;

    public function spawnFirework(float $x, float $y, float $z, World $world): void
    {
        $location = new Location($x, $y, $z, $world);
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkRocket = new FireworksRocket($location, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }
}
