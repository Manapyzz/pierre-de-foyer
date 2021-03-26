<?php

namespace App;

class Deck
{
    private array $cards;

    public function __construct(int $numberOfCards)
    {
        $this->fillDeck($numberOfCards);
    }

    public function shuffleCards(): void
    {
        for ($i = 0; $i < count($this->cards)-1; $i++)
        {
            $randomKey = rand(0, count($this->cards)-1);
            $currentCard = $this->cards[$i];
            $this->cards[$i] = $this->cards[$randomKey];
            $this->cards[$randomKey] = $currentCard;
        }
    }

    public function distributeCards(Player $firstPlayer, Player $secondPlayer)
    {
        foreach ($this->cards as $key => $card)
        {
            if ($key % 2 === 0)
            {
                $firstPlayer->addCardToHand($card);
            } else {
                $secondPlayer->addCardToHand($card);
            }

            unset($this->cards[$key]);
        }
    }

    private function fillDeck(int $numberOfCards): void
    {
        for ($i = 0; $i < $numberOfCards; $i++)
        {
            $cardLife = rand(5, 15);
            $cardDamage = rand(5, 15);
            $cardName = sprintf('Monster %s', $i);
            $this->cards[] = new Card($cardName, $cardDamage, $cardLife);
        }
    }
}