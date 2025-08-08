<?php

namespace QUEST\Step4;

require_once __DIR__ . '/Player.php';

// Playerクラスを読み込む
// 複数人対応できるようにPlayerクラスを継承
//名前を付ける
class HumanPlayer extends Player
{
    public function __construct($i)
    {
        do {
            echo 'プレイヤー' . $i . 'の名前を入力してください:';
            $name = trim(fgets(STDIN));
  //名前入力が空欄の場合
            if ($name === '') {
                echo 'error:名前を入力してください。' . PHP_EOL;
            }
        } while ($name === '');
//プレイヤーを複数生成する
//親クラスのコンストラクタを呼び出す、Playerクラスの初期を実行
        parent::__construct($name);
    }
}

