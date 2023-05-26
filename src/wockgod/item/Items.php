<?php

namespace wockgod\item;

use Exception;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;

class Items {

    public const BLOODYNOTE = 1;

    /**
     * @param int $id
     * @param int $amount
     * @return Item|null
     * @throws Exception
     */
    public static function get(int $id, int $amount = 1): ?Item
    {
        $item = ItemFactory::getInstance()->get(ItemIds::AIR);
        switch ($id) {
            case self::BLOODYNOTE:
                $item = ItemFactory::getInstance()->get(ItemIds::PAPER, 0, $amount);
                $item->setCustomName("§r§l§cBloody Note §r§7(Right-Click)");
                $item->setLore([
                    "§r§7Uncover this Bloody Note to gain either",
                    "§r§7a small fortune or nothing at all.",
                    "",
                    "§r§l§c* §r§7Note Worth: §r§c§kahwn3k§r",
                    "§r§l§c(!) §r§cClick to uncover the Bloody Note"
                ]);
                $item->getNamedTag()->setString("bloodynote", "true");
                //$item->getNamedTag()->setInt("bloodynote", mt_rand(50000, 500000));
                break;
        }
        return $item;
    }
}
