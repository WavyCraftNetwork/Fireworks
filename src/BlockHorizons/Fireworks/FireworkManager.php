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
use pocketmine\world\Position;

class FireworkManager
{
    use SingletonTrait;

    public function spawnFireworkAtPlayer(Player $player, int $type, string $color, string $fade = "", int $duration = 1, bool $flicker = false, bool $trail = false): void
    {
        $this->spawnFirework($player->getPosition()->getX(), $player->getPosition()->getY(), $player->getPosition()->getZ(), $player->getWorld(), $type, $color, $fade, $duration, $flicker, $trail);
    }

    public function spawnFireworkAtCoord(int $type, string $color, string $fade = "", int $duration = 1, bool $flicker = false, bool $trail = false, float $x, float $y, float $z, World $world): void
    {
        $this->spawnFirework($type, $color, $fade, $duration, $flicker, $trail, $x, $y, $z, $world);
    }

    private function spawnFirework(float $x, float $y, float $z, World $world, int $type, string $color, string $fade = "", int $duration = 1, bool $flicker = false, bool $trail = false): void
    {
        $fireworkItem = ExtraVanillaItems::FIREWORKS();
        $fireworkItem->setFlightDuration($duration);
        $fireworkItem->addExplosion($type, $color, $fade, $flicker, $trail);
        $position = new Position($x, $y, $z, $world);
        $fireworkRocket = new FireworksRocket($position, $fireworkItem);
        $fireworkRocket->spawnToAll();
    }
}
