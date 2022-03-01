<?php

declare(strict_types = 1);

namespace Model\Repository;

use Model\Entity;

class Product
{
    /**
     * массив с нашим кэшем
     */
    private $identityMap = [];

    /**
     * Метод для добавления товара в identityMap
     */
    public function add($product)
    {
        $key = $this->getGlobalKey(get_class($product), $product->getId());
        $this->identityMap[$key] = $product;
    }

    /**
     * метод для получения товара из кэша (если его там нет, то из БД)
     */
    public function get(string $classname, int $id)
    {
        $key = $this->getGlobalKey($classname, $id);
 
        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        } else {
            $product = query(); // Здесь условный метод, который должен получать информацию о товаре из БД
            $this->add($product);
            return $product;
        }
    }
 
    private function getGlobalKey(string $classname, int $id)
    {
        return sprintf('%s.%d', $classname, $id);
    }

    /**
     * Поиск продуктов по массиву id
     *
     * @param int[] $ids
     * @return Entity\Product[]
     */
    public function search(array $ids = []): array
    {
        if (!count($ids)) {
            return [];
        }

        $productList = [];
        foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    /**
     * Получаем все продукты
     *
     * @return Entity\Product[]
     */
    public function fetchAll(): array
    {
        $productList = [];
        foreach ($this->getDataFromSource() as $item) {
            $productList[] = new Entity\Product($item['id'], $item['name'], $item['price']);
        }

        return $productList;
    }

    /**
     * Получаем продукты из источника данных
     *
     * @param array $search
     *
     * @return array
     */
    private function getDataFromSource(array $search = [])
    {
        $dataSource = $this->identityMap;

        if (!count($search)) {
            return $dataSource;
        }

        $productFilter = function (array $dataSource) use ($search): bool {
            return in_array($dataSource[key($search)], current($search), true);
        };

        return array_filter($dataSource, $productFilter);
    }
}
