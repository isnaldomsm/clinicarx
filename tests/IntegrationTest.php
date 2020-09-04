<?php

namespace Rx\Test\integration;

use Cake\Datasource\ConnectionManager;
use PHPUnit\Framework\TestCase;
use Rx\Parser\Entity\Product;
use Rx\Parser\Collection;
use Rx\Parser\Csv;

class IntegrationTest extends TestCase
{
    public function testCsvConvertion()
    {
        $csvData = file_get_contents(TMP . 'frutas.csv');
        $csvParser = new Csv($csvData);
        /** @var Product[] $colection */
        $colection = new Collection($csvParser->toArray(), Product::class);

        $this->assertInstanceOf(Product::class, $colection[0]);
        $this->assertEquals(1, $colection[0]->getId());
    }

}
