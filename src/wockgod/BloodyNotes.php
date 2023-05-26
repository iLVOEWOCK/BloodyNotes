<?php

namespace wockgod;

use pocketmine\plugin\PluginBase;
use wockgod\command\BloodyNoteCommand;

class BloodyNotes extends PluginBase {

    private static $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getServer()->getLogger()->info("Bloody Notes Enabled! by Wockgod");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new BloodyNoteListener(), $this);
        $this->registerCommands();
    }

    public function onDisable(): void
    {
        $this->getServer()->getLogger()->info("Bloody Notes Disabled!");
    }

    public function registerCommands(){
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->register("bn", new BloodyNoteCommand());
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }
}