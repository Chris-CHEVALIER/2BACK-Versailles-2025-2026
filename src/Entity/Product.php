<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    private int $id;

    #[Assert\NotBlank(message: "Le nom doit être rempli")]
    #[Assert\Length(
        min: 3,
        max: 67,
        minMessage: "Le nom doit faire plus de 3 caractères.",
        maxMessage: "Le nom doit faire moins de 67 caractères."
    )]
    private string $name;

    #[Assert\NotBlank(message: "La description doit être remplie")]
    private string $description;

    #[Assert\NotBlank(message: "Le prix doit être rempli")]
    private float $price;
    
    private DateTime $expirationDate;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of expirationDate
     */
    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    /**
     * Set the value of expirationDate
     */
    public function setExpirationDate(DateTime $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }
}
