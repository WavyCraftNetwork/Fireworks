<?php

declare(strict_types=1);

namespace BlockHorizons\Fireworks;

use BlockHorizons\Fireworks\item\Fireworks;
use BlockHorizons\Fireworks\entity\FireworksRocket;
use BlockHorizons\Fireworks\item\ExtraVanillaItems;
use pocketmine\utils\SingletonTrait;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\math\Vector3;
use pocketmine\entity\Location;

class FireworkManager
{
    use SingletonTrait;

    public function spawnFireworkAtPlayer(int $type, string $color, string $fade = "", int $duration = 1, bool $flicker = false, bool $trail = false, Player $player): void
    {
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkItem->setFlightDuration($duration);
        $fireworkItem->addExplosion($type, $color, $fade, $flicker, $trail);

        $position = $player->getLocation();
        $fireworkRocket = new FireworksRocket($position, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }

    public function spawnFireworkAtCoord(int $type, string $color, string $fade = "", int $duration = 1, bool $flicker = false, bool $trail = false, float $x, float $y, float $z, World $world): void
    {
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkItem->setFlightDuration($duration);
        $fireworkItem->addExplosion($type, $color, $fade, $flicker, $trail);

        $position = new Location($x, $y, $z, $world, 0.0, 0.0);
        $fireworkRocket = new FireworksRocket($position, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }
}
