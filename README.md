# トランプゲームの戦争

## 環境
- OS：ubuntu24.04
- PHP 8.3.6

## コーディングチェック
- PHP_CodeSnifferを使用

## ディレクトリ構成
```
QUEST/

├── README.md
├── lib/
│ ├── Step1/
│ │ ├── War.php # 手続き型（オブジェクト指向なし）
│ │ ├── WarGame.php
│ │ └── WarGameMain.php
│ ├── Step2/
│ │ ├── DeckWarGame.php
│ │ ├── Card.php
│ │ ├── Game.php
│ │ └── Player.php
│ ├── Step3/
│ │ ├── PartyDeckWar.php
│ │ ├── Card.php
│ │ ├── Game.php
│ │ ├── Player.php
│ │ └── HumanPlayer.php
│ └── JokerDeckWar.php
├── vendor/
├── composer.json
└── composer.lock
```

## 各ステップの概要
### Step1

- **WarGame**
  - `mix()`：カードをシャッフル
  - `DrawCard()`：カードを引く
  - `CompareCard()`：カードを比較

### Step2
- **Card・・・数値・絵柄のプロパティを定義**
  - `drawCard()`：シャッフル済みのカードから引く

- **Player・・・カードを獲得する、数えるなど**
  - `receiveCards()`：カードを獲得する
  - `countCards()`：手札枚数を数える
  - `playCard()`：手札の先頭からカードを出す

- **Game・・・ループ、引き分け処理、勝敗判定 カードを出して表示する**
  - `play()`：ゲーム全体の進行
  - `compareCard()`：カードの大小を比較、引き分け処理含む

### Step3
  - **Card・・・数値・絵柄のプロパティを定義 シャッフルされたカードを引く**
    - `drawCard()`：シャッフル済みのカードから引く

- **Player・・・カードを獲得する、数えるなど**
  - `receiveCards()`：カードを獲得する
  - `countCards()`：カードの枚数をカウント
  - `playCard()`：カードを1枚出す

- **Game・・・ループ、引き分け処理、勝敗判定 カードを出して表示する**
  - `play()`：ゲーム全体の進行を担当
  - `compareCard()`：1ラウンドの勝敗判定のみを行う
  - `rankSort()`：カードの強さ順に並べる（順位付け用）

     ※ `play()` の中で `compareCard()` をラウンドごとに呼び出し、勝敗を管理する構造

- **HumanPlayer・・・複数人対応できるようにPlayerクラスを継承**
