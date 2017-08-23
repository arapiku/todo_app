# 課題用ToDoアプリ

## 仕様した技術要素
- Vagrant 1.9.0
- Larval 5.4.32
- jQuery(Ajax) 1.9.1

## 全体の設計・構成
- トップ画面（/）
  - ToDoリスト一覧、リストの新規作成、関連Todoを含む削除機能（独自追加）
- ToDo詳細画面（/todos/{ToDoのid}）
  - ToDoの表示、ToDo追加、ToDoの状態変更
- 検索画面
  - Todoの検索、ToDoリストの検索→Ajaxを使用

## 開発環境のセットアップ手順
- Vagrant環境のセットアップ

  ```
  vagrant box add bento/centos-6.7
  vagrant init bento/centos-6.7
  vagrant up
  ```
- sshでログイン

  ```
  vagrant ssh
  ```
- 新規ディレクトリを作成・移動

  ```
  mkdir [DirectoryName]
  cd [DirectoryName]
  ```
- composerでlaravelインストーラを取得

  ```
  composer global require "laravel/installer"
  ```
- プロジェクトを作成

  ```
  laravel new [ProjectName]
  ```

## ディレクトリ構成の簡潔な説明
  ```
  .
  ├── app .. コアコード
  ├── bootstrap .. フレームワークの初期起動やオートローディング設定
  ├── config .. 設定ファイル
  ├── database .. マイグレーションとシーディング
  ├── domain .. 独自バリデーションファイル
  ├── public .. index.phpやアセット
  ├── resources .. ビュー、アセットの元ファイル、言語
  ├── routes .. ルート定義等
  ├── storage .. セッション、キャッシュ等フレームワーク生成ファイル
  └── tests .. テスト
  ```

## ローカル PC 環境での実行手順
- vagrant ssh でログイン
- プロジェクトフォルダへ移動
- artisanコマンドでアプリケーションを実行

  ```
  php artisan serve —host [ip address] —port [port number]
  ```

## ユニットテスト実行手順
laravel標準機能の**phpunit**でテスト

- tests/Unit/ 以下にフォームの動作用テストファイルを作成（PostTest.php, TodoTest.php）

  ```
  public function testFormCheck() {
    $this->visit('/')
    ->type('タイトル１', 'title')
    ->press('リストの作成');
  }
  ```
  ターミナルからphpunitを実行すると、成否をboolean値で返す
  $ vendor/bin/phpunit tests/Unit/TodoTest
- 同様に、tests/Feature/ 以下にバリデーション用のテストファイルを作成

  ```
  /**
   * A basic test example.
   *
   * @return void
   * @dataProvider dataproviderValidator
   */
   public function testValidator($item, $data, $expect) {
     $dataList = [$item => $data];
     $request = new PostRequest();
     $rules = $request->rules();
     $rules = array_only($rules, $item);
     $validator = Validator::make($dataList, $rules);
     $result = $validator->passes();
     $this->assertEquals($expect, $result);
   }

   public function dataproviderValidator() {
     return [
       '正常(title)' => ['title', 'タイトル', true],
       '正常(deadline)' => ['deadline', '2017/09/09', true],
       '必須エラー(deadline)' => ['deadline', '', false],
       '必須エラー(title)' => ['title', '', false],
       '最大文字数エラー(title)' => ['title', str_repeat('a', 31), false],
       'ユニークエラー(title)' => ['title', strpos('タイトル', 'タイトル'), false],
       '特殊文字エラー(title)' => ['title', preg_match('/[^ぁ-んァ-ンーa-zA-Z0-9一-龠０-９\-\r]+/u', 'dad'), false],
     ];
   }
  ```
  バリデーションチェック用の*Request.phpファイルからインスタンスを生成している。phpunit実行時に成否をboolean値で返す。

## サーバへデプロイする手順
- sftp経由(FileZilla)でアップするファイルをデスクトップに落とす
- sqlファイルをエクスポート

  ```
  mysqldump -u [username] -p [password] > export.sql
  ```
- フォルダにまとめてsftp経由(FileZilla)でさくらのレンタルサーバーにアップロード
- publicの中身をwwwにコピー

  ```
  cp -r ~/[laravel project]/public/* ~/www/
  ```
- phpMyAdminよりデータベース作成、上記のexport.sqlをインポート
- .env、config/database.phpのdb内容を本番環境用に書き換え
- ~/www に.htaccessを作成

  ```
  <IfModule mod_rewrite.c>
    # <IfModule mod_negotiation.c>
    #    Options -MultiViews
    # </IfModule>

    RewriteEngine On

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
  </IfModule>
  ```

- ~/www のindex.phpのパスを変更

  ```
  require __DIR__.’/../[laravel project]/bootstrap/autoload.php';
  $app = require_once __DIR__.’/../[laravel project]/bootstrap/app.php';
  ```
- ブラウザにアクセス
