<?php

declare(strict_types=1);

namespace BlockHorizons\Fireworks;

use BlockHorizons\Fireworks\item\Fireworks;
use BlockHorizons\Fireworks\entity\FireworksRocket;
use pocketmine\utils\SingletonTrait;
use pocketmine\player\Player;
use pocketmine\world\World;
use pocketmine\math\Vector3;
use pocketmine\world\Position;

class FireworkManager
{
    use SingletonTrait;

    public function spawnFireworkAtPlayer(int $type, string $color, string $fade = "", int $duration = 1, Player $player): void
    {
        $this->spawnFirework($type, $color, $fade, $duration, $player->getPosition()->getX(), $player->getPosition()->getY(), $player->getPosition()->getZ(), $player->getWorld());
    }

    public function spawnFireworkAtCoord(int $type, string $color, string $fade = "", int $duration = 1, float $x, float $y, float $z, World $world): void
    {
        $this->spawnFirework($type, $color, $fade, $duration, $x, $y, $z, $world);
    }

    private function spawnFirework(int $type, string $color, string $fade = "", int $duration = 1, float $x, float $y, float $z, World $world): void
    {
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkItem->setFlightDuration($duration);
        $fireworkItem->addExplosion($type, $color, $fade);
        $position = new Position($x, $y, $z, $world);
        $fireworkRocket = new FireworksRocket($position, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }
}
