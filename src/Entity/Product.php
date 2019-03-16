<?php

namespace Rx\Entity;


class Product
{
    /**
     * @var string $id
     */
    protected $id;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var int $value
     */
    protected $value;

    /**
     * @var int $quantity
     */
    protected $quantity;

    /**
     * Product constructor.
     * @param array $data
     * @throws \Exception
     */
    public function __construct(array $data)
    {
        if (!array_key_exists('name', $data)) {
            throw new \Exception('The property "name" is required');
        }

        $this->setId($data['id'] ?? null);
        $this->setName($data['name'] ?? null);
        $this->setDescription($data['description'] ?? null);
        $this->setValue($data['value'] ?? null);
        $this->setQuantity($data['quantity'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return self
     */
    public function setId(?string $id): self
    {
        if (!$this->id)
            $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return self
     */
    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return self
     */
    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity > -1 ? $quantity : 0;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return $this->quantity > 0;
    }

}
