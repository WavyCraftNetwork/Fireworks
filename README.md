# Fireworks-PM5
A plugin by BlockHozirons and updated to API 5 by<br>
Fixed some and support latest Pocketmine-MP verion<br>
This plugin will add Fireworks to your Pocketmine Server
## API
### Adding firework items to a player's inventory
Giving players fireworks is easy as pie. Here are some examples (where `$player` is a `\pocketmine\player\Player`
object):
- **Base firework**
```php
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;
$player->getInventory()->addItem($fw);
```
- **Sphere firework with color fade from blue to cyan**
```php
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;

// addExplosion Parameters:
// int $type: Type of explosion, 0 - 4, see Fireworks::TYPE_* constants
// string $color: Color of explosion, see Fireworks::COLOR_* constants
// string $fade = "": Color to fade to, none if an empty string is passed
// bool $flicker = false: If the particles should flicker
// bool $trail = false: If the particles leave a trail behind
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BLUE, Fireworks::COLOR_DARK_AQUA, false, false);

$player->getInventory()->addItem($fw);
```
- **Green creeper firework, flying higher**
```php
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;
$fw->addExplosion(Fireworks::TYPE_CREEPER_HEAD, Fireworks::COLOR_GREEN, "", false, false);
$fw->setFlightDuration(2);
$player->getInventory()->addItem($fw);
```
- **High flying flashing star firework with trail**
```php
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;
$fw->addExplosion(Fireworks::TYPE_STAR, Fireworks::COLOR_YELLOW, "", true, true);
$fw->setFlightDuration(3);
$player->getInventory()->addItem($fw);
```
- **All-colored sphere firework with trail**
```php
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BLACK, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_RED, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_DARK_GREEN, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BROWN, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BLUE, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_DARK_PURPLE, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_DARK_AQUA, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_GRAY, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_DARK_GRAY, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_PINK, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_GREEN, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_YELLOW, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_LIGHT_AQUA, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_DARK_PINK, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_GOLD, "", false, true);
$fw->addExplosion(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_WHITE, "", false, true);
$player->getInventory()->addItem($fw);
```
### Launching fireworks - LEGACY (YOU MAY USE THIS METHOD THOUGH)
Fireworks can be launched after you created the firework item.
This example spawns a green creeper firework at the default world's spawn
```php
// Create the type of firework item to be launched
/** @var Fireworks $fw */
$fireworks = ExtraVanillaItems::FIREWORKS();
$fw = clone $fireworks;
$fw->addExplosion(Fireworks::TYPE_CREEPER_HEAD, Fireworks::COLOR_GREEN, "", false, false);
$fw->setFlightDuration(2);

// Use whatever level you'd like here. Must be loaded
$level = Server::getInstance()->getDefaultLevel();
// Choose some coordinates
$vector3 = $level->getSpawnLocation()->add(0.5, 1, 0.5);
// Create the NBT data
$nbt = FireworksRocket::createBaseNBT($vector3, new Vector3(0.001, 0.05, 0.001), lcg_value() * 360, 90);
// Construct and spawn
$entity = FireworksRocket::createEntity("FireworksRocket", $level, $nbt, $fw);
if ($entity instanceof FireworksRocket) {
    $entity->spawnToAll();
}
```
### Launching fireworks
```php
// How to customize your firework:

// FireworkManager::getInstance()->spawnFireworkAtPlayer(TYPE, COLOR, FADING COlOR(put "" if you don't want a fading color), DURATION(1-3), FLICKER, TRAIL, PLAYER POSITION);

// FireworkManager::getInstance()->spawnFireworkAtCoord(TYPE, COLOR, FADING COlOR(put "" if you don't want a fading color), DURATION(1-3), FLICKER, TRAIL, X, Y, Z, WORLD);

// Usage example with player position:
// pocketmine\player\Player can be used as well

$player = Server::getInstance()->getPlayerExact("PlayerName");

if ($player !== null) {
    FireworkManager::getInstance()->spawnFireworkAtPlayer(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BLACK, Fireworks::COLOR_RED, 2, false, true, $player);
}

// Usage example with specific coordinates:

$x = 10;
$y = 4;
$z = 10;
$world = Server::getInstance()->getWorldManager()->getWorldByName("TEST");


FireworkManager::getInstance()->spawnFireworkAtCoord(Fireworks::TYPE_SMALL_SPHERE, Fireworks::COLOR_BLACK, "", 1, false, false, $x, $y, $z, $world);

```
