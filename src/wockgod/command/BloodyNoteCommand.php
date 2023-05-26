<?php

namespace wockgod\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use wockgod\item\Items;

class BloodyNoteCommand extends Command {

    public function __construct(){
        parent::__construct("bn", "Gives bloody notes to player", "/bn <player> <amount>", ["bloodynote"]);
        $this->setPermission("bloodynote.command");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender->hasPermission($this->getPermission())) {
            $sender->sendMessage("§r§cYou do not have the sufficient permissions to run this command.");
            return false;
        }
        // Check if the command has at least two arguments
        if (count($args) < 2) {
            $sender->sendMessage("§r§cUsage: /bn <name> <amount>");
            return false;
        }

        // Get the name and amount from the command arguments
        $name = $args[0];
        $amount = (int) $args[1];

        // Check if the amount is a positive integer
        if ($amount <= 0) {
            $sender->sendMessage("§r§cThe amount must be a positive integer.");
            return false;
        }

        // Check if the player with the given name is online
        $player = Server::getInstance()->getPlayerByPrefix($name);
        if (!$player instanceof Player) {
            $sender->sendMessage("§r§cThe player '$name' is not online or does not exist.");
            return false;
        }

        // Give the player the specified number of bloodynotes
        for ($i = 0; $i < $amount; $i++) {
            $bloodynote = Items::get(Items::BLOODYNOTE);
            $player->getInventory()->addItem($bloodynote);
        }

        $sender->sendMessage("§r§aSuccessfully gave $amount bloodynotes to $name.");
        return true;
    }
}
