<?php

namespace QUEST\Step4;

require_once __DIR__ . '/Card.php';

//Cardクラスを継承してジョーカーを追加する
class JokerCard extends Card
{
    public function __construct()
    {
        parent:: __construct();
        //ジョーカーを1枚追加
        $this->deck[] = [
            'value' => 15,
            'face' => 'JOKER',
            'suit' => '最強'
        ];
        shuffle($this->deck);
    }
}