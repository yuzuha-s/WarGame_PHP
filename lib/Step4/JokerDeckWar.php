<?php

require_once __DIR__ . '/Card.php';
require_once __DIR__ . '/Game.php';
require_once __DIR__ . '/Player.php';
require_once __DIR__ . '/HumanPlayer.php';
require_once __DIR__ . '/JokerCard.php';


use QUEST\Step4\Card;
use QUEST\Step4\Game;
use QUEST\Step4\Player;
use QUEST\Step4\HumanPlayer;
use QUEST\Step4\JokerCard;


echo '戦争を開始します。';
fgets(STDIN);
$playerCount = 0;
do {
    echo 'プレイヤーの人数を入力してください（2〜5）:';
    $input = trim(fgets(STDIN));
    $playerCount = (int)$input;
    if ($playerCount < 2 ||  5 < $playerCount) {
        echo "error：プレイヤーの人数は2~5人で入力してください。" . PHP_EOL;
    }
} while ($playerCount  < 2 || $playerCount > 5);
$players = [];
for ($i = 1; $i <= $playerCount; $i++) {
    $players[] = new HumanPlayer($i);
}
echo 'カードが配られました。' . PHP_EOL;
fgetc(STDIN);
$game = new Game($players);
$deck = new JokerCard();

//カードの大小比較
$game->play();
//順位付け
$game->rankSort();

echo '戦争を終了します。' . PHP_EOL;


// php JokerDeckWar.php
// cd lib/Step4
// ./vendor/bin/phpcs --standard=PSR12 ./lib/Step4/JokerDeckWar.php
// ./vendor/bin/phpcbf --standard=PSR12 ./lib/Step4/JokerDeckWar.php
