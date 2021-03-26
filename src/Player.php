<?php

namespace App;

class Player
{
    private string $name;
    private int $health;
    private array $cards;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->health = 30;
        $this->cards = [];
    }

    public function addCardToHand(Card $card): void
    {
        $this->cards[] = $card;
    }

    public function isDead(): bool
    {
        return $this->health <= 0;
    }

    public function isHandEmpty(): bool
    {
        return count($this->cards) === 0;
    }

    public function playCard(): Card
    {
        $cardToPlay = $this->cards[0];
        unset($this->cards[0]);
        $this->cards = array_values($this->cards);

        return $cardToPlay;
    }

    public function getHealth():int
    {
        return $this->health;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    public function getName(): string
    {
        return $this->name;
    }
}