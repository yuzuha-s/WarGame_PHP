<?php

require_once './WarGame.php';
use QUEST\Step1\WarGame;

  //実行部分
  echo '戦争を開始します。';
  fgetc(STDIN);
  echo 'カードが配られました。' . PHP_EOL;
  fgetc(STDIN);

  $game = new WarGame();
  $game->mix();
do {
    echo '戦争！';
    fgetc(STDIN);
  // $card1 = ['value' => 13, 'face' => 'K', 'suit' => 'ハート'];
  // $card2 = ['value' => 13, 'face' => 'K', 'suit' => 'スペード'];

    $card1 = $game->drawCard();
    $card2 = $game->drawCard();

    echo $game->players[0] . 'のカードは' . $card1['suit'] . 'の' . $card1['face'] . 'です。' . PHP_EOL;
    echo $game->players[1] . 'のカードは' . $card2['suit'] . 'の' . $card2['face'] . 'です。' . PHP_EOL;

    $result = $game->compareCard($card1, $card2);

    if ($result === 'draw') {
        echo '引き分けです。' . PHP_EOL;
        fgetc(STDIN);
    }
} while ($result === 'draw');

    echo '戦争を終了します。' . PHP_EOL;

    //php WarGameMain.php
    // ./vendor/bin/phpcs --standard=PSR12 ./lib/Step1/WarGameMain.php
    // ./vendor/bin/phpcbf --standard=PSR12 ./lib/Step1/WarGameMain.php
