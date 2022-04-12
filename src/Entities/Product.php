<?php

namespace Hillel\Entities;

use Hillel\Casts\ArrayCast;
use Hillel\Casts\MoneyCast;
use Hillel\Casts\DateTimeCast;

class Product
{
    private float $price;

    private string $attributes;

    private int $updatedAt;

    protected $casts = [
        'price' => MoneyCast::class,
        'attributes' => ArrayCast::class,
        'updatedAt' => DateTimeCast::class,
    ];

    public function __construct($price, $attributes, $updatedAt)
    {
        $this->price = $price;
        $this->attributes = $attributes;
        $this->updatedAt = $updatedAt;
    }

    public function __set($variable, $value)
    {
        if (array_key_exists($variable, $this->casts)) {
            $this->$variable = $this->casts[$variable]::set($value);
        }
    }

    public function __get($variable)
    {
        if (array_key_exists($variable, $this->casts)) {
            return $this->casts[$variable]::get($this->$variable);
        }
    }

    public function __toString(): string
    {
        return 'Price:' . $this->price
            . '<br>' . 'Attributes:' . $this->attributes
            . '<br>' . 'Updated at:' . $this->updatedAt;
    }
}
