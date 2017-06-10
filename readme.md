# Lumenのテスト

## 事前準備
- PHP 5.6が入っていること
- Composerが入っていること
- PHPUnitがComposer globalに入っていること
- PHP-CS-FixerがComposer globalに入っていること

## つかいかた

### 初期化
```bash
$ composer update
```

### .envを編集
`vim .env`してMySQLの設定ファイルをちくちく書く．

Memcachedを入れていない場合は，
```
CACHE_DRIVER=file
```
としてあげること．

あと，
```
APP_TIMEZONE=Asia/Tokyo
```
とちゃんと書くこと．

### マイグレーション
データベースの初期化（テーブル作成&ダミーデータ挿入）．
データベースにデータが入っているなら必要ない．
```bash
$ php artisan migrate
$ php artisan db:seed
```

### 実行
```bash
$ php -S localhost:8080 -t public
```

## 解説
だいたいコミットログに書いてあるので，その辺も参照すること．

### Model
DBのテーブルとオブジェクトを結びつけるクラス．
`app/`直下にPHPファイルとして配置されている．
デフォルトでは`User.php`が入っている．

新規で作りたいときは，
```bash
$ php artisan wn:model User
```
とかやる．

生成したModelクラスのメンバには意味があり，適当なメンバを定義することで
モデルの振る舞いを定義できる．

詳しくは以下を参照．

http://qiita.com/S346/items/9c5718b960eb0501c91f

### Controller

#### REST Controller
まず，一度だけ
```bash
$ php artisan wn:controller:rest-actions
```
としてやると，RESTレスポンス用の`trait`が作成される．

次回以降は，上述で作成したModel名と同じ名称を使って
```bash
$ php artisan wn:controller User
```
としてやれば，そのモデルのREST Controller `UsersController.php`が
`app/Http/Controllers`に自動で生成され，ルーティングが`routes/web.php`に追記される．

### Migration

#### Migrationファイルを作成
`user`テーブルを作りたいとき：
```bash
$ php artisan make:migration CreateUserTable --create=user
```

`user`テーブルの内容を編集したいとき：
```bash
php artisan make:migration ChangeDataUserTable --table=user
```

とすると，`database/migrations`内に`{日時}_{第3引数}.php`が作成されるので，
出来たファイルを編集して変更内容を記入する．

#### Migration実行
```bash
$ php artisan migrate
```
とするとMigrationが実行される．

```bash
$ php artisan migrate --database=testing
```
とすると，テスト用のDB（ここではインメモリSQLite）にMigrationが実行される．

#### Migrationのリセット
```bash
$ php artisan migrate:reset
```
とするとすべてのマイグレーションがキャンセルされる．

#### MigrationでトラブったときのFix方法
`migrations`テーブルを消した後，
```bash
$ composer dump-autoload
```
して，Migrationをリセット．

なお，DB内のデータの保証はしない．

#### Migrationの参考文献
https://readouble.com/laravel/5.4/ja/migrations.html

### Seeder
テーブルにダミーデータを入れたいときに使う．

#### Seederの作成
```bash
$ php artisan make:seeder UserTableSeeder
```
とすると`database/seeds`内に`UserTableSeeder.php`が作成されるので，
編集して差し込むデータを追記する．

編集が完了したら`database/seeds/DatabaseSeeder.php`の`run`メソッドに，
```php
$this->call('UserTableSeeder');
```
と追記してやることで，`UserTableSeeder`が実行させるようになる．

#### Seederの実行
```bash
$ php artisan db:seed
```
を実行することで，データがテーブルに書き込まれる．

#### Seederの参考文系
https://readouble.com/laravel/5.4/ja/seeding.html

