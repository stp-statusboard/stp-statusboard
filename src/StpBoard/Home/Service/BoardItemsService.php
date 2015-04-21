<?php

namespace StpBoard\Home\Service;

use StpBoard\Home\Entity\Item;

class BoardItemsService
{
    public static function initBoardItems(array $config)
    {
        $hydrator = new ItemHydratorService();
        $boardItems = [];
        foreach ($config as $itemData) {
            $item = new Item();
            $hydrator->hydrate($itemData, $item);
            $boardItems[] = $item;
        }

        return $boardItems;
    }
}
