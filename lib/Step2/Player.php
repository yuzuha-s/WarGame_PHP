<?php

namespace QUEST\Step2;
// Player・・・・クラスで1人プレイヤーを設計し、外で複数人生成できるようにする
//receiveCards()、countCards()、DrawCard(), countWonCards()、 playCard()
class Player
{
    public $name;
    public $hand = []; //手持ちのカード

    public function __construct($name)
    {
        $this->name = $name;
    }

  // カードを獲得するreceiveCards()
    public function receiveCards($cards)
    {
        foreach ($cards as $card) {
            $this->hand[] = $card;
        }
    }
  // カードをカウントするcountCards()
    public function countCards()
    {
        return count($this->hand);
    }
    // 手札の先頭からカードを1枚出す
    public function playCard()
    {
        return array_shift($this->hand);
    }
}
