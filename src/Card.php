<?php

namespace App;

class Card
{
    private string $name;
    private int $life;
    private int $damage;

    public function __construct(string $name, int $life, int $damage)
    {
        $this->name = $name;
        $this->life = $life;
        $this->damage = $damage;
    }

    public function getLife(): int
    {
        return $this->life;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function getName(): string
    {
        return $this->name;
    }
}