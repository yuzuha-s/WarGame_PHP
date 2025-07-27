<?php

namespace QUEST\Step3;

// Card・・・・・数値・絵柄のプロパティを定義
class Card
{
    private $deck = [];
    private $faceCards = [
    11 => 'J',
    12 => 'Q',
    13 => 'K',
    14 => 'A'
    ];
    public function __construct()
    {
          $suits = ['ハート', 'スペード', 'ダイヤ', 'クラブ'];
        foreach ($suits as $suit) {
            foreach (range(2, 14) as $value) {
                $this->deck[] = [
                      'value' => $value,
                      'face' => $this->faceCards[$value] ?? $value, //$faceCardsになければ数字を取り出す
                      'suit' => $suit
                ];
            }
        }
        shuffle($this->deck);
    // var_dump(count($this->deck));
    }
  // カードを引く DrawCard()
    public function drawCard()
    {
        return array_shift($this->deck);
//最初の要素を取り出す関数
    }
}
