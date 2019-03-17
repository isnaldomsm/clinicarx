<?php

namespace Rx\Test\Parser;

use PHPUnit\Framework\TestCase;
use Rx\Parser\Csv;

class CsvTest extends TestCase
{
    public function testMethodToArrayWorks()
    {
        $strData = <<<CSV
a1,b1,c1,d1,e1
a2,b2,c2,d2,e2
CSV;

        $expected = [
            ['a1', 'b1', 'c1', 'd1', 'e1'],
            ['a2', 'b2', 'c2', 'd2', 'e2'],
        ];

        $csvParser = new Csv($strData);
        $result = $csvParser->toArray();
        $this->assertEquals(
            $expected,
            $result,
            'Csv parser falhou em converter a string para array'
        );
        $this->assertEquals(
            $result,
            $csvParser->toArray(),
            'Csv parser mudou de valor quando não deveria ter mudado'
        );
    }

    public function testParseCsvWithSemicolumnDelimiter()
    {
        $strData = <<<CSV
a1;b1;c1;d1;e1
a2;b2;c2;d2;e2
CSV;

        $expected = [
            ['a1', 'b1', 'c1', 'd1', 'e1'],
            ['a2', 'b2', 'c2', 'd2', 'e2'],
        ];

        $csvParser = new Csv($strData);
        $this->assertEquals(
            $expected,
            $csvParser->toArray(),
            'Csv parser falhou em converter a string para array'
        );
    }

    public function testParseCsvSkippingEmptyLines()
    {
        $strData = <<<CSV
a1,b1,c1,d1,e1

a2,b2,c2,d2,e2

CSV;

        $expected = [
            ['a1', 'b1', 'c1', 'd1', 'e1'],
            ['a2', 'b2', 'c2', 'd2', 'e2'],
        ];

        $csvParser = new Csv($strData);
        $this->assertEquals(
            $expected,
            $csvParser->toArray(),
            'Csv parser falhou em converter a string para array'
        );
    }


    public function testParseCsvTrimmingFields()
    {
        $strData = <<<CSV
a1 ,b1 , c1, d1 
CSV;

        $expected = [
            ['a1', 'b1', 'c1', 'd1'],
        ];

        $csvParser = new Csv($strData);
        $this->assertEquals(
            $expected,
            $csvParser->toArray(),
            'Csv parser falhou em converter a string para array'
        );
    }

    public function testCsvParseCelsWithNewLineCorrectly()
    {
        $strData = <<<CSV
Maçã,"Laranja
lima","""Caju"""
CSV;

        $expected = [
            ["Maçã", "Laranja\nlima", "\"Caju\""],
        ];

        $csvParser = new Csv($strData);
        $this->assertEquals(
            $expected,
            $csvParser->toArray(),
            'Csv parser falhou em converter a string para array'
        );
    }


}
