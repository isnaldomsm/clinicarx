<?php

/**
 * Rx Avaliação PHP
 */
namespace Rx\Parser;

/**
 * Class Csv
 * Esta classe tem como objetivo converter um texto no formato CSV para array.
 *
 * @package Rx\Parser
 */
class Csv
{
    /**
     * @var string O texto original antes de ser convertido para CSV
     */
    protected $_text;

    /**
     * @var string O texto original antes de ser convertido para CSV
     */
    protected $_data;

    /**
     * CsvParser constructor.
     *
     * @param string $text O texto que será convertido para o formato CSV
     */
    public function __construct(string $text)
    {
        $this->_text = $text;
    }

    /**
     * Converte o texto no formato CSV para array
     *
     * @return array
     */
    public function toArray(): array
    {
        if (is_array($this->_data))
            return $this->_data;

        // A função str_getcsv falha em converter corretamente d
        // quando o CSV possui quebras de linhas dentro de uma das células.
        // TODO: Substituir o método abaixo por um que funcione corretamente
        $csv = file_get_contents( $this->_text);
        $lines = explode(PHP_EOL, $csv);
        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }

        $this->_data = array_map('str_getcsv', explode(PHP_EOL, $array));

        return $this->_data;
    }
}
