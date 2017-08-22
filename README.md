# todo_app

### 仕様した技術要素
- Vagrant 1.9.0
- Larval 5.4.32
- jQuery(Ajax) 1.9.1

### 全体の設計・構成
- トップ画面（/）
ToDoリスト一覧、リストの新規作成、関連Todoを含む削除機能（独自追加）
- ToDo詳細画面（/todos/{ToDoのid}）
ToDoの表示、ToDo追加、ToDoの状態変更
- 検索画面
Todoの検索、ToDoリストの検索→Ajaxを使用

### 開発環境のセットアップ手順
- Vagrant / VirtualBox はインストール済み
- Vagrant上でcomposerを使いlarvalインストーラを取得
- laravelプロジェクトを作成


