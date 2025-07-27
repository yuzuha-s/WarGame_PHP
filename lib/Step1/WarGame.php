<?php

namespace QUEST\Step1;

class WarGame
{
  //変数を定義
    public $players = ['プレイヤー1', 'プレイヤー2'];
    public $cards;
    public $suits = ['ハート', 'スペード', 'ダイヤ', 'クラブ'];
  //11~14までをそれぞれ変換
    public $faceCards = [
    11 => 'J',
    12 => 'Q',
    13 => 'K',
    14 => 'A'
    ];
  //コンストラクタで変数を初期化
    public function __construct()
    {
    //何も定義しない
    }
  // カードをシャッフルする
    public function mix()
    {
        $this->cards = range(2, 14);
        shuffle($this->cards);
        shuffle($this->suits);
    }
  // カードを引く DrawCard()
    public function drawCard()
    {
        $value = array_shift($this->cards);
        $face = $this->faceCards[$value] ?? $value;
        $suit = array_shift($this->suits);

        return [
        'value' => $value,
        'face' => $face,
        'suit' => $suit
        ];
    }
  // カードを比較する(大小) CompareCard()
    public function compareCard($card1, $card2)
    {
        if ($card1['value'] > $card2['value']) {
            echo $this->players[0] . 'が勝ちました。' . PHP_EOL;
            return 'player1';
        } elseif ($card1['value'] < $card2['value']) {
            echo $this->players[1] . 'が勝ちました。' . PHP_EOL;
            return 'player2';
        } elseif ($card1['value'] == $card2['value']) {
            return 'draw';
        }
    }
}

    