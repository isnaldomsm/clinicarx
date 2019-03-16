<?php

namespace Rx\Test\Entity;

use Rx\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    public function testCreateNewProduct()
    {
        $data = [
            'id' => 1,
            'name' => 'Carro',
            'description' => 'Veículo automotor pessoal',
            'value' => 100000,
            'quantity' => 2,
        ];
        $product = new Product($data);

        $this->assertEquals(1, $product->getId());
        $this->assertEquals('Carro', $product->getName());
        $this->assertEquals('Veículo automotor pessoal', $product->getDescription());
        $this->assertEquals(100000, $product->getValue());
        $this->assertEquals(2, $product->getQuantity());
    }

    /**
     * @expectedException \Exception
     */
    public function testCreateNewProductWithoutNameFails()
    {
        $data = [];
        $product = new Product($data);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The property "name" is required');
    }

    public function testIsAvailable()
    {
        $product = new Product(['name' => 'Carro']);
        $product->setQuantity(-1);
        $this->assertEquals(0, $product->getQuantity());

        $product->setQuantity(1);
        $this->assertEquals(1, $product->getQuantity());
        $this->assertTrue($product->isAvailable());
    }
}
