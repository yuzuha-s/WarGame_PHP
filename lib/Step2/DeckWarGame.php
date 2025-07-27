<?php

require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Game.php';
require_once __DIR__ . '/Player.php';

use QUEST\Step2\Card;
use QUEST\Step2\Game;
use QUEST\Step2\Player;

echo '戦争を開始します。';
  fgetc(STDIN);
echo 'カードが配られました。' . PHP_EOL;
  fgetc(STDIN);

$card = new Card();
//プレイヤー2人生成する
$playerName = ['プレイヤー1', 'プレイヤー2'];
$player = [];
foreach ($playerName as $name) {
    $player [] = new Player($name);
}

$game = new Game($player);
$game->play();

if ($player[0]->countCards() === 52) {
    echo 'プレイヤー1が1位、プレイヤー2が2位です。' . PHP_EOL;
} else {
    echo 'プレイヤー2が1位、プレイヤー1が2位です。' . PHP_EOL;
}
echo '戦争を終了します。' . PHP_EOL;

    //php DeckWarGame.php
    // ./vendor/bin/phpcs --standard=PSR12 ./lib/Step2/DeckWarGame.php
    // ./vendor/bin/phpcbf --standard=PSR12 ./lib/Step2/DeckWarGame.php
