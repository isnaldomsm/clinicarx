<?php

namespace Rx\Test\Parser;

use Rx\Entity\Product;
use Rx\Parser\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testGetDictionary()
    {
        $dictionary = ['id', 'name', 'description', 'value', 'quantity'];
        $this->assertEquals(
            $dictionary,
            Collection::getDictionary(Product::class)
        );
    }

    public function testCollectionIsIterable()
    {
        $data = [
            ['id', 'name', 'description', 'value', 'quantity'],
            [1, 'Model S', 'Tesla Model S', 75000, 1],
            [2, 'Model 3', 'Tesla Model 3', 50000, 1],
            [3, 'Model X', 'Tesla Model X', 35000, 1],
        ];
        $collection = new Collection($data, Product::class);

        $this->assertIsIterable($collection);
    }

    public function testNewProductsCollectionWithHeader()
    {
        $data = [
            ['id', 'name', 'description', 'value', 'quantity'],
            [1, 'Model S', 'Tesla Model S', 75000, 1],
            [2, 'Model 3', 'Tesla Model 3', 50000, 1],
            [3, 'Model X', 'Tesla Model X', 35000, 1],
        ];

        $collection = new Collection($data, Product::class);
        $this->assertCount(3, $collection);

        foreach ($collection as $item) {
            $this->assertInstanceOf(Product::class, $item);
        }
    }

    public function testNewProductsCollectionWithoutHeader()
    {
        $data = [
            [1, 'Model S', 'Tesla Model S', 75000, 1],
            [2, 'Model 3', 'Tesla Model 3', 50000, 1],
            [3, 'Model X', 'Tesla Model X', 35000, 1],
        ];

        $collection = new Collection($data, Product::class);
        $this->assertCount(3, $collection);

        foreach ($collection as $item) {
            $this->assertInstanceOf(Product::class, $item);
        }
    }

}
