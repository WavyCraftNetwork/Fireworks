<?php

declare(strict_types=1);

namespace BlockHorizons\Fireworks;

use BlockHorizons\Fireworks\item\Fireworks;
use BlockHorizons\Fireworks\entity\FireworksRocket;
use pocketmine\math\Vector3;
use pocketmine\world\World;
use pocketmine\entity\Location;
use pocketmine\Server;

class FireworkManager
{
    use \pocketmine\utils\SingletonTrait;

    public function spawnFirework(int $type, string $color, string $fade = "", int $duration = 1, float $x, float $y, float $z, World $world): void
    {
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkItem->setFlightDuration($duration);
        $fireworkItem->addExplosion($type, $color, $fade);
        $location = new Location($x, $y, $z, $world);
        $fireworkRocket = new FireworksRocket($location, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }
}
