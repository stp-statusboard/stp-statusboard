<?php

namespace StpBoard\Home\Service;

use StpBoard\Home\Entity\Item;

class ItemHydratorService
{
    public function extract(Item $object)
    {
        return [
            'id' => $object->getIdent(),
            'provider' => $object->getProvider(),
            'params' => $object->getParams(),
            'refresh' => $object->getRefresh(),
            'width' => $object->getWidth()
        ];
    }

    public function hydrate(array $data, Item $object)
    {
        if (!isset($data['id'])) {
            $data['id'] = uniqid();
        }

        if (!isset($data['provider'])) {
            throw new \Exception(); // todo refactor
        }

        if (!isset($data['refresh'])) {
            $data['refresh'] = 60;
        }

        if (!isset($data['width'])) {
            $data['width'] = 4;
        }

        if (!isset($data['params'])) {
            $data['params'] = [];
        }

        $object->setIdent($data['id']);
        $object->setProvider($data['provider']);
        $object->setParams($data['params']);
        $object->setRefresh($data['refresh']);
        $object->setWidth($data['width']);
    }
}
