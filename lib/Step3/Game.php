<?php

namespace QUEST\Step3;

// Game・・・・・ループ、勝敗判定、引き分け処理・・・複数人対応する
class Game
{
    public $deck;
    public $players = [];
    public $pile = [];

  //deckにCardsクラスのインスタンスをセットする
    public function __construct($players)
    {
        $this->deck = new Card();
        $this->players = $players;
//手札を均等に配る
        $playerCount = count($this->players);
        $i = 0;
        while ($card = $this->deck->drawCard()) {
            $this->players[$i % $playerCount]->receiveCards([$card]);
            $i++;
        }
    }

    public function play()
    {
        echo '戦争！' . PHP_EOL;
// 誰かの手札が0枚になった時点で終了する
        while (true) {
            foreach ($this->players as $player) {
                if ($player->countCards() === 0) {
                    echo $player->name . 'の手札がなくなりました。' . PHP_EOL;
                    return;
                }
            }

            foreach ($this->players as $player) {
                echo $player->name . ':' . $player->countCards() . '枚' . '/';
                echo PHP_EOL;
            }
          // それぞれのプレイヤーの手札を表示する
            $round = [];
            foreach ($this->players as $player) {
                  $card = $player->playCard();
                  $round[] = [
                    'player' => $player,
                    'card' => $card
                    ];
                  //カードは配列定義のため$card[' ']とする
                    echo $player->name . 'のカードは' . $card['suit'] . 'の' . $card['face'] . 'です。' . PHP_EOL;
            }
            $this->compareCard($round);
            echo '------------------------------------------------' . PHP_EOL;
        }
    }
  // 勝敗判定、引き分け処理・・・複数人の場合は配列にする
  //もらったカードを配列に追加する、配列内の数字がなくなるまで繰り返す
    public function compareCard(array $round): void       //void = returnしない
    {
      //一番強いカードを出したプレーヤー順に並べる
        usort($round, fn($a, $b) => $b['card']['value'] <=> $a['card']['value']);
      //最も強いカードの数字を取得(2人いた場合は引き分け)
        $topValue = $round[0]['card']['value'];
      //同じ強さのプレーヤーを取得する  ・・・無名関数(アロー関数)
        $drawers = array_filter($round, fn($r) => $r['card']['value'] === $topValue);
      //一番強いカードを持ったプレイヤーを配列の一番最初から取り出す
        if (count($drawers) === 1) {
            $winner = $round[0]['player'];
      // 勝負時に獲得したカードの枚数を手札pileに追加
            foreach ($round as $r) {
                $this->pile[] = $r['card'];
            }

            $cardsCount = count($this->pile);
            echo $winner->name . 'が勝ちました。' . $winner->name . 'はカードを' . $cardsCount . '枚もらいました。' . PHP_EOL;
  //勝者にカードを渡す
            $winner->receiveCards($this->pile);
            $this->pile = [];
  // 山札をリセット
        } else {
            echo '引き分けです。' . PHP_EOL;
        //引き分け時(上位2人が同じカードだった場合)全プレイヤーが再びカードを出す
                $drawRound = [];
            foreach ($this->players as $player) {
                if ($player->countCards() > 0) {
                    $card = $player->playCard();
                    $this->pile[] = $card;
                    echo $player->name . 'のカードは' . $card['suit'] . 'の' . $card['face'] . 'です。' . PHP_EOL;
                    $drawRound[] = [
                            'player' => $player,
                            'card' => $card
                      ];
                } else {
                    echo $player->name . 'はカードが足りませんでした。' . PHP_EOL;
                }
            }
        // 引き分け時の再勝負を呼び出す
            if (count($drawRound) > 0) {
                $this->compareCard($drawRound);
            }
        }
    }
  //順位付けする
    public function rankSort(): void
    {
//プレイヤーの手札の値（value）の合計で値でプレイヤーを降順に並べる
        usort($this->players, function ($a, $b) {

            $sumA = array_sum(array_map(fn($card) => $card['value'], $a->hand));
            $sumB = array_sum(array_map(fn($card) => $card['value'], $b->hand));
            return $sumB <=> $sumA;
  //宇宙船演算子<=>$this->playersを昇順に並び替え
        });
        foreach ($this->players as $i => $player) {
            $sum = array_sum(array_map(fn($card) => $card['value'], $player->hand));
            echo $player->name . 'が' . $i + 1 . '位' . PHP_EOL;
        }
    }
}
