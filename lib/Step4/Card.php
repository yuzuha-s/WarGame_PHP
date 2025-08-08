<?php

namespace QUEST\Step4;

class Card
{
    protected $deck = [];
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
    }
  // カードを引く DrawCard()
    public function drawCard()
    {
        return array_shift($this->deck);
    }
}



