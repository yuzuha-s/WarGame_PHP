# トランプゲームの戦争

## 環境
- OS：ubuntu24.04
- PHP 8.3.6

## コーディングチェック
  PHP_CodeSnifferを使用

## ディレクトリ構成
  QUEST/
├── README.md
├── lib/
│   ├── Step1/
│   │   ├── War.php                # 手続き型（オブジェクト指向なし）
│   │   ├── WarGame.php
│   │   └── WarGameMain.php
│   ├── Step2/
│   │   ├── DeckWarGame.php
│   │   ├── Card.php
│   │   ├── Game.php
│   │   └── Player.php
│   ├── Step3/
│   │   ├── PartyDeckWar.php
│   │   ├── Card.php
│   │   ├── Game.php
│   │   ├── Player.php
│   │   └── HumanPlayer.php
│   └── JokerDeckWar.php
├── vendor/
├── composer.json
└── composer.lock

## Step1

- クラス-メソッド

  WarGame
                カードをシャッフルする  mix()
                カードを引く           DrawCard()
                カードを比較する(大小)  CompareCard()


## Step2

  Card・・・・・数値・絵柄のプロパティを定義
                シャッフルされたカードを引く    drawCard()
  Player・・・・カードを獲得する、数えるなど

                カードを獲得する              receiveCards()

                カードをカウントする           countCards()

                手札の先頭からカードを1枚出す   playCard()


  Game・・・・・ループ、引き分け処理、勝敗判定
                カードを出して表示する    play()
                カードを比較する(大小)    compareCard()

## Step3
  Card・・・・・・数値・絵柄のプロパティを定義
                シャッフルされたカードを引く    drawCard()

  Player・・・・・カードを獲得する、数えるなど
                  カードを獲得する              receiveCards()
                  カードをカウントする           countCards()
                  手札の先頭からカードを1枚出す   playCard()

  Game・・・・・・ループ、引き分け処理、勝敗判定
                  カードを出して表示する                    play()
                  カードの大小を比較する・引き分けしょりなど  compareCard()
                  カードの大小で順位付けする                rankSort()

    (※ゲームの流れは play() で回し、compareCard() は「ラウンドの勝敗判定」という役割だけ担うように実装した。play() からラウンドごとに呼ばれる仕組みです。)

  HumanPlayer・・・複数人対応できるようにPlayerクラスを継承
