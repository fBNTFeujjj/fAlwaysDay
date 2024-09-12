<?php


namespace BNTFeujjj\fAlwaysDay;

use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class AlwaysDay extends PluginBase {

    /** @var array Liste des mondes où il doit toujours faire jour */
    private $worldsToAlwaysDay = [];

    protected function onEnable(): void {
        $this->saveDefaultConfig();
        $config = $this->getConfig();
        $this->worldsToAlwaysDay = $config->get("worlds", []);

        $worldManager = $this->getServer()->getWorldManager();

        foreach ($this->worldsToAlwaysDay as $worldName) {
            $world = $worldManager->getWorldByName($worldName);
            if ($world !== null) {
                $world->setTime(World::TIME_DAY);
                $world->stopTime();
            } else {
                $this->getLogger()->warning("Le monde '$worldName' n'a pas été trouvé.");
            }
        }
    }
}
