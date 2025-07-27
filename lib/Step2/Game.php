<?php

namespace QUEST\Step2;

// Game・・・・・ループ、勝敗判定、引き分け処理
class Game
{
    public $deck;
    public $players = [];
    public $pile = []; //

  //deckにCardsクラスのインスタンスをセットする
    public function __construct($players)
    {
        $this->deck = new Card();
        $this->players = $players;

      //手札を均等に配る
        while ($card = $this->deck->drawCard()) {
            $this->players[0]->receiveCards([$card]);
            $card = $this->deck->drawCard();
            if ($card) {
                $this->players[1]->receiveCards([$card]);
            }
        }
    }
  //配列内の数字がなくなるまで繰り返す
  //もらったカードを配列に追加する
    public function play()
    {
        while (true) {
          // 手札がなくなったら終了判定
            if ($this->players[0]->countCards() === 0) {
                break;
            }
            if ($this->players[1]->countCards() === 0) {
                break;
            }

          // 手札からカードをプレイする(ゲームをする)
            $card1 = $this->players[0]->playCard();
            $card2 = $this->players[1]->playCard();

            echo '戦争！' . PHP_EOL;
            echo $this->players[0]->name . 'のカードは' . $card1['suit'] . 'の' . $card1['face'] . 'です。' . PHP_EOL;
            echo $this->players[1]->name . 'のカードは' . $card2['suit'] . 'の' . $card2['face'] . 'です。' . PHP_EOL;

            $result = $this->compareCard($card1, $card2);
            echo $this->players[0]->name . ':' . $this->players[0]->countCards() . '枚' . '/';
            echo $this->players[1]->name . ':' . $this->players[1]->countCards() . '枚' . PHP_EOL;

            if ($result === 0) {
                break;
            }

            if ($result === 'draw') {
                continue;
            }
          // 手札の残数
            if ($this->players[0]->countCards() === 52) {
                echo 'プレイヤー2の手札がなくなりました。' . PHP_EOL;
                echo $this->players[0]->name . 'の手札の枚数は52枚です。' . $this->players[1]->name . 'の手札の枚数は0枚です。' . PHP_EOL;
                break;
            }
            if ($this->players[1]->countCards() === 52) {
                echo 'プレイヤー1の手札がなくなりました。' . PHP_EOL;
                echo $this->players[1]->name . 'の手札の枚数は52枚です。' . $this->players[0]->name . 'の手札の枚数は0枚です。' . PHP_EOL;
                break;
            }
        }
    }

  // 勝敗判定、引き分け処理
    public function compareCard($card1, $card2)
    {
      //勝負時に獲得したカードの枚数を手札に追加
        $this->pile[] = $card1;
        $this->pile[] = $card2;

        $cardsCount = count($this->pile);

        if ($card1['value'] > $card2['value']) {
            echo $this->players[0]->name . 'が勝ちました。';
            echo $this->players[0]->name . 'はカードを' . $cardsCount . '枚もらいました。'  . PHP_EOL;
            echo '------------------------------------------------' . PHP_EOL;
          //プレイヤー1にカードを渡す
            $this->players[0]->receiveCards($this->pile);
            $this->pile = [];
            return 'player1';
        } elseif ($card1['value'] < $card2['value']) {
            echo $this->players[1]->name . 'が勝ちました。';
            echo $this->players[1]->name . 'はカードを' . $cardsCount . '枚もらいました。' . PHP_EOL;
            echo '------------------------------------------------' . PHP_EOL;
          //プレイヤー2にカードを渡す
            $this->players[1]->receiveCards($this->pile);
            $this->pile = [];
            return 'player2';
        } elseif ($card1['value'] == $card2['value']) {
            echo '引き分けです' . PHP_EOL;
          //引き分けの時にどちらかの手札がなければ終了
            foreach ($this->players as $player) {
                if ($player->countCards() < 1) {
                    $winner = $this->players[0] === $player ? $this->players[1] : $this->players[0];
                    $loser = $player;
                    $winner->receiveCards($this->pile);
                    echo $winner->name . 'の手札の枚数は52枚です。' . $loser->name . 'の手札の枚数は0枚です。' . PHP_EOL;
                    $this->pile = [];
                    return 0;
                }
            }
          // 伏せカードを1枚ずつ追加
            $this->pile[] = $this->players[0]->playCard();
            $this->pile[] = $this->players[1]->playCard();

        // 勝負カードを1枚ずつ出す
            $newCard1 = $this->players[0]->playCard();
            $newCard2 = $this->players[1]->playCard();

        // 再帰的に勝負
            return $this->compareCard($newCard1, $newCard2);
            ;
        }
    }
}
