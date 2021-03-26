<?php

require ('vendor/autoload.php');

use App\Deck;
use App\Player;
use App\Card;

$deck = new Deck(30);

//dump($deck);

$deck->shuffleCards();

//dump($deck);

$alex = new Player('Alex');
$rick = new Player('Rick');

//dump($alex, $rick);

$deck->distributeCards($alex, $rick);

//dump($deck);
//dd($alex, $rick);

$turnCounter = 0;

while ((!$alex->isDead() && !$rick->isDead()) && (!$alex->isHandEmpty() && !$rick->isHandEmpty()))
{
    $alexCard = $alex->playCard();
    $rickCard = $rick->playCard();

    $alex->setHealth($alex->getHealth() - getHealthToRemoveFromPlayer($rickCard, $alexCard));
    $rick->setHealth($rick->getHealth() - getHealthToRemoveFromPlayer($alexCard, $rickCard));

    displayTurn($turnCounter, $alex, $rick, $alexCard, $rickCard);

    $turnCounter++;
}

if ($alex->getHealth() === $rick->getHealth())
{
    echo 'Draw';
} else if ($alex->getHealth() > $rick->getHealth()) {
    echo 'Alex wins';
} else if ($alex->getHealth() < $rick->getHealth()) {
    echo 'Rick wins !';
}

function getHealthToRemoveFromPlayer(Card $attackingCard, Card $defendingCard): int
{
    $cardRemainingLife = $defendingCard->getLife() - $attackingCard->getDamage();

    if ($cardRemainingLife < 0)
    {
        return abs($cardRemainingLife);
    }

    return 0;
}

function displayTurn(int $turnCounter, Player $firstPlayer, Player $secondPlayer, Card $firstPlayerCard, Card $secondPlayerCard)
{
    $turnSentence = sprintf('<b>Turn %s !</b><br>', $turnCounter);

    $firstSentence = sprintf('%s joue sa carte "%s" (%s dgt / %s pv) et %s joue sa carte "%s" (%s dgt / %s pv). <br>',
        $firstPlayer->getName(),
        $firstPlayerCard->getName(),
        $firstPlayerCard->getDamage(),
        $firstPlayerCard->getLife(),
        $secondPlayer->getName(),
        $secondPlayerCard->getName(),
        $secondPlayerCard->getDamage(),
        $secondPlayerCard->getLife(),
    );

    $secondSentence = sprintf('%s perds %s HP et %s perds %s HP ! <br>',
        $firstPlayer->getName(),
        getHealthToRemoveFromPlayer($secondPlayerCard, $firstPlayerCard),
        $secondPlayer->getName(),
        getHealthToRemoveFromPlayer($firstPlayerCard, $secondPlayerCard),
    );

    $thirdSentence = sprintf('Il reste %s HP à %s et il reste %s HP à %s.  <br><br>',
        $firstPlayer->getName(),
        $firstPlayer->getHealth(),
        $secondPlayer->getName(),
        $secondPlayer->getHealth()
    );

    echo $turnSentence;
    echo $firstSentence;
    echo $secondSentence;
    echo $thirdSentence;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
