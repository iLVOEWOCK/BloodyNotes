<?php

namespace wockgod;

use onebone\economyapi\EconomyAPI;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\ItemIds;

class BloodyNoteListener implements Listener{

    public function onPlayerUseBloodyNote(PlayerInteractEvent $event) {
        $player = $event->getPlayer();
        $item = $event->getItem();

        // Check if the item is a paper and has the "bloodynote" tag
        if ($item->getId() === ItemIds::PAPER && $item->getNamedTag()->getString("bloodynote") === "true") {
            $config = BloodyNotes::getInstance()->getConfig();
            $minAmount = $config->get("min_amount", 50000);
            $maxAmount = $config->get("max_amount", 500000);

            $amount = mt_rand($minAmount, $maxAmount);
            EconomyAPI::getInstance()->addMoney($player, $amount);
            $player->sendActionBarMessage("§r§aReceived: §f$" . number_format($amount));

            $hand = $player->getInventory()->getItemInHand();
            $hand->setCount($hand->getCount() - 1);
            $player->getInventory()->setItemInHand($hand);

            $event->cancel();
        }
    }
}