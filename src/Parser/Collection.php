<?php

namespace Rx\Parser;

/**
 * Class Collection
 * @package Rx\Parser
 */
class Collection
{
    /**
     * @var array $_container Container de dados da classe
     */
    protected $_container = [];

    /**
     * @var string A classe da entidade usada para decompor os dados
     */
    protected $_entityClass;

    /**
     * Collection constructor.
     * @param array $data
     * @param string $entityClass
     * @throws \Exception
     */
    public function __construct(array $data, string $entityClass)
    {
        if (!class_exists($entityClass)) {
            $message = sprintf('Class "%s" does not exists', $entityClass);
            throw new \Exception($message);
        }
        $this->_entityClass = $entityClass;
        $dictionary = $this->getDictionary($entityClass);

        $headers = $data[0];

        if ($headers === $dictionary) {
            array_shift($data); // remove column header
        }

        $this->_container = array_map(
            function (array $item) use ($entityClass, $dictionary) {
                $entityData = array_combine($dictionary, $item);

                return new $entityClass($entityData);
            },
            $data
        );
    }

    /**
     * @return array
     */
    public static function getDictionary(string $entityClass): array
    {
        try {
            $reflection = new \ReflectionClass($entityClass);
            $dictionary = array_map(
                function ($prop) {
                    /** @var \ReflectionProperty $prop */
                    return $prop->getName();
                },
                $reflection->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED)
            );
        } catch (\ReflectionException $e) {
            $dictionary = [];
        }

        return $dictionary;
    }
}
