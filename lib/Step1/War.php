<?php

echo '戦争を開始します。';
fgetc(STDIN);
echo 'カードが配られました。';
fgetc(STDIN);
do {
    $cards = range(2, 14);
//カード2～14までの13枚
    $faceCards = [         //11~14までをそれぞれ変換
    11 => 'J',
    12 => 'Q',
    13 => 'K',
    14 => 'A'
    ];
    $suits = ['ハート', 'スペード', 'ダイヤ', 'クラブ'];
//絵柄4種類
    $player = ['プレイヤー1', 'プレイヤー2'];
//プレーヤー

  //カードと絵柄をシャッフルする
    shuffle($cards);
    shuffle($suits);
//カードを数字またはJ Q K Aで表示する
    $card1 = $cards[0];
    $suitName1 = $faceCards[$card1] ?? $card1;
    $card2 =  $cards[1];
    $suitName2 = $faceCards[$card2] ?? $card2;
    $suit1 = $suits[0];
    $suit2 = $suits[1];
    echo '戦争！';
    fgetc(STDIN);
    echo $player[0] . 'は' . $suit1 . 'の' .  $suitName1 . 'です。' . PHP_EOL;
    echo $player[1] . 'は' . $suit2 . 'の' .  $suitName2 . 'です。' . PHP_EOL;
    if ($card1 == $card2) {
        echo '引き分けです。';
        fgetc(STDIN);
    }
} while ($card1 == $card2);
if ($card1 > $card2) {
    echo 'プレイヤー1が勝ちました。' . PHP_EOL;
} elseif ($card1 < $card2) {
    echo 'プレイヤー2が勝ちました。' . PHP_EOL;
}

echo '戦争を終了します。' . PHP_EOL;

//コマンド：php War.php
// ./vendor/bin/phpcs --standard=PSR12 ./lib/Step1//War.php
// ./vendor/bin/phpcbf --standard=PSR12 ./lib/Step1//War.php
